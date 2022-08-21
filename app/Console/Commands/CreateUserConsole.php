<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class CreateUserConsole extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user {user} {group}';

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

        $user = $this->argument('user');
        $group = $this->argument('group');

        User::where('username', Str::snake($user))->delete();

        User::create([
            'name' => $user,
            'username' => Str::snake($user),
            'email' => Str::snake($user).'@gmail.com',
            'group_user' => $group,
            'active' => 1,
            'password' => bcrypt( Str::lower($user).'123'),
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);


        $this->info('The system has been copied successfully!');
    }

}
