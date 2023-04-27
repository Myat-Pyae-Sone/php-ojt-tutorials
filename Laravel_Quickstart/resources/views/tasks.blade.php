@extends('layouts.app')
@section('content')
    <div class="w-50 mx-auto mt-3">
        @if (session('createSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('createSuccess') }}
            </div>
        @endif
        @if (session('deleteSuccess'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('deleteSuccess') }}
            </div>
        @endif
    </div>
    <div class="panel-body m-3 border border-1 w-50 mx-auto">
        @include('common.errors')
        <form action="{{ route('tasks#addTask') }}" method="POST" class="form-horizontal">
            @csrf
            <div class=" p-2 bg-light w-100 border-1">
                <h6>New Task</h6>
            </div>
            <div class="form-group p-2">
                <label for="task" class="col-sm-3 control-label">Task</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control">

                </div>
            </div>
            <div class="form-group
                        p-2">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-light rounded">
                        <i class="fa fa-plus"></i> Add Task
                    </button>
                </div>
            </div>
        </form>
    </div>
    @if (count($tasks) > 0)
        <div class="panel panel-default  m-3 border border-1 w-50 mx-auto">
            <div class="panel-heading p-2 bg-light">
                Current Tasks
            </div>

            <div class=" panel-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>Task</th>
                        <th>&nbsp;</th>
                    </thead>

                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td class="table-text">
                                    <div>{{ $task['name'] }}</div>
                                </td>

                                <td>
                                    <form action="{{ url('deleteTask/' . $task['id']) }}" method="POST">
                                        @csrf
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection
