@extends('layout.sidebar')
@section('content')
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Sale List</h3></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lead List</li>
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
        <div class="col-12">
          <!-- Default box -->
          <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title">Sale </h3>
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
                 
                </div>
                <table id="example1" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>AGENT Name </th>
                            <th>Custumer Name </th>
                            <th>Custumer phone </th>
                            <th>Comment</th>                     
                            <th>Status</th>
                            <th>Date</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                      @foreach($leads as $lead)
                      <tr data-lead-id="{{ $lead->id }}">
                        <td>{{ $lead->id }}</td>
                        <td>{{ $lead->lead->name }}</td>   
                        <td>{{ $lead->lead->user->name }}</td>           
                        <td>{{ $lead->lead->phone }}</td>              
                          <td>{{ $lead->comment }}</td>                  
                        
                          <td>
                            @if ($lead->status == "Rejected")
                            <span class="badge text-bg-danger">{{ $lead->status }}</span>
                        @elseif ($lead->status == "Pending")
                            <span class="badge text-bg-warning">{{ $lead->status }}</span>
                        @elseif ($lead->status == "Sale")
                            <span class="badge text-bg-dark">{{ $lead->status }}</span>
                        @else
                            <span class="badge text-bg-success">{{ $lead->status }}</span>
                        @endif
                          
                          </td> 
                          <td>{{ \Carbon\Carbon::parse($lead->created_at)->format('d M Y') }}</td>    
                          <td>
                            <div class="btn-group mb-2" role="group" aria-label="Button group with nested dropdown">
                              <a href="{{route( 'sale.edit', $lead->id)}}"   class="btn btn-info"><i class="nav-icon bi bi-eye"></i></a>
                              {{-- <button type="button" class="btn btn-primary"><i class="nav-icon bi bi-trash"></i></button> --}}
                              
                              <div class="btn-group" role="group">
                                  <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                      Change Status
                                  </button>
                                  <ul class="dropdown-menu">
                                      <li><a class="dropdown-item status-change" href="#" data-status="Pending">Pending</a></li>
                                      <li><a class="dropdown-item status-change" href="#" data-status="Sale">Sale</a></li>
                                      <li><a class="dropdown-item status-change" href="#" data-status="Rejected">Rejected</a></li>
                                  </ul>
                              </div>
                          </div>
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

  
        $(".status-change").click(function(e) {
            e.preventDefault();
            
            var newStatus = $(this).data("status");
        var leadId = $(this).closest("tr").data("lead-id"); // Get lead ID from row

            $.ajax({
                url: "{{ route('sale.updateStatus') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    sale: leadId,
                    status: newStatus
                },
                success: function(response) {
                    alert("Status changed to " + newStatus);
                    location.reload(); 
                },
                error: function(xhr) {
                    alert("Failed to update status!");
                }
            });
        });
    

      </script>
  @endpush