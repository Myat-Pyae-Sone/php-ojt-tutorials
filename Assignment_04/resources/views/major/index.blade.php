@extends('layouts.app')
@section('content')
    <div class="container col-8 offset-2 mt-3">
        <a href="{{ route('major.create') }}" class="btn btn-primary mb-3">Create</a>
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
            <div class="card-header">
                <h5><b>Major Lists</b></h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($majors as $major)
                            <tr id="{{ $major['id'] }}">
                                <td>{{ $major['id'] }} </td>
                                <td>{{ $major['name'] }}</td>
                                <td>
                                    <a href="{{ route('major.edit', $major['id']) }}">
                                        <button class='btn btn-sm btn-success'>Edit</button>
                                    </a>
                                    <a href="{{ route('major.destroy', $major['id']) }}">
                                        <button class='btn btn-sm btn-danger'
                                            onclick="deleteMajorData(event,{{ $major->id }})">Delete</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-3">
            {{ $majors->links() }}
        </div>
    </div>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script>
        const deleteMajorData = (e, id) => {
            e.preventDefault();
            axios.get(`/major/${id}`)
                .then((response) => {
                    const data = document.querySelector(`table tbody tr[id="${id}"]`);
                    if (data) {
                        data.remove();
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
        }
    </script>
@endsection
