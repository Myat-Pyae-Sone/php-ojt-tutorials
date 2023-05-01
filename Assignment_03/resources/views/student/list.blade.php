@extends('layouts.app')
@section('content')
    <div class="container col-8 offset-2 mt-3">
        <a href="{{ route('student.create') }}" class="btn btn-sm btn-primary mb-3">Create</a>
        <div class="float-end">
            <a href="{{ route('export.student') }}" class='btn btn-sm btn-primary'>Export</a>
            <a href="{{ route('student.import') }}" class='btn btn-sm btn-primary'>Import</a>
        </div>
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
        @if (session('updateSuccess'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ session('updateSuccess') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5><b>Student Lists</b></h5>
                <form action="{{ route('student.list') }}" method="get" class="d-flex">
                    @csrf
                    <input type="text" name="key" id="" class="form-control" placeholder="search">
                    <button class="btn btn-sm ms-2 btn-dark" type="submit">Search</button>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Major</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->major_name }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->address }}</td>
                                <td>
                                    <a href="{{ route('student.edit', $student->id) }}">
                                        <button class='btn btn-sm btn-success'>Edit</button>
                                    </a>
                                    <a href="{{ route('student.destroy', $student->id) }}">
                                        <button class='btn btn-sm btn-danger'>Delete</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <div class="mt-3">
            {{ $students->links() }}
        </div>
    </div>
@endsection
