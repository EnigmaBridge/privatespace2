<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
// use Illuminate\Foundation\Auth\User as Authenticatable;

class User implements Authenticatable
{
    use Notifiable;

    protected $cname;
    protected $email;
    protected $connected;
    protected $local_ip;
    protected $remote_ip;
    protected $remote_port;
    protected $is_admin;

    /**
     * User constructor - from the decoded json vpn auth response
     * @param $decoded
     */
    public function __construct($decoded)
    {
        $this->cname = $decoded->user->cname;
        $this->email = $decoded->user->email;
        $this->connected = intval($decoded->user->connected) > 0;
        $this->local_ip = $decoded->user->client_local_ip;
        $this->remote_ip = $decoded->user->client_remote_ip;
        $this->remote_port = $decoded->user->client_remote_port;
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return $this->cname;
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        $inthash = intval(substr(md5($this->cname), 0, 8), 16);
        return $inthash;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return md5($this->cname);
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return null;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        // nope
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return null;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->is_admin;
    }

    /**
     * @param mixed $is_admin
     */
    public function setIsAdmin($is_admin)
    {
        $this->is_admin = $is_admin;
    }


}
