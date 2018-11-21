<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
    {
		$user = auth()->user();
		$tasks = Task::where('user_id','=',$user->id)->orderBy('is_complete', 'ASC')->paginate(5);
        return view('task.create', compact('tasks'));
    }
	
	public function store(Request $request)
	{
		$request->validate([
        'title'=>'required'
		]);
		
		$user = auth()->user();
		
		$task = new Task([
			'user_id' => $user->id,
			'title' => $request->get('title'),
			'is_complete'=> 0,
			'created_at' => new \DateTime()
		]);
		$task->save();
		return redirect('/task')->with('success', 'Task Has Been Added');
	}
	
	public function edit($id)
	{
		$task = Task::find($id);
		$task->is_complete = 1;
		$task->updated_at = new \DateTime();
		$task->save();
		return redirect('/task')->with('success', 'Task Compelted');
	}
}
