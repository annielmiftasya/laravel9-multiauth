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
         <div class="card-body">
            <ul class="list-group list-group-flush">
               <!-- list post -->
               <div class="card">
                  <div class="card-body">
                     <h1>
                        {{$post->title}}
                     </h1>
                     <img src="/image/{{ $post->image}}" alt=""><br><br>
                     <p class="text-dark">{{$post->content}}</p>

                     <a>Dibuat pada: {{$post->created_at}}</a>
                  </div>
               </div>

            </ul>
         </div>

      </div>
   </div>
</div>

@endsection