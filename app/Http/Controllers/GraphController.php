<?php

namespace App\Http\Controllers;

use App\device;
use App\Graph;
use Illuminate\Http\Request;

class GraphController extends Controller
{
    public function add(Request $request)
    {
    	$this->validate($request,[
		    'device_id'=>'required',
		    'name'=>'required',
	    ]);
        $graph = new Graph();
        var_dump($request->name);
        $graph->device_id=$request->device_id;
        $graph->user_id=$request->user()->id;
        $graph->name=$request->name;
	    $graph->save();
        return "{'status':'success'}";
    }
    public function delete(Graph $graph)
    {
        return $graph->delete();
    }
    public function getByUser(Request $request)
    {
        dd($request->user()->with(['graph.device.message'=>function($query)
        {
        	$query->where('topic','data');
        }])->get());
    }
}
