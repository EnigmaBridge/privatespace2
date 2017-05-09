<?php
/**
 * Created by PhpStorm.
 * User: dusanklinec
 * Date: 09.05.17
 * Time: 12:40
 */

namespace App\Console\Commands;

use App\ServiceInfo;
use Illuminate\Console\Command;

class AddTile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tiles:add {name : name of the tile} {icon : icon} {url : link to the service}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a new service tile to the register';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tileName = $this->argument('name');
        $tileIcon = $this->argument('icon');
        $tileUrl = $this->argument('url');

        // Existence check
        $existing = ServiceInfo::where('tile_name', $tileName)->first();
        if (!isset($existing) || empty($existing)){
            // Get the last order number
            $last_elem = ServiceInfo::orderBy('tile_order', 'desc')->first();
            $order = 1;
            if (isset($last_elem) && !empty($last_elem)){
                $order = $last_elem->tile_order + 1;
            }

            $obj = array();
            $obj['tile_link'] = $tileUrl;
            $obj['tile_name'] = $tileName;
            $obj['tile_icon'] = $tileIcon;
            $obj['tile_order'] = $order;
            ServiceInfo::insert($obj);
            $this->line("Tile record added, order: " . $order);
            return 0;
        }

        // Update
        $existing->tile_name = $tileName;
        $existing->tile_link = $tileUrl;
        $existing->tile_icon = $tileIcon;
        $existing->save();

        $this->line("Tile record updated");
        return 0;
    }
}
