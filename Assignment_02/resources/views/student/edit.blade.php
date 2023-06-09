@extends('layouts.app')
@section('content')
    <div class="container col-8 offset-2 mt-3">
        <div class="card">
            <div class="card-header">
                <h5><b>Student Edit</b></h5>
            </div>
            <div class="card-body">
                <form action="{{ route('student.update', $student->id) }}" method="POST">
                    @csrf
                    <div class='mb-3'>
                        <label for="">Name</label>
                        <input type="text" name="studentName" id=""
                            value="{{ old('studentName', $student->name) }}"
                            class="form-control @error('studentName') is-invalid @enderror" placeholder="Name">
                        @error('studentName')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='mb-3'>
                        <label for="">Major</label>
                        <select name="major" id="" class="form-control @error('major') is-invalid @enderror">
                            <option value="">Majors</option>
                            @foreach ($majors as $major)
                                <option value="{{ $major->id }}" @if ($student->major_id == $major->id) selected @endif>
                                    {{ $major->name }}</option>
                            @endforeach
                        </select>
                        @error('major')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='mb-3'>
                        <label for="">Phone</label>
                        <input type="text" name="phone" id="" value="{{ old('phone', $student->phone) }}"
                            class='form-control @error('phone') is-invalid @enderror' placeholder="09*********">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='mb-3'>
                        <label for="">Email</label>
                        <input type="email" name="email" id=""
                            value="{{ old('email', $student->email) }}"class='form-control @error('email') is-invalid @enderror'
                            placeholder="name@gmail.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='mb-3'>
                        <label for="">Address</label>
                        <textarea name="address" id="" cols="30" rows="3"
                            class='form-control @error('address') is-invalid @enderror' placeholder="">{{ old('address', $student->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <a href="{{ route('student.index') }}" class='btn btn-sm btn-secondary'>Back</a>
                    <input type="submit" class='btn btn-sm btn-info text-dark float-end' value="Update">
                </form>
            </div>
        </div>
    </div>
@endsection
