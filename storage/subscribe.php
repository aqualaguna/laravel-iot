<?php

require("../vendor/bluerhinos/phpmqtt/phpMQTT.php");
set_time_limit(0);
	
$mqtt = new phpMQTT($argv[0], 1883, "phpMQTT Sub Example"); //Change client name to something unique

if(!$mqtt->connect()){
	exit(1);
}

$topics['#'] = array("qos"=>0, "function"=>"procmsg");
$mqtt->subscribe($topics,0);

while($mqtt->proc()){
		
}


$mqtt->close();

function procmsg($topic,$msg){
	echo "Msg Recieved: ".date("r")."\nTopic:{$topic}\n$msg\n";
}
	


?>
