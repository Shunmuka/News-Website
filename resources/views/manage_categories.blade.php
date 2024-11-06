@extends('layout')

@section('title', 'Create Category')

@section('content')
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>

<div class="container">
<form id="createCategory">
  @csrf
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="add_category">Add Category</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="category_id" id="category_id">
          <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input type="text" class="form-control" id="categoryName" name="category_name">
            <span id="nameError" class="text-danger error-messages"></span>
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
    <button class="btn btn-dark mb-3" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Category</button>
  </div>
</form>

  <table id="category-table" class="table">
    <thead>
      <tr>
        <th scope="col">S.No</th>
        <th scope="col">Category Name</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      
    </tbody>
  </table>
</div>
@endsection

@push('scripts')
<script>
  $(document).ready(function() {

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var table = $('#category-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('categories.index') }}",
      columns: [
        { data: 'id' },
        { data: 'category_name' },
        { data: 'action', name: 'action', orderable: false, searchable: false },
      ]
    });

    $('#saveBtn').text('Save');
    
    // Reset modal content when it is shown
    $('#exampleModal').on('show.bs.modal', function (e) {
      $('.modal-title').text('Add Category');
      $('#saveBtn').text('Save');
      $('#categoryName').val('');
      $('#category_id').val('');
      $('.error-messages').html('');
    });

    $('#saveBtn').click(function() {
      $('.error-messages').html('');

      var form = $('#createCategory')[0];
      var formData = new FormData(form);

      $.ajax({
        url: '{{ route("categories.store") }}',
        method: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        success: function(response) {
          table.draw();
          $('#exampleModal').modal('hide');
          if(response) {
            Swal.fire({
              title: "Success",
              text: response.success,
              icon: "success"
            });
          }
        },
        error: function(error) {
          console.log(error);
          if (error.responseJSON && error.responseJSON.errors) {
            $('#nameError').html(error.responseJSON.errors.category_name);
          }
        }
      });
    });

    // Edit button functionality
    $('body').on('click', '.editButton', function() {
      var id = $(this).data('id');

      $.ajax({
        url: '{{ route("categories.edit", ":id") }}'.replace(':id', id),
        method: 'GET',
        success: function(response) {
          $('#exampleModal').modal('show');
          $('.modal-title').text('Edit Category');
          $('#saveBtn').text('Save Changes');

          $('#category_id').val(response.id);
          $('#categoryName').val(response.category_name);
        },
        error: function(error) {
          console.log(error);
        }
      });
    });

    // Delete button functionality
    $('body').on('click', '.delButton', function() {
      var id = $(this).data('id');

      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '{{ route("categories.destroy", ":id") }}'.replace(':id', id),
            method: 'DELETE',
            success: function(response) {
              table.draw();
              Swal.fire(
                'Deleted!',
                response.success,
                'success'
              );
            },
            error: function(error) {
              console.log(error);
              Swal.fire(
                'Failed!',
                'There was a problem deleting the category.',
                'error'
              );
            }
          });
        }
      });
    });

  });
</script>
@endpush