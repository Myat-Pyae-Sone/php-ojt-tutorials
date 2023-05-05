@extends('layouts.app')
@section('content')
    <div class="container col-8 offset-2 mt-5">
        <div class="card">
            <div class="card-header">
                <h5><b>Major Create</b></h5>
            </div>
            <div class="card-body">
                <form id="majorCreateForm" action="{{ route('major.store') }}" method="POST">
                    @csrf
                    <div class='mb-3'>
                        <label for="">Name</label>
                        <input type="text" name="majorName" id="name" value="{{ old('majorName') }}"
                            class='form-control @error('majorName') is-invalid @enderror' placeholder="Name">
                        <div id="name-error"></div>
                        @error('majorName')
                            <div class="invalid-feedback" id="name_error">
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
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script>
        document.getElementById('majorCreateForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const name = document.getElementById('name').value;
            const route = `/major/store`;
            uploadMajorData(name, route);
        })
        const uploadMajorData = (name, route) => {
            // alert("name: " + name);
            axios.post(route, {
                    majorName: name
                })
                .then(function(response) {
                    if (name === "") {
                        const nameErr = document.getElementById("name-error");
                        nameErr.innerHTML = '<small class="text-danger">' + response.data + '</small>';
                    } else {
                        window.location.href = '/major';
                    }
                })
                .catch(function(error) {
                    alert("error")
                    console.log(err);
                })
        }
    </script>
@endsection
