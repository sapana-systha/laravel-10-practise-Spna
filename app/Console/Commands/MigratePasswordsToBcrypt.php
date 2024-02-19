<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class MigratePasswordsToBcrypt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-passwords-to-bcrypt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            $user->update([
                'password' => bcrypt($user->password),
            ]);
        }

        $this->info('Passwords migrated to Bcrypt successfully.');
    }
}
