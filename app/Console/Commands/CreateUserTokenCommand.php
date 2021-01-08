<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateUserTokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a token for user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $username = $this->ask('Type a User username:');

        if ($user = User::where('username', $username)->first()) {
            $tokenName = $this->ask('Type a token name:');

            $token = $user->createToken($tokenName);

            $this->info('Token is created successfully!');
            $this->info($token->plainTextToken);
        } else {
            $this->info('User is not found!');
        }

        return 0;
    }
}
