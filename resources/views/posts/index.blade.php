@extends(auth()->user()->type == 'admin'? 'adminHome' : 'home')
@section('contentData')
<div class="row">
   <div class="col-md-12">
      <H1>Posts</H1>
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
               <div class="col-md-8">
                  <div class="col">
                     <a href="{{ route('posts.create') }}" class="btn btn-primary float-left" role="button">
                        Add new
                        <i class="fas fa-plus-square"></i>
                     </a>
                  </div>
                  <form class="row">
                     <div class="col">
                        <select class="form-control" id="position-option" name="category_id" placeholder="Choose Category">
                           <option value="">Choose Category</option>
                           @foreach ($categories as $category)
                           <option value="{{ $category->id }}">{{ $category->name }}</option>
                           @endforeach
                        </select>
                     </div>
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
               <!-- list post -->
               @forelse ($posts as $post)
               <div class="card">
                  <div class="card-body">
                     <div class="row g-0">
                        <div class="col-md-4">
                           <img src="/image/{{ $post->image }}" class="img-fluid rounded-start" alt="..." style="width: 350px; height:200px">
                        </div>
                        <div class="col-md-8">
                           <div class="card-body">
                              <h5 class="card-title"> {{ $post->title }}</h5>
                              <p class="card-text">{{ $post->short_description }}</p>
                              <p class="card-text"><small class="text-muted">Category: {{ $post->name }}</small></p>
                              <p class="card-text"><small class="text-muted">Last updated {{ $post->created_at }}</small></p>
                           </div>
                        </div>
                     </div>
                     <div class="float-right">
                        <!-- detail -->
                        <a href="{{route('posts.show',['post' => $post])}}" class="btn btn-sm btn-primary" role="button">
                           <i class="fas fa-eye"></i>
                        </a>
                        <!-- edit -->
                        <a href="{{route('posts.edit',['post' => $post])}}" class="btn btn-sm btn-info" role="button">
                           <i class="fas fa-edit"></i>
                        </a>
                        <!-- delete -->
                        <form class="d-inline" action="{{ route('posts.destroy',['post' => $post]) }}" method="POST">
                           @csrf
                           @method('DELETE')
                           <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus Data?')">
                              <i class="fas fa-trash"></i>
                           </button>
                        </form>
                     </div>
                  </div>
               </div>
               @empty
               <p>
                  <strong>Data posts empty</strong>
               </p>
               @endforelse
            </ul>
         </div>
         <div class="card-footer">
            {{ $posts->links('vendor.pagination.bootstrap-4') }}
         </div>
      </div>
   </div>
</div>

@endsection