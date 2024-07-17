@extends('layout')

@section('title', 'Login')

@section('content')
<div class="container">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="loginForm" action="/login" method="POST">
        @csrf
        <div class="mb-3">
            <label for="login_email" class="form-label">Email address</label>
            <input name="login_email" type="email" class="form-control" id="login_email" required>
        </div>
        <div class="mb-3">
            <label for="login_password" class="form-label">Password</label>
            <input name="login_password" type="password" class="form-control" id="login_password" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>
<script>
    $(document).ready(function () {
        $('#loginForm').validate({
            rules: {
                login_email: {
                    required: true,
                    email: true
                },
                login_password: {
                    required: true
                }
            },
            messages: {
                login_email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                login_password: {
                    required: "Please enter your password"
                }
            },
            errorElement: 'div',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.mb-3').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endsection
