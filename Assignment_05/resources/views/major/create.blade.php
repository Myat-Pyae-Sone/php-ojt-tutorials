@extends('layouts.app')
@section('content')
    <div class="container col-8 offset-2 mt-5">
        <div class="card">
            <div class="card-header">
                <h5><b>Major Create</b></h5>
            </div>
            <div class="card-body">
                <form action="{{ route('major.store') }}" method="POST">
                    @csrf
                    <div class='mb-3'>
                        <label for="">Name</label>
                        <input type="text" name="majorName" id="" value="{{ old('majorName') }}"
                            class='form-control @error('majorName') is-invalid @enderror' placeholder="Name">
                        @error('majorName')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <a href="{{ route('major.index') }}" class='btn btn-sm btn-secondary'>Back</a>
                    <input type="submit" class='btn btn-sm btn-primary float-end' value="Create">
                </form>
            </div>
        </div>
    </div>
@endsection
