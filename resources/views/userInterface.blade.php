@extends('layouts.interface')
@section('content')
<div class="w3-content" style="max-width:1400px">
   <!-- Header -->
   <header class="w3-container w3-center w3-padding-32">
      <h1><b>MY POST</b></h1>
      <p>Welcome to the post of <span class="w3-tag">unknown</span></p>
   </header>

   <!-- Grid -->
   <div class="w3-row">

      <!-- Blog entries -->
      <div class="w3-col l8 s12">
         <!-- Blog entry -->
         @forelse ($posts as $post)
         <div class="w3-card-4 w3-margin w3-white">
            <img src="/image/{{ $post->image }}" alt="Nature" style="width:100%; height: 300px;">
            <div class="w3-container mt-3">
               <h3><b>{{ $post->title }}</b></h3>
               <h5>Category: {{ $post->name }} </h5>
            </div>

            <div class="w3-container">
               <span class="w3-opacity">updated at : {{ $post->created_at }}</span>
               <p>{{ $post->short_description }}</p>

               <div class="w3-row">
                  <div class="w3-col m8 s12 mb-3">
                     <a href="{{route('posts.detail',['post' => $post])}}"><button class="w3-button w3-padding-large w3-white w3-border"><b>READ MORE &raquo;</b></button></a>
                  </div>
                  <div class="w3-col m4 w3-hide-small">
                  </div>
               </div>
            </div>
         </div>
         <hr>
         @empty
         <p>
            <strong>Data posts empty</strong>
         </p>
         @endforelse

         <div class="card-footer">
            {{ $posts->links('vendor.pagination.bootstrap-4') }}
         </div>
      </div>

      <div class="w3-col l4">
         <!-- Search Posts -->
         <div class="w3-card w3-margin">
            <div class="w3-container w3-padding">
               <h4>Search Post</h4>
            </div>
            <form>
               <div class="col">
                  <select class="form-control" id="position-option" name="category_id" placeholder="Choose Category">
                     <option value="">Choose Category</option>
                     @foreach ($categories as $category)
                     <option value="{{ $category->id }}">{{ $category->name }}</option>
                     @endforeach
                  </select>
               </div>
               <div class="col mt-2">
                  <input class="form-control" type="text" name="q" value="{{ $q }}" placeholder="Search here..." />
               </div>
               <div class="col mt-2">
                  <button class="btn btn-primary mb-5">Search</button>
               </div>
            </form>

         </div>

         <div class="w3-card w3-margin">
            <div class="w3-col m8 s12 mb-3">
               <a href="{{route('posts.create',['post' => $post])}}"><button class="w3-button w3-padding-large w3-white w3-border"><b>ADD POST &raquo;</b></button></a>
            </div>
         </div>
         <hr>

      </div>
   </div><br>
</div>
@endsection