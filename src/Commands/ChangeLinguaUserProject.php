<?php

namespace alessandrobelli\Lingua\Commands;

use alessandrobelli\Lingua\Tests\User;
use Illuminate\Console\Command;

class ChangeLinguaUserProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lingua:changeprojecttouser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign a project to a user';

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
     * @return false|null
     */
    public function handle()
    {
        $email = $this->ask('Enter user email');
        $user = User::where('email', $email)->first();
        if (! $user) {
            $this->error('user not found.');

            return false;
        }
        $project = $this->ask('Any specific project to assign to '.$user->email.'? (blank for all, comma separated for multiple)');
        if ($user->update(['linguaprojects' => $project])) {
            $this->comment('User assigned to project(s)');
        }
        $this->comment('There it was an error during user creation, please try again.');
    }
}
