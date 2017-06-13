<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
require('vendor/bluerhinos/phpmqtt/phpMQTT.php');

class mqtt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:mqtt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'run mqtt indefinitely';

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
     * @return mixed
     */
    public function handle()
    {
    	$cmd = 'php -f mqttDaemon.php '.env('DB_HOST')
		    .' '.env('DB_USERNAME')
		    .' '.env('DB_PASSWORD')
		    .' '.env('DB_DATABASE')
		    .' '.env('MQTT_HOST').' >daemon.log &';
	    $this::info('Ctrl+C after few seconds its normal');
	    $this::warn('DO NOT RUN THIS MULTIPLE TIME! CAUSE MANY MULTIPLE RECORD!');
	    $this::warn('To kill the process type in bash `ps -ef|grep mqtt`');
	    $this::warn('Then type `kill {pid}`');
	    $this::warn($cmd);

	    $process = new Process($cmd);
	    $process->run();

	    // executes after the command finishes
	    if (!$process->isSuccessful()) {
		    throw new ProcessFailedException($process);
	    }

	    $this::info('Running successful');
	    $this::info('to check type \'jobs\'');
    }
}
