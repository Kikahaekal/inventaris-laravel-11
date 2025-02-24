@extends('authentication.layout')

@section('content')
    <form action="/create_user" method="post">
        @csrf
        <h2 class="text-center">Register</h2>

        <div class="mt-3">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="password">Password</label>
                <input type="password" name="password" id="passworf" class="form-control" required>
            </div>
        </div>

        <button class="btn btn-primary w-100 mt-3">Submit</button>
        @section('hrefText')
            <a href="/" class="text-decoration-none">Already have an account?</a>
        @endsection
    </form>
@endsection