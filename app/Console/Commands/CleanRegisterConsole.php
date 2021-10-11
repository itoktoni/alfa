<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Modules\Item\Dao\Facades\LinenDetailFacades;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Facades\CardFacades;
use Modules\Linen\Dao\Facades\StockDetailFacades;

class CleanRegisterConsole extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Commands To copy web frontend to vendor console';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        
       
        LinenFacades::query()->truncate();
        LinenDetailFacades::query()->truncate();
        CardFacades::query()->truncate();
        StockDetailFacades::query()->truncate();

        $this->info('The system has been copied successfully!');
    }

}
