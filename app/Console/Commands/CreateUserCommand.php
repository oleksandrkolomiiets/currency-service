<?php

namespace App\Console\Commands;

use App\Repositories\UserRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUserCommand extends Command
{
    protected UserRepository $repository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user';

    /**
     * Create a new command instance.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $username = $this->ask('Type username:');
        $password = $this->secret('Type password:');

        $data = [
            'username' => $username,
            'password' => Hash::make($password),
        ];

        try {
            $user = $this->repository->create($data);

            $this->info("The user $user->username has been successfully created!");
        } catch (\Exception $exception) {
            $this->error('Something went wrong!');
            $this->info($exception->getMessage());
        }

        return 0;
    }
}
