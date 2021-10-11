<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Console extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy:console';

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
        
        // copy(resource_path().'/views/vendor/console/window.blade.php', base_path().'/vendor/alkhachatryan/laravel-web-console/resources/views/window.blade.php');
        $this->info('The system has been copied successfully!');
    }

}
