@extends('auth.app')

@section('content')
<div class="card">
    <div class="card-body register-card-body">

        <p class="login-box-msg">Register a new account</p>

        {{-- Success Message --}}
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <form action="{{ route('register.submit') }}" method="POST">
            @csrf

            {{-- Name --}}
            <div class="input-group mb-3">
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    placeholder="Full Name"
                    value="{{ old('name') }}"
                    required>
                <div class="input-group-text">
                    <span class="bi bi-person"></span>
                </div>
            </div>

            {{-- Email --}}
            <div class="input-group mb-3">
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Email"
                    value="{{ old('email') }}"
                    required>
                <div class="input-group-text">
                    <span class="bi bi-envelope"></span>
                </div>
            </div>

            {{-- Password --}}
            <div class="input-group mb-3">
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Password"
                    required>
                <div class="input-group-text">
                    <span class="bi bi-lock-fill"></span>
                </div>
            </div>

            {{-- Confirm Password --}}
            <div class="input-group mb-3">
                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    placeholder="Confirm Password"
                    required>
                <div class="input-group-text">
                    <span class="bi bi-shield-lock"></span>
                </div>
            </div>


            <div class="row">
                <div class="col-8">
                    <a href="{{ route('login') }}" class="text-decoration-none">
                        Already have account?
                    </a>
                </div>

                <div class="col-4">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            Register
                        </button>
                    </div>
                </div>
            </div>

        </form>

    </div>
</div>
@endsection