<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;

class CompletedTodoTask extends Component
{
    public $todo;
    public $todoId;

    public function toggleTodo($todoId)
    {
        $todo = Todo::find($todoId);
        $todo->completed = !$todo->completed;

        $todo->save();

        return redirect()->route('todos.index');
    }

    public function render()
    {
        return view('livewire.completed-todo-task');
    }
}
