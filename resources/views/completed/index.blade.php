<x-app-layout>
    <x-slot name="header">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <x-jet-nav-link href="{{ route('todos.index') }}" :active="request()->routeIs('todos.index')">
                    {{ __('My Priorities') }}
                </x-jet-nav-link>

                {{-- Todo App --}}
                <x-jet-nav-link href="{{ route('completed') }}" :active="request()->routeIs('completed')">
                    {{ __('My Completed Tasks') }}
                </x-jet-nav-link>
            </ul>
        </div>
        </nav>
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
                                
                            </div>

                            
                            <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                                <div class="card-body" data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px">
                    
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Task</th>
                                                <th scope="col">Priority</th>
                                                <th scope="col">Updated at</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($completed as $key=>$todo)
                                                <tr class="fw-normal">
                                                    <th class="align-middle">
                                                        {{ $key+1 }}
                                                    </th>
                                                    <td class="align-middle">
                                                        <livewire:completed-todo-task :todo=$todo :wire:key="'complete-todo-'. $todo->id()">           
                                                    </td>
                                                    <td class="align-middle">
                                                        <h6 class="mb-0">
                                                            @if ($todo->priority === "high")
                                                            <span class="badge rounded-pill bg-danger">High priority</span>
                                                            @elseif($todo->priority === "medium")
                                                            <span class="badge rounded-pill bg-warning text-dark">Medium priority</span>
                                                            @else
                                                            <span class="badge rounded-pill bg-info text-dark">Low priority</span>
                                                            @endif 
                                                        </h6>
                                                    </td>
                                                    <td class="row mt-3 align-middle">
                                                        {{ $todo->updated_at->diffForHumans() }}
                                                    </td>

                                                    <td>
                                                        <form method="POST" action="{{ route('todos.destroy', $todo) }}" class="col">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">
                                                                <i class="fa fa-trash"></i>                                          
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                There are no completed task for you.
                                            @endforelse
                            
                                        </tbody>
                                    </table>
                    
                                </div>
                            </div>
                        </div>
            
                    </div>
                </div>
            </div>
        </section>
    @endauth
    
</x-app-layout>