<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewDurianTreeRequest;
use Illuminate\Http\Request;

use App\DurianTree;
use App\Transformers\DurianTreeTransformer;

use \Auth;

class DurianTreeController extends Controller
{
    public function create(NewDurianTreeRequest $request) {
    	$data = $request->only(['name','description']);
    	$data['user_id'] = Auth::user()->id;

    	$tree = DurianTree::create($data);

    	return response()->json(['ok' => true, 'data' => fractal($tree, new DurianTreeTransformer)]);
    }

    public function all() {
    	$user = Auth::user();
    	$tree = DurianTree::where('user_id', $user->id)->get();

    	return response()->json(fractal($tree, new DurianTreeTransformer));
    }

    public function show($id) {
    	$tree = DurianTree::findOrFail($id);

    	return response()->json(fractal($tree, new DurianTreeTransformer));
    }

    public function update(NewDurianTreeRequest $request, $id) {
    	$data = $request->only(['name','description']);

    	$tree = DurianTree::findOrFail($id);

    	$tree->update($data);

    	return response()->json(['ok' => true]);
    }
}
