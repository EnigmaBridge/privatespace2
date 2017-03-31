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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;

use App\ServiceInfo;

class ServiceRegisterController extends Controller
{
     //use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * ServiceRegisterController constructor.
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

        // Load existing tiles
        $service_info = ServiceInfo::orderBy('tile_order')->get();

        $data = [
            'private_space' => env('APP_PRIVATE_SPACE_NAME'),
            'user' => $user,
            'logged_in' => $loggedIn,
            'tiles' => $service_info
        ];

        return view('services-edit', $data);
    }

    /**
     * Stores the changes
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        if (Gate::denies('is-admin')) {
            Log::info('Non-admin user editing services');
            return redirect()->intended('/');
        }

        $tile_link = Input::get('tile_link');
        $tile_name = Input::get('tile_name');
        $tile_icon = Input::get('tile_icon');
        $objects = array();

        for($i = 0; $i < count($tile_link); $i++){
            if (empty($tile_link[$i])){
                continue;
            }

            $obj = array();
            $obj['tile_link'] = $tile_link[$i];
            $obj['tile_name'] = $tile_name[$i];
            $obj['tile_icon'] = $tile_icon[$i];
            $obj['tile_order'] = $i;
            array_push($objects, $obj);
        }

        // Removing all existing tiles
        ServiceInfo::truncate();

        // Store new objects here.
        ServiceInfo::insert($objects);
        return $this->show();
    }
}
