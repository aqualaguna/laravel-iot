<?php

namespace App\Http\Controllers;
use App\Jobs\sendMqttCommand;
use DB;
use Mockery\Exception;
use Mosquitto\Client as MosquittoClient;
use App\device;
use App\User;
use Illuminate\Http\Request;
use LibMQTT\Client;
class DeviceController extends Controller
{

	/**
	 * get All Device from current user
	 * login or Personal Access Key or Access Token required
	 * @param Request $request
	 *  none
	 * @return mixed
	 *  json eloquent model of Device item
	 */
	public function getByUser(Request $request)
    {
//	    $users = DB::table('users')
//	               ->whereDate('created_at', '2016-12-31')
//	               ->get();
    	$user = $request->user()->id;
	    return device::with(['graph','message'=>function($query){
		    $query->where('topic','/data');
//	    	$query->whereDate('created_at', DB::raw('CURDATE()'));
	    	$query->orderBy('created_at','DESC');
	    	$query->limit(30);
	    }])->where('user_id',$user)->get();
    }

	/**
	 * add Device to Device Table
	 * login or Personal Access Key or Access Token required
	 * @param Request $request
	 *  validation rules
	 *     'type'=>{String}'required|in:slider,switch'
	 * @return String
	 *  json status
	 */
	public function add(Request $request)
    {
    	$this->validate($request,[
    		'type'=>'required|in:slider,switch'
	    ]);
        return $request->user()->addDevice(
        	new device($request->all())
        );
        return "{status:'success'}";
    }

	/**
	 * Save Current Last Value seen to The device table
	 * login or Personal Access Key or Access Token required
	 * @param Request $request
	 *          id : {device_id}|required
	 *          last_value:{number}|required
	 * @return string
	 *  json Status Transaction
	 */
	public function update(Request $request)
    {
	    var_dump(count($request->all()));
    	if(count($request->all())==1)
	    {
//		    var_dump($request->all()[0]["last_value"]);
//		    var_dump($request->last_value);
//		    var_dump($request->get('last_value'));
//		    var_dump($request["last_value"]);
		    var_dump($request);
		    $dev = device::find($request["id"]);
		    try{
		    	$dev->last_value = $request["last_value"];
		    }
		    catch (Exception $e)
		    {
		        echo $e->getMessage();
		        return;
		    }
		    $dev->save();
	    }
	    else {
		    foreach ($request->all() as $device) {
			    $dev = device::find($device["id"]);
			    $dev->last_value = $device["last_value"];
			    $dev->save();
		    }
	    }
	    return "{'status':'success'}";
    }

	/**
	 * send command to MQTT Device
	 * login or Personal Access Key or Access Token required
	 * @param Request $request
	 *      id:{device_id} |required
	 *      message:{msg} |required
	 * @return string
	 *  json Status Transaction
	 */
	public function sendcmd(Request $request)
    {
//		var_dump($request->id);
//	    $c = new MosquittoClient();
//	    $c->onConnect(function($request) use ($c) {
//		    $c->publish('iot/'.$request->id, $request->message, 2);
//	    });
//
//	    $c->connect(env('MQTT_HOST'));
//
//	    for ($i = 0; $i < 100; $i++) {
//		    // Loop around to permit the library to do its work
//		    $c->loop(1);
//	    }
	    $this->dispatch(new sendMqttCommand($request));
	    return "{'status':'success'}";
    }

	/**
	 * delete a device
	 * @param device $dev
	 *  id:{device_id}
	 * @return mixed
	 */
	public function delete(device $dev)
    {
	    return $dev->delete();
    }
}
