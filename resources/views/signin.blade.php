@extends('layouts.main')

@section('content')
    @parent

    <div class="col-4 form">
        <div class="form-title">Sign In</div>
        <div v-bind:style="showError" class="alert alert-danger" role="alert">
            <b>Error!</b>
            Your email or password is invalid.
        </div>
        @php
            if ($errors->any()) $errorList = $errors->all();
            if (isset($error)) $errorList = $error;
        @endphp
        @if (isset($errorList))
            <div class="alert alert-danger" role="alert">
                <b>Error!:</b><br>
                <ul>
                    @foreach ($errorList as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="signin" action="/signin" method="POST">
            @csrf
            <input type="hidden" id="oldEmail" value="{{ old('email') }}">
            <div class="form-group">
                <label for="emailInput">Email address</label>
                <input type="email" name="email" class="form-control" v-model="email" id="emailInput" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="passwordInput">Password</label>
                <input type="password" name="password" class="form-control" v-model="password" id="passwordInput">
            </div>
            <button v-on:click="submitData" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection