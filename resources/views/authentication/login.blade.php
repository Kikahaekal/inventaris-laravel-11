@extends('authentication.layout')

@section('content')
    <form action="/login_user" method="post">
        @csrf
        <h2 class="text-center">Login</h2>

        <div class="mt-3">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mt-3">
            <label for="password">Password</label>
            <input type="password" name="password" id="passworf" class="form-control" required>
        </div>

        <button class="btn btn-primary w-100 mt-3">Submit</button>
        @section('hrefText')
            <a href="/register" class="text-decoration-none">Didn't have account yet?</a>
        @endsection
    </form>
@endsection