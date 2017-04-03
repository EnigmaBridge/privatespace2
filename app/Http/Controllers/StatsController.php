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

class StatsController extends Controller
{
//    use AuthorizesRequests;

    /**
     * StatsController constructor.
     */
    public function __construct()
    {

    }

    /**
     * Show the stats.json
     *
     * @return Response
     */
    public function show()
    {
        if (Gate::denies('is-user')) {
            return $this->notAuthorized();
        }

        $statsFile = env('APP_STATS');
        if (!isset($statsFile) || empty($statsFile) || !file_exists($statsFile)){
            return $this->notFound();
        }

        $json_data = file_get_contents($statsFile);
        return response($json_data, 200)->header('Content-Type', 'application/json');
    }

    /**
     * Not found response
     * @return mixed
     */
    private function notFound(){
        return response()->json([
            'error' => 'not found',
        ], 404);
    }

    /**
     * Not authorized response
     * @return mixed
     */
    private function notAuthorized(){
        return response()->json([
            'error' => 'not authorized',
        ], 403);
    }

}
