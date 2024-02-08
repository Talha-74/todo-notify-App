<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index()
    {
        $data['users'] = User::all();
        $data['tasks'] = Task::paginate('5');
        return view('tasks.index')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        DB::beginTransaction();
        try {

            Task::create($request->all());

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    public function update(Request $request)
    {
        $task_id = $request->input('task_id');
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        DB::beginTransaction();
        try {

            $task = Task::find($task_id);
            $task->title = $request->title;
            $task->description = $request->description;
            $task->assigned_to = $request->assigned_to;
            $task->status = $request->status;
            $task->update();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    public function destroy($id) {
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }
}
