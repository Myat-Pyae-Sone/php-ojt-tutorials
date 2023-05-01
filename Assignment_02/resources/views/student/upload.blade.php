@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('importSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('importSuccess') }}
            </div>
        @endif
        <div class="card mt-5 w-75 mx-auto">
            <div class="card-header">
                <h5>
                    <b>Export Import Students</b>
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <input type="file" name="file" id="">
                    </div>
                    <button class="btn btn-dark">Import Students</button>
                    <a href="{{ route('export.student') }}" class="btn btn-warning">Export Students</a>
                </form>
            </div>
        </div>
    </div>
@endsection
