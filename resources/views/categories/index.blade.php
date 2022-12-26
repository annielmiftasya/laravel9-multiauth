@extends('adminHome')
@section('contentData')
<div class="row">
   <div class="col-md-12">
      <H1>Categories</H1>
      @if(session('success'))
      <p class="alert alert-success">{{ session('success') }}</p>
      @endif
      @if(session('error'))
      <p class="alert alert-danger">{{ session('error') }}</p>
      @endif
      @if($errors->any())
      @foreach($errors->all() as $err)
      <p class="alert alert-danger">{{ $err }}</p>
      @endforeach
      @endif
      <div class="card">
         <div class="card-header">
            <div class="row">
               <div class="col-md-6">
                  <div class="col">
                     <a href="{{ route('categories.create') }}" class="btn btn-primary float-left" role="button">
                        Add new
                        <i class="fas fa-plus-square"></i>
                     </a>
                  </div>
                  <form class="row row-cols-lg-auto g-1">
                     <div class="col">
                        <input class="form-control" type="text" name="q" value="{{ $q }}" placeholder="Search here..." />
                     </div>
                     <div class="col">
                        <button class="btn btn-primary">Search</button>
                     </div>
                  </form>

               </div>
            </div>
         </div>
         <div class="card-body">
            <ul class="list-group list-group-flush">
               <!-- list category -->
               @include('categories.list',[
               'categories' => $categories
               ])
            </ul>
         </div>
         <div class="card-footer">
            {{ $categories->links('vendor.pagination.bootstrap-4') }}
         </div>
      </div>
   </div>
</div>

@endsection