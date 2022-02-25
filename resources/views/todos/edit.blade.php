<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Update My Priorities') }}
        </h2>
    </x-slot>

    @if(session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <x-jet-validation-errors class="mb-3" />

    @auth
        <section class="vh-100" style="background-color: #e2d5de;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-12 col-xl-10">
            
                        <div class="card">
                            <div class="card-header p-3">
                                <form method="POST" action="{{ route('todos.update', $todo) }}" class="d-flex justify-content-center align-items-center mb-4 gap-3">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                    
                                        <div class="form-outline flex-fill">
                                            <x-jet-label for="body" value="{{ __('What do you need to do today?') }}" />
                                            <input id="body" class="form-control form-control-lg mt-2" type="text" name="body"
                                                            value="{{ $todo->body }}" >
                                            <x-jet-input-error for="body"></x-jet-input-error>
                                        </div>
                                        <div class="form-outline flex-fill">
                                            <x-jet-label for="priority" value="{{ __('Choose the priority') }}" />
                                            <select name="priority" id="priority" class="form-control">
                                                <option value="">Select a Priority</option>
                                                @foreach ($priorities as $priority)
                                                    <option value="{{ $priority['value'] }}"
                                                            {{ $todo->priority === $priority['value'] ? 'selected' : '' }}>{{ $priority['label'] }}</option>
                                                @endforeach
                                            </select>
                                            <x-jet-input-error for="priority"></x-jet-input-error>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endauth
    
</x-app-layout>
