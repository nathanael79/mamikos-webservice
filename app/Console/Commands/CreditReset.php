<?php

namespace App\Console\Commands;

use App\Http\Service\UserService;
use Illuminate\Console\Command;

class CreditReset extends Command
{
    private $userService;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'credit:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset User Credit';

    /**
     * Create a new command instance.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->userService->resetCredit();
    }
}
