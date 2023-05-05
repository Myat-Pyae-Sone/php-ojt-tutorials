@extends('layouts.app')
@section('content')
    <div class="container col-8 offset-2 mt-3">
        <div class="card">
            <div class="card-header">
                <h5><b>Student Edit</b></h5>
            </div>
            <div class="card-body">
                <form id="studentEditForm" action="{{ route('student.update', $student->id) }}" method="POST">
                    @csrf
                    <div class='mb-3'>
                        <input type="hidden" name="student_id" id="student_id" value="{{ $student->id }}">
                        <label for="">Name</label>
                        <input type="text" name="studentName" id="studentName"
                            value="{{ old('studentName', $student->name) }}"
                            class="form-control @error('studentName') is-invalid @enderror" placeholder="Name">
                        <div id='name-error'></div>
                        @error('studentName')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='mb-3'>
                        <label for="">Major</label>
                        <select name="major" id="major" class="form-control @error('major') is-invalid @enderror">
                            <option value="">Majors</option>
                            @foreach ($majors as $major)
                                <option value="{{ $major->id }}" @if ($student->major_id == $major->id) selected @endif>
                                    {{ $major->name }}</option>
                            @endforeach
                        </select>
                        <div id='major-error'></div>
                        @error('major')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='mb-3'>
                        <label for="">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $student->phone) }}"
                            class='form-control @error('phone') is-invalid @enderror' placeholder="09*********">
                        <div id='phone-error'></div>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='mb-3'>
                        <label for="">Email</label>
                        <input type="email" name="email" id="email"
                            value="{{ old('email', $student->email) }}"class='form-control @error('email') is-invalid @enderror'
                            placeholder="name@gmail.com">
                        <div id='email-error'></div>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class='mb-3'>
                        <label for="">Address</label>
                        <textarea name="address" id="address" cols="30" rows="3"
                            class='form-control @error('address') is-invalid @enderror' placeholder="">{{ old('address', $student->address) }}</textarea>
                        <div id='address-error'></div>
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
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script>
        document.getElementById('studentEditForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const id = document.getElementById('student_id').value;
            const name = document.getElementById('studentName').value;
            const major = document.getElementById('major').value;
            const phone = document.getElementById('phone').value;
            const email = document.getElementById('email').value;
            const address = document.getElementById('address').value;
            const route = `/student/update/${id}`;
            uploadStudentData(name, major, phone, email, address, route);
        })
        const uploadStudentData = (name, major, phone, email, address, route) => {


            axios.post(route, {
                    studentName: name,
                    major: major,
                    phone: phone,
                    email: email,
                    address: address

                })
                .then(function(response) {

                    if (name === "") {
                        const nameErr = document.getElementById("name-error");
                        nameErr.innerHTML = '<small class="text-danger">' + response.data + '</small>';
                    } else {
                        window.location.href = '/';
                    }

                    if (major === "") {
                        const majorErr = document.getElementById("major-error");
                        majorErr.innerHTML = '<small class="text-danger">' + response.data + '</small>';
                    } else {
                        window.location.href = '/';
                    }
                    if (phone === "") {
                        const phoneErr = document.getElementById("phone-error");
                        phoneErr.innerHTML = '<small class="text-danger">' + response.data + '</small>';
                    } else {
                        window.location.href = '/';
                    }
                    if (email === "") {
                        const emailErr = document.getElementById("email-error");
                        emailErr.innerHTML = '<small class="text-danger">' + response.data + '</small>';
                    } else {
                        window.location.href = '/';
                    }
                    if (address === "") {
                        const addressErr = document.getElementById("address-error");
                        addressErr.innerHTML = '<small class="text-danger">' + response.data + '</small>';
                    } else {
                        window.location.href = '/';
                    }
                })
                .catch(function(error) {
                    console.log(error);

                })
        }
    </script>
@endsection
