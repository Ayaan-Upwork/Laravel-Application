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
        <div class="col-12">
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h1 class="card-title">Lead ID   ## {{$lead->id}}</h1>
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
          {{-- {{dd($lead)}} --}}
                <form id="leadForm" method="POST" action="{{route('lead.update', $lead->id)}}" enctype="multipart/form-data">
                  <div class="d-flex justify-content-between">
                    @if (Auth::user()->role =="agent")
                    <a href="{{url()->previous()}}" class="btn btn-dark mb-2">BACK</a> 
                    @else
                    <a href="{{url()->previous()}}" class="btn btn-dark mb-2">BACK</a>
                    @endif
                   
                      <button type="submit"  class="btn btn-success mb-2">UPDATE</button>
                  </div>
                  @csrf
                  <div class="row">
                  <div class="col-md-4 mb-3">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ $lead->name }}" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Closer Agent Name (Optional)</label>
                  <select class="form-control select2" name="clouser" id="state" style="width: 100%;">
                                <option value="{{ $lead->clouser }}">{{ $lead->clousers->name }}</option>
                </select>
              </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Business Name</label>
                    <input type="text" name="business_name" value="{{ $lead->business_name }}" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" value="{{ $lead->phone }}" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" value="{{ $lead->address }}" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Zip</label>
                    <input type="text" name="zip" value="{{ $lead->zip }}" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">State</label>
                    <input type="text" name="state" value="{{ $lead->state }}" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Country</label>
                    <input type="text" name="country" value="{{ $lead->country }}" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Comment</label>
                    <textarea name="comment" class="form-control">{{ $lead->comment }}</textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Upload</label>
                  <input type="file" name="files[]" class="form-control" multiple>
              </div>
              </div>
              </div>

              <h3>Uploaded Files</h3>
              @if($lead->leadFiles->count() > 0)
                  <ul>
                      @foreach($lead->leadFiles as $file)
                          @php
                              $extension = pathinfo($file->file_path, PATHINFO_EXTENSION);
                          @endphp
                          <li>
                              @if(in_array($extension, ['mp3', 'wav']))
                                  <audio controls>
                                      <source src="{{ asset('storage/' . $file->file_path) }}" type="audio/{{ $extension }}">
                                      Your browser does not support the audio element.
                                  </audio>
                              @elseif(in_array($extension, ['jpg', 'jpeg', 'png', 'pdf']))
                                  <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">View File</a>
                              @else
                                  <a href="{{ asset('storage/' . $file->file_path) }}" download>Download File</a>
                              @endif
                          </li>
                      @endforeach
                  </ul>
              @else
                  <p>No files uploaded.</p>
              @endif
                 
              </form>
              <div class="d-flex justify-content-end">
                @if (Auth::user()->role =="agent")
                <a href="{{url()->previous()}}" class="btn btn-dark mb-2">BACK</a>
                    @else
                    <a href="{{url()->previous()}}" class="btn btn-dark mb-2">BACK</a>
                    @endif
               </div> 
            </div>
            
            <!-- /.card-body -->
            <div class="card-footer">Footer 
                </div>
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
            "ordering": true   // Enable column sorting
        });
   
    $('#state').select2({
            // Attach Select2 to modal
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

      </script>
  @endpush