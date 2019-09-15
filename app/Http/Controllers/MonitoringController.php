<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Monitoring;
use App\DurianTree;
use App;

class MonitoringController extends Controller
{
    public function create(Request $request) {
    	Monitoring::create([
    		'temperature' => $request->query('temperature'),
    		'humidity' => $request->query('humidity'),
    		'durian_tree_id' => DurianTree::where('api_key', $request->query('key'))->firstOrFail()->id
    	]);

    	return response()->json(['ok' => true]);
    }

    public function records($id) {
    	$data = Monitoring::where('durian_tree_id', $id)->get();

    	return response()->json($data);
    }
}
