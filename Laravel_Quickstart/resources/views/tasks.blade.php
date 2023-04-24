@extends('layouts.app')
@section('content')
    <div class="panel-body m-3 border border-1 w-50 mx-auto">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Task Form -->
        <form action="{{ route('tasks#addTask') }}" method="POST" class="form-horizontal">
            @csrf

            <!-- Task Name -->
            <div class=" p-2 bg-light w-100 border-1">
                <h6>New Task</h6>
            </div>
            <div class="form-group p-2">
                <label for="task" class="col-sm-3 control-label">Task</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control" required>
                </div>
            </div>

            <!-- Add Task Button -->
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

    <!-- TODO: Current Tasks -->
    @if (count($tasks) > 0)
        <div class="panel panel-default  m-3 border border-1 w-50 mx-auto">
            <div class="panel-heading p-2 bg-light">
                Current Tasks
            </div>

            <div class=" panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Task</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $task['name'] }}</div>
                                </td>

                                <td>
                                    <!-- TODO: Delete Button -->
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
