@extends('layout')

@section('title', 'News Listings')

@section('content')
<div class="container">
<form id="createCategory">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
        <label class="form-label">Category Name</label>
        <input type="text" class="form-control" id="categoryName" name="category_name">
        <span id="nameError" class="text-danger"></span>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveBtn">Save changes</button>
      </div>
    </div>
  </div>
</div>

  <div class="d-grid gap-2">
    <button class="btn btn-dark" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Category</button>
  </div>
</form>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">


<script>
  $(document).ready(function() {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


    $('#categoryName').html('Add Category');
    $('#saveBtn').html('Create');
    var form = $('#createCategory')[0];
    $('#saveBtn').click(function() {
    var formData = new FormData(form);


      $.ajax({
          url: '{{ route("categories.store") }}',
          method: 'POST',
          processData: false,
          contentType: false,
          data: formData,

          success: function (response) {
            console.log(response);
          },
          error: function(error) {
            console.log(error);
            if(error) {
              $('#nameError').html(error.responseJSON.errors.category_name);
            }
          }
      });
  })
});
</script>
@endpush


