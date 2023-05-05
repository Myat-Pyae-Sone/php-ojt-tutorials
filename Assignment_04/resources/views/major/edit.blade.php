@extends('layouts.app')
@section('content')
    <div class="container col-8 offset-2 mt-5">
        <div class="card">
            <div class="card-header">
                <h5><b>Major Edit</b></h5>
            </div>
            <div class="card-body">
                <form id="majorEditForm" action="{{ route('major.update', $major['id']) }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="major_id" value="{{ $major->id }}">
                    <div class='mb-3'>
                        <label for="">Name</label>
                        <input type="text" name="majorName" id="name" value="{{ old('majorName', $major->name) }}"
                            class='form-control @error('majorName') is-invalid @enderror' placeholder="Name">
                        <div id='name-error'></div>
                        @error('majorName')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <a href="{{ route('major.index') }}" class='btn btn-sm btn-secondary'>Back</a>
                    <input type="submit" class='btn btn-sm btn-info text-dark float-end' value="Update">
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script>
        document.getElementById('majorEditForm').addEventListener('submit', (e) => {
            e.preventDefault();

            const id = document.getElementById('major_id').value;
            const name = document.getElementById('name').value;
            const route = `/major/update/${id}`;
            uploadMajorData(name, route);
        })

        const uploadMajorData = (name, route) => {

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
                    console.log(error);
                })
        }
    </script>
@endsection
