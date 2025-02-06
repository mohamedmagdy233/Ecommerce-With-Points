<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GitDeploy extends Command
{
    protected $signature = 'git:deploy';

    protected $description = 'Add, commit, and push changes to the git repository';

    public function handle()
    {


        $branchName = trim(exec('git rev-parse --abbrev-ref HEAD'));
        if (empty($branchName)) {
            $this->error('Could not retrieve the current branch name. Make sure you are in a valid Git repository.');
            return 1;
        }


        exec('git add .');

        exec('git commit -m "' . addslashes($branchName) . ' ' . date('Y-m-d H:i:s') . '"');
        exec('git push');

        $this->info('Done deploying to the ' . $branchName . ' branch.');

        return 0;
    }
}
