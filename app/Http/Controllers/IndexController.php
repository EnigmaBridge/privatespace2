<?php
/**
 * Created by PhpStorm.
 * User: dusanklinec
 * Date: 29.03.17
 * Time: 15:05
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
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
        $data = [
            'private_space' => env('APP_PRIVATE_SPACE_NAME')
        ]; // ['user' => User::findOrFail($id)]

        $user = Auth::user();
        $loggedIn = Auth::check();
        Log::info('Index shown, user: ' . $user . ' logged in: ' . $loggedIn);

        return view('index', $data);
    }

}
