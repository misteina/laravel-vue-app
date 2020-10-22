@extends('layouts.main')

@section('content')
    @parent
    <div class="col-4 form signup">
        <div class="form-title">Sign Up</div>&nbsp;&nbsp;&bull;&nbsp;
        <a href="/signin">Sign In</a>
        <div v-if="showError" class="alert alert-danger" role="alert">
            <b>Error!</b>
            <ol>
                <li v-for="error in errors">
                    @{{ error }}
                </li>
            </ol>
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
        <form ref="signup" action="/signup" method="POST">
            @csrf
            <input type="hidden" ref="oldName" value="{{ old('name') }}">
            <input type="hidden" ref="oldEmail" value="{{ old('email') }}">
            <div class="form-group">
                <label for="emailInput">Email address</label>
                <input type="email" v-model="email" name="email" class="form-control" id="emailInput" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="nameInput">Name</label>
                <input type="text" v-model="name" name="name" class="form-control" id="nameInput">
            </div>
            <div class="form-group">
                <label for="passwordInput">Password</label>
                <input type="password" v-model="password" name="password" class="form-control" id="passwordInput">
            </div>
            <div class="form-group">
                <label for="verifyPasswordInput">Password</label>
                <input type="password" v-model="verifyPassword" name="verifyPassword" class="form-control" id="verifyPasswordInput">
            </div>
            <button v-on:click="submitData" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection