<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use LibMQTT\Client;
use \Mosquitto\Client as MosquittoClient;
class sendMqttCommand implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
    	//using mgddm library
//	    $client = new MosquittoClient("tsetsopa90jmjn98js0dj");
//	    $client->connect(env('MQTT_HOST','localhost'), 1883, 60);
//
//	    while ($client->loop() == 0) {
//		    $message = "Test message at " . date("Y-m-d H:i:s");
//		    $client->publish('iot/'.$request->id, $request->message, 0, false);
//		    $client->loop();
//		    sleep(1);
//		    return;
//	    }
	    //using libmqtt/client
	    $client = new Client(env('MQTT_HOST'),1883,"asdasd");
	    $result = $client->connect();
        $client->publish("iot/".$request->id, $request->message, 0);
        $client->close();
        return $result;
    }
}
