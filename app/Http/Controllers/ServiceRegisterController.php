<?php
/**
 * Created by PhpStorm.
 * User: dusanklinec
 * Date: 30.03.17
 * Time: 15:27
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class ServiceRegisterController extends Controller
{
     //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
        if (Gate::denies('is-admin')) {
            Log::info('Non-admin user editing services');
            return redirect()->intended('/');
        }

        $user = Auth::user();
        $loggedIn = Auth::check();


        $data = [
            'private_space' => env('APP_PRIVATE_SPACE_NAME'),
            'user' => $user,
            'logged_in' => $loggedIn
        ];

        return view('services-edit', $data);
    }

}
