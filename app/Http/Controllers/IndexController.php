<?php
/**
 * Created by PhpStorm.
 * User: dusanklinec
 * Date: 29.03.17
 * Time: 15:05
 */

namespace App\Http\Controllers;

use App\ServiceInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class IndexController extends Controller
{
    // use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * IndexController constructor.
     */
    public function __construct()
    {

    }

    /**
     * Show the main index page
     *
     * @return Response
     */
    public function show()
    {
        if (Gate::denies('is-user')) {
            return abort(403, 'Unauthorized action.');
        }

        $user = Auth::user();
        $loggedIn = Auth::check();
        Log::info('Index shown, user: ' . (empty($user) ? "-" : $user->getAuthIdentifierName()) . ' logged in: ' . $loggedIn);

        // Load existing tiles
        $service_info = ServiceInfo::orderBy('tile_order')->get();

        $data = [
            'private_space' => env('APP_PRIVATE_SPACE_NAME'),
            'user' => $user,
            'logged_in' => $loggedIn,
            'tiles' => $service_info
        ];

        return view('index', $data);
    }

}
