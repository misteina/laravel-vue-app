@extends('layouts.main')

@section('content')
    @parent
    <div class="col-4 form">
        <div class="form-title">Sign In</div>
        <form>
            @csrf
            <div class="form-group">
                <label for="emailInput">Email address</label>
                <input type="email" class="form-control" id="emailInput" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="passwordInput">Password</label>
                <input type="password" class="form-control" id="passwordInput">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection