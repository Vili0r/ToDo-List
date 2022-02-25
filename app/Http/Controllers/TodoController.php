<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Models\Priority;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::where('user_id', auth()->id())
                ->where('completed', 0)->get();
        $priorities = [
            [
                'label' => 'Low Priority',
                'value' => 'low',
            ],
            [
                'label' => 'Medium Priority',
                'value' => 'medium',
            ],
            [
                'label' => 'High Priority',
                'value' => 'high',
            ]
        ];

        return view('todos.index', compact('todos', 'priorities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required'
        ]);

        $todo = new Todo();
        
        $todo->body = $request->body;
        $todo->user_id = auth()->id();
        $todo->completed = '0';
        $todo->priority = $request->priority;
        $todo->save();

        return redirect()->route('todos.index')->banner('Task created successfully.');
    }
    public function edit(Todo $todo)
    {
        $priorities = [
            [
                'label' => 'Low Priority',
                'value' => 'low',
            ],
            [
                'label' => 'Medium Priority',
                'value' => 'medium',
            ],
            [
                'label' => 'High Priority',
                'value' => 'high',
            ]
        ];

        return view('todos.edit', compact('priorities', 'todo'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'body' => 'required'
        ]);
        
        $todo->body = $request->body;
        $todo->priority = $request->priority;
        $todo->save();

        return redirect()->route('todos.index')->banner('Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {        
        $todo->delete();

        return redirect()->route('todos.index')->dangerBanner('Task deleted successfully.');
    }

}
