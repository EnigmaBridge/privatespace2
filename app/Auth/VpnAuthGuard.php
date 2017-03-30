<?php
/**
 * Created by PhpStorm.
 * User: dusanklinec
 * Date: 29.03.17
 * Time: 15:05
 */

namespace App\Auth;

use App\User;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Auth\Guard;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\HttpFoundation\Request;

class VpnAuthGuard implements Guard
{
    use GuardHelpers;

    private $host = '127.0.0.1';
    private $secure = false;

    /**
     * The name of the Guard. Typically "vpnauth".
     *
     * Corresponds to guard name in authentication configuration.
     *
     * @var string
     */
    protected $name;

    /**
     * The session used by the guard.
     *
     * @var \Illuminate\Contracts\Session\Session
     */
    protected $session;

    /**
     * The request instance.
     *
     * @var \Symfony\Component\HttpFoundation\Request
     */
    protected $request;

    /**
     * Indicates if the logout method has been called.
     *
     * @var bool
     */
    protected $loggedOut = false;

    /**
     * Create a new authentication guard.
     *
     * @param  string  $name
     * @param  \Illuminate\Contracts\Auth\UserProvider  $provider
     * @param  \Illuminate\Contracts\Session\Session  $session
     * @param  \Symfony\Component\HttpFoundation\Request  $request
     */
    public function __construct(//UserProvider $provider,
                                Session $session,
                                Request $request = null)
    {
        $this->session = $session;
        $this->request = $request;
        //$this->provider = $provider;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Contacts user server, returns user object.
     * Throws exception on non-auth.
     * @param $uid
     * @return Stdobj decoded json server response
     * @throws AuthServerFailException on network error
     */
    private function checkVpnAuth($uid){
        $proto = $this->secure ? 'https' : 'http';
        $url = '';

        if (!empty($uid)){
            $url = sprintf('%s://%s/api/v1.0/verify?ip=%s&user=%s', $proto, $this->host,
                urlencode($_SERVER['REMOTE_ADDR']), urlencode($uid));
        } else {
            $url = sprintf('%s://%s/api/v1.0/verify?ip=%s', $proto, $this->host,
                urlencode($_SERVER['REMOTE_ADDR']));
        }

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $curl_response = curl_exec($curl);
        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            Log::info('ERROR: vpnclient error: ' . var_export($info));
            throw new AuthServerFailException();
        }

        curl_close($curl);
        $decoded = json_decode($curl_response);
        return $decoded;
    }

    /**
     * Checks the auth server response
     * @param $decoded
     * @return bool true if response is ok
     */
    private function checkResponse($decoded){
        return !empty($decoded)
            && isset($decoded->result)
            && $decoded->result === true
            && isset($decoded->user)
            && isset($decoded->user->email);
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        if (!empty($this->user)){
            return $this->user;
        }

        try{
            $decoded = $this->checkVpnAuth(null);
            if (!$this->checkResponse($decoded)) {
                return null;
            }

            $this->user = new User($decoded);
            return $this->user;

        } catch (AuthServerFailException $e){
            return null;
        }
    }

    /**
     * Validate a user's credentials.
     *
     * @param  array $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        // TODO: Implement validate() method.
    }
}
