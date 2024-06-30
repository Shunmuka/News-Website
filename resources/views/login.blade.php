@extends('layout')
@section('title', 'Login')
@section('content')
<div class="container">
<form action="/login" method="POST">
  @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input name="login_email" type="email" class="form-control">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input name="login_password" type="password" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@endsection