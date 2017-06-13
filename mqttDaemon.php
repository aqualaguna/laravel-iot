<?php

use \Mosquitto\Client as MosquittoClient;
set_time_limit(0);
$client = new MosquittoClient();
$client->onConnect('connect');
$client->onDisconnect('disconnect');
$client->onSubscribe('subscribe');
$client->onMessage('message');
$client->connect($argv[5], 1883, 5); //Change Accordingly. TCP/IP connection is supported by mqtt.
//Please refer to topic/channel semantics [http://mosquitto.org/man/mqtt-7.html]
$client->subscribe('iot/#', 1);

while (true) {
	$client->loop();
}
$client->disconnect();
unset($client);
function connect($r)
{
	echo "I got code {$r}\n";
}
function subscribe()
{
	echo "Subscribed to a topic\n";
}
function message($message)
{

	global $argv;
	$conn = new mysqli($argv[1],$argv[2],$argv[3], $argv[4]);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$first=strpos($message->topic,'/');
	$second=strpos($message->topic,'/',$first+1);
	$clean=substr($message->topic,$first+1);
	$subtopic = substr($clean.'/',strpos($clean.'/','/'));

	if($second)
	{
		$sql = "INSERT INTO mqtt_messages (device_id,msg,created_at,topic)
VALUES (".substr($message->topic,$first+1,$second-$first-1).",'".$message->payload."','".date('Y/m/d h:i:s a', time())."','".$subtopic."')";
	}
	else{
		$sql = "INSERT INTO mqtt_messages (device_id,msg,created_at,topic)
VALUES (".$clean.",'".$message->payload."','".date('Y/m/d h:i:s a', time())."','".$subtopic."')";
	}



	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully\n";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();
}
function disconnect()
{
	echo "Disconnected cleanly\n";
}