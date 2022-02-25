<div>
    <input wire:change="toggleTodo({{ $todo->id }})" {{ $todo->completed ? 'checked' : '' }} 
        class="form-check-input me-2" type="checkbox" aria-label="..."/>
    @if(!$todo->completed)
    {{ $todo->body }}
    @else 
    <s>{{ $todo->body }}</s>
    @endif 
</div>
