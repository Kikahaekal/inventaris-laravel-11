@extends('dashboard.layout')

@section('content')
@if(session('success_edit'))
<script>
    Swal.fire({
        title: "Sucess!",
        text: "{{ session('success_edit') }}",
        icon: "success"
    });
</script>
@endif
    <div class="card">
        <div class="card-body fs-5">
            <h4>{{ $user->name }}'s profile</h4>
            <table class="table table-borderless">
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>{{ $user->email }}</td>
                </tr>
            </table>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#editModal">
                <i class="fa-solid fa-pencil"></i> Edit Profile
            </button>
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editModalLabel">Edit Users</h1>
                        </div>
                        <form action="/user/{{ $user->id }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control mb-2" value="{{ $user->name }}">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control mb-2" value="{{ $user->email }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection