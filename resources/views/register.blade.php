@extends('layout')
@section('title', 'Register')
@section('content')
<div class="container">
<form action="/register" method="POST">
  @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Full Name</label>
    <input name="name" type="text" class="form-control">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Phone Number</label>
    <input name="phone_number" type="number" class="form-control">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Address</label>
    <input name="address" type="text" class="form-control">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input name="email" type="email" class="form-control">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input name="password" type="password" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@endsection