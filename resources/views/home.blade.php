@extends('layout.sidebar')
@section('content')
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">User List</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">User List</li>
          </ol>
        </div>
      </div>
      <!--end::Row-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::App Content Header-->
  <!--begin::App Content-->
  <div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-12">
          <!-- Default box -->
          @if(session('success'))      

          <div id="toastSuccess" class="toast toast-success fade show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
              <i class="bi bi-circle me-2"></i>
              <strong class="me-auto">Updated </strong> <small>1 sec ago</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">{{ session('success')}}</div>
          </div>
    
  @endif
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">user add</h3>
              <div class="card-tools">
                <button
                  type="button"
                  class="btn btn-tool"
                  data-lte-toggle="card-collapse"
                  title="Collapse"
                >
                  <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                  <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                </button>
                <button
                
                  class="btn btn-tool"
               
                  title="Remove"
                >
                  <i class="bi bi-x-lg"></i>
                </button>
              </div>
            </div>
            <div class="card-body"> 
                <div class="d-flex justify-content-end">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#leadModal" class="btn btn-primary mb-2">Add User</button>
                </div>
                <table id="example1" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td> 
                               <button type="button" data-bs-toggle="modal" data-bs-target="#passModal"  data-user-id="{{ $user->id }}" class="btn btn-info mb-2">new pass</button>
                              </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">Footer</div>
            <!-- /.card-footer-->
          </div>
          <!-- /.card -->

          <div class="modal fade" id="leadModal" tabindex="-1" aria-labelledby="leadModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="leadModalLabel">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="leadForm" action="{{route('user.store')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email"  class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="text" name="pass" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success">Save Lead</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
          <div class="modal fade" id="passModal" tabindex="-1" aria-labelledby="leadModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="leadModalLabel">Add New Lead</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="leadForm" action="{{route('user.pass')}}" method="post" >
                            @csrf
                            <div class="mb-3">
                              <input type="hidden" name="user_id" id="user_id">
                                <label class="form-label">New Password</label>
                                <input type="text" name="new_pass" class="form-control" required>
                            </div>                                                  
                            <button type="submit" class="btn btn-success">Generate Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
    </div>


        </div>
      </div>
      <!--end::Row-->
    </div>
  </div>
  @endsection
  @push('stript')
      <script>
  $(document).ready(function () {
        $('#example1').DataTable({
            "searching": true, // Enable searching
            "paging": true,    // Enable pagination
            "order": [[0, "desc"]]   // Enable column sorting
        });
    });
    $('#passModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var userId = button.data('user-id'); // Extract user ID from data attribute
        
        var modal = $(this);
        modal.find('#user_id').val(userId); // Set user ID in the hidden input field
    });
      </script>
  @endpush