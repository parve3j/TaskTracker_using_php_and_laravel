<?php


use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;


Route::get('/', function(){
    return redirect()->route('tasks.index');
});

Route::view('/tasks/create','create')->name('tasks.create');

Route::get('/tasks/{task}/edit', function(Task $task){
    return view('edit',[
        'task' => $task
    ]);
})->name('tasks.edit');


Route::get('/tasks/{task}', function(Task $task){
    return view('show',[
        'task' => $task
    ]);
})->name('tasks.show');

Route::post('/tasks', function(TaskRequest $request){
    $data = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'long_description' => 'required',
    ]);

    $task = Task::create($data);
    return redirect()->route('tasks.show',['task'=> $task->id])
    ->with('success','Task created successfully');
})->name('tasks.store');


Route::put('/tasks/{task}', function(Task $task, TaskRequest $request){
    $data = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'long_description' => 'required',
    ]);

    $task = Task::create($data);

    return redirect()->route('tasks.show', ['task' => $task->id])
    ->with('success','Task created successfully');
})->name('tasks.update');


Route::get('/tasks', function (){
    return view('index', [
        'tasks' => Task::latest()->paginate(3),
    ]);
})->name('tasks.index');

Route::delete('/tasks/{task}', function(Task $task){
    $task->delete();
    return redirect()->route('tasks.index')->with('success','Deleted succesfully');
})->name('tasks.destroy');

Route::fallback(function(){
    return 'Still got somewhere';
});

