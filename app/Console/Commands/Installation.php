<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Installation extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:system';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Commands To Make index, and .htaccess';

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
        
        copy(base_path().'/public/files/logo/default_favicon.png', '../favicon.ico');
        Artisan::call('key:generate');
        if(!file_exists(base_path().'/env/local.env')){
            copy(base_path().'/.env', 'env/local.env');
            copy(base_path().'/.env', 'env/production.env');
        }
        copy(base_path().'/index.example', '../index.php');
        copy(base_path().'/.htaccess', '../.htaccess');
        copy(base_path().'/robots.txt', '../robots.txt');
        $this->info('The system has been Install successfully!');
    }

}
