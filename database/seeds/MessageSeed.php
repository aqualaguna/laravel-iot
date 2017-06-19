<?php

use Illuminate\Database\Seeder;
use App\MqttMessage;
class MessageSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i=0;$i<50;$i++)
        {
        	$msg = new MqttMessage();
        	$msg->msg=$faker->randomFloat(3,1,10);
        	$msg->created_at=$faker->dateTimeInInterval('now','+ 30 minutes');
        	$msg->topic='/data';
        	$msg->device_id=1;
        	$msg->save();
        }

    }
}
