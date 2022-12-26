@extends('adminHome')
@section('contentData')
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST">
               @csrf
               <!-- name -->
               <div class="form-group">
                  <label for="input_category_name" class="font-weight-bold">
                     Name
                  </label>
                  <input id="input_category_name" value="{{ old('name') }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror" />
                  <!-- todo: show message validation (name) -->
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <!-- slug -->
               <div class="form-group">
                  <label for="input_category_slug" class="font-weight-bold">
                     Slug
                  </label>
                  <input id="input_category_slug" value="{{ old('slug') }}" name="slug" type="text" class="form-control @error('slug') is-invalid @enderror" readonly />
                  <!-- todo: show message validation (slug) -->
                  @error('slug')
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>
               <div class="float-right">
                  <a class="btn btn-warning px-4" href="{{ route('categories.index') }}">Back</a>
                  <button type="submit" class="btn btn-primary px-4">Save</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

@endsection
{{-- @push('css-external')
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}">
@endpush

@push('javascript-external')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
@endpush --}}

@push('javascript-internal')
<script>
   // input slug
   $(document).ready(function() {
         $("#input_category_name").change(function (event) {
            $("#input_category_slug").val(
               event.target.value
                  .trim()
                  .toLowerCase()
                  .replace(/[^a-z\d-]/gi, "-")
                  .replace(/-+/g, "-")
                  .replace(/^-|-$/g, "")
            );
         });
        });
</script>
@endpush