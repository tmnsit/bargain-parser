<?php

namespace App\Console\Commands;

use App\Jobs\ProcessParserBargain;
use Illuminate\Console\Command;



class Parser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bargain:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ProcessParserBargain::dispatch(['numberPage' => 1]);
        return Command::SUCCESS;
    }
}
