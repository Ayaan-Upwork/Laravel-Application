@extends('layout.sidebar')
@section('content')
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
      <!--begin::Row-->
      <div class="row">
        <div class="col-sm-6"><h3 class="mb-0">Lead List</h3></div>
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
          <div class="card card-outline card-warning">
            <div class="card-header">
              <h3 class="card-title">Lead add</h3>
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
                    <button type="button" data-bs-toggle="modal" data-bs-target="#leadModal" id="openLeadModal" class="btn btn-primary mb-2">+ ADD LEAD</button>
                </div>
                <table id="example1" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>phone</th>
                            <th>adress</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($leads as $lead)
                      @if ($lead->status == "Pending")
                      <tr data-lead-id="{{ $lead->id }}">
                        <td>{{ $lead->id }}</td> 
                        <td>{{ $lead->name ?? 'N/A' }}</td> <!-- Show name or 'N/A' if null -->
                        <td>{{ $lead->phone }}</td> 
                        <td>{{ $lead->address }}</td>  
                                    
                          
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
                              <a href="{{ route('lead.edit', $lead->id) }}" class="btn btn-info edit-btn" data-id="{{ $lead->id }}">
                                <i class="nav-icon bi bi-pencil-square"></i>
                            </a>                              {{-- <button type="button" class="btn btn-danger"><i class="nav-icon bi bi-trash"></i></button> --}}
                              
                            @if ($lead->status == "Approved" || $lead->status == "Sale")
                             
                              {{-- @if($sales[$lead->id]->isEmpty()) <!-- Check if no sales for this lead --> --}}
                              <!-- No sales, show the "Add Sale" button -->
                              <button type="button" data-bs-toggle="modal" data-bs-target="#saleModal" data-id="{{ $lead->id }}" data-sale="{{ json_encode($sales[$lead->id]) }}"  class="btn btn-warning sale-btn">ADD Sale</button>
                              @endif
                          {{-- @else
                              <!-- Sales exist, show the sale data -->
                              <div class="sales">
                                  @foreach($sales[$lead->id] as $sale)
                                      <p>Sale Date: {{ $sale->sale_date }}</p>
                                      <p>Amount: {{ $sale->amount }}</p>
                                      <!-- Add any other sale details here -->
                                  @endforeach
                              </div>
                          @endif --}}

                             
                          </div>
                        </td>  

                      </tr>
                      @endif
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
                        <h5 class="modal-title" id="leadModalLabel">Add New Lead</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form id="leadForm" method="POST" action="{{ route('lead.store') }}" enctype="multipart/form-data">

                            @csrf
                            <div class="row">

                             
                              <div class="col-md-6 mb-3">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <label class="form-label">Name <span style="color:rgb(255, 0, 0)">(required) </span></label>
                                  <input type="text" name="name" class="form-control" required>
                              </div>
                              <div class="col-md-6 mb-3">
                                <label class="form-label">Closer Agent Name (Optional)</label>
                                <select class="form-control select2" name="state" id="state" style="width: 100%;">
                                  <option value="">Select a state</option>
                                  <option value="">Select a state</option>
                                  <option value="">Select a state</option>
                                  <option value="">Select a state</option>
                              </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                  <label class="form-label">Business Name  (Optional)</label>
                                  <input type="text" name="business_name" class="form-control" >
                              </div>
                              <div class="col-md-6 mb-3">
                                  <label class="form-label">Phone <span style="color:rgb(255, 0, 0)">(required) </span></label>
                                  <input type="text" name="phone" class="form-control" required>
                              </div>
                              <div class="col-md-6 mb-3">
                                  <label class="form-label">Address (Optional)</label>
                                  <input type="text" name="address" class="form-control">
                              </div>
                              <div class="col-md-6 mb-3">
                                  <label class="form-label">Zip (Optional)</label>
                                  <input type="text" name="zip" class="form-control">
                              </div>
                              <div class="col-md-6 mb-3">
                                  <label class="form-label">State (Optional)</label>
                                  <input type="text" name="state" class="form-control">
                              </div>
                              <div class="col-md-6 mb-3">
                                  <label class="form-label">Country (Optional)</label>
                                  <input type="text" name="country" class="form-control">
                              </div>
                              <div class="col-md-6 mb-3">
                                  <label class="form-label">Comment  <span style="color:rgb(255, 0, 0)">(required) </span></label>
                                  <textarea name="comment" class="form-control"></textarea>
                              </div>
                              <div class="col-md-6 mb-3">
                                <label class="form-label">Upload (Optional) </label>
                                <input type="file" name="files[]" class="form-control" multiple>
                            </div>
                          </div>
                            <button type="submit" class="btn btn-success">Save Lead</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> 

        <div class="modal fade" id="saleModal" tabindex="-1" aria-labelledby="leadModalLabell" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="leadModalLabell">  Sale </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  
                  <div class="modal-body">
                    <div id="saleData">
                      <!-- Sale details will go here -->
                  </div>
                    <form id="saleForm" method="POST" action="{{ route('sale.store') }}" enctype="multipart/form-data">

                          @csrf
                          <div class="mb-3">
                            <input type="hidden" name="user_id" id="user_id" value="">
                         
                          <div class="mb-3">
                              <label class="form-label">Comment</label>
                              <textarea name="comment" class="form-control"></textarea>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Upload</label>
                            <input type="file" name="files[]" class="form-control" multiple>
                        </div>
                          <button type="submit" class="btn btn-success">Save Lead</button>
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
    $('.sale-btn').on('click', function() {
        let leadId = $(this).data('id'); // Get data-id from clicked button
        $('#user_id').val(leadId); // Set value in hidden input
    });
    $('#leadModal').on('shown.bs.modal', function () {
        $('#state').select2({
            dropdownParent: $('#leadModal'), // Attach Select2 to modal
            ajax: {
            url: '{{ route('get.user') }}', // Laravel route
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                      return {
                        id: item.id,
                        text: item.name + ' (' + item.email + ')' // Display state name and email
                    };
                    })
                };
            }
        }
        });
    });

    let table =  $('#example1').DataTable({
            "searching": true, // Enable searching
            "paging": true,    // Enable pagination
            "order": [[0, "desc"]], // Enable column sorting           
          "pageLength": 10
       
        });
        let savedPage = sessionStorage.getItem('datatable_page');
    if (savedPage !== null) {
        table.page(parseInt(savedPage)).draw(false); // Move to the saved page
        sessionStorage.removeItem('datatable_page'); // Clear after use
    }
    $(document).on('click', '.edit-btn', function () {
      let currentPage = table.page.info().page;
      sessionStorage.setItem('datatable_page', currentPage);
});
    });
   
    $(document).ready(function() {
    // $("#saleModal").modal("show"); // Auto-show Sale Modal
    $("#openLeadModal").click(function() {
        $("#leadModal").modal("show");
    }); // Auto-show Lead Modal
});
    $(document).ready(function() {
    $(".status-change").click(function(e) {
        e.preventDefault();

        var newStatus = $(this).data("status");
        var leadId = $(this).closest("tr").data("lead-id"); // Get lead ID from row

        $.ajax({
            url: "{{ route('lead.updateStatus') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                lead_id: leadId,
                status: newStatus
            },
            success: function(response) {
                alert("Status changed to " + newStatus);
                location.reload(); // Reload page to reflect changes
            },
            error: function(xhr) {
                alert("Failed to update status!");
            }
        });
    });


    $('#saleModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var leadId = button.data('id'); // Extract the lead ID from the button
    var saleData = button.data('sale'); // Extract sale data passed to the modal

    var modal = $(this);
    var saleDataContainer = modal.find('#saleData');
    var saleForm = modal.find('#saleForm');

    // Check if sales data exists for this lead
    if (saleData && saleData.length > 0) {
        saleForm.hide(); // Hide the form if sales data exists

        // Show the sale data
        saleDataContainer.empty(); // Clear any previous content
        saleData.forEach(function(sale) {
            saleDataContainer.append(
                '<p> Comment: ' + sale.comment + '</p>'               
            );
            console.log(sale.sale_files);
            // Display attached files
            if (sale.sale_files && Array.isArray(sale.sale_files) && sale.sale_files.length > 0) {
    saleDataContainer.append('<p><strong>Files:</strong></p>');
    let storageBaseUrl ="http://localhost/myapp/public/storage/";
    sale.sale_files.forEach(function(file) {
      let filePath = file.file_path.startsWith('/') ? file.file_path.substring(1) : file.file_path; // Remove leading slash if present
      let fileUrl = `${storageBaseUrl}/${filePath}`;
      let extension = file.file_path.split('.').pop().toLowerCase(); // Extract file extension
        console.log(extension);
        if (['mp3', 'wav'].includes(extension)) {
            saleDataContainer.append(`
                <p>Audio File:</p>
                <audio controls>
                    <source src="${fileUrl}" type="audio/${extension}">
                    Your browser does not support the audio element.
                </audio><br>
            `);
        } else if (['jpg', 'jpeg', 'png'].includes(extension)) {
            saleDataContainer.append(`
                <p>Image File:</p>
                <img src="${fileUrl}" alt="Image" style="max-width: 100%; height: auto;"><br>
            `);
        } else if (extension === 'pdf') {
            saleDataContainer.append(`
                <p>PDF File:</p>
                <embed src="${fileUrl}" type="application/pdf" width="100%" height="500px" /><br>
                <a href="${fileUrl}" target="_blank">View PDF</a><br>
            `);
        } else {
            saleDataContainer.append(`
                <p>Other File:</p>
                <a href="${fileUrl}" download>Download File</a><br>
            `);
        }
    });
}
        });
    } else {
        saleDataContainer.empty(); // Clear any sale data
        saleForm.show(); // Show the form to add a new sale
    }
});


});





      </script>
  @endpush