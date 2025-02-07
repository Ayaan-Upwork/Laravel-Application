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
               
                <form id="leadForm" method="POST" action="{{route('lead.update', $lead->id)}}" enctype="multipart/form-data">
                  <div class="d-flex justify-content-between">
                    <a href="{{route('sale.all')}}" class="btn btn-dark mb-2">BACK</a>
                      <button type="submit"  class="btn btn-success mb-2">UPDATE</button>
                  </div>
                  @csrf
                  <div class="row">
                 
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                  
                <div class="col-md-8 mb-3">
                    <label class="form-label">Comment</label>
                    <textarea name="comment" class="form-control">{{ $lead->comment }}</textarea>
                </div>
                <div class="col-md-4 mb-3">
                  <label class="form-label">Upload</label>
                  <input type="file" name="files[]" class="form-control" multiple>
              </div>
              </div>
              </div>

              <h3>Uploaded Files</h3>
              @if($lead->saleFiles->count() > 0)
                  <ul>
                      @foreach($lead->saleFiles as $file)
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
                <a href="{{route('sale.all')}}" class="btn btn-dark mb-2">BACK</a>
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
    });

    

      </script>
  @endpush