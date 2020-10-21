@extends('layouts.main')

@section('content')
    @parent
    <div class="col-4 form signup">
        <div class="form-title">Sign In</div>
        <form>
            @csrf
            <div class="form-group">
                <label for="emailInput">Email address</label>
                <input type="email" class="form-control" id="emailInput" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="nameInput">Name</label>
                <input type="text" class="form-control" id="nameInput">
            </div>
            <div class="form-group">
                <label for="passwordInput">Password</label>
                <input type="password" class="form-control" id="passwordInput">
            </div>
            <div class="form-group">
                <label for="verifyPasswordInput">Password</label>
                <input type="password" class="form-control" id="verifyPasswordInput">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection