@extends('layouts.dashboard')
@section('content')
<div class="row ml-auto mr-auto">
   <div class="col-md-12">
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