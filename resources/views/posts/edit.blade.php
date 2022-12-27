@extends(auth()->user()->type == 'admin'? 'adminHome' : 'home')
@section('contentData')
<div class="row">
   <div class="col-md-12">
      <form action="{{ route('posts.update', ['post' => $post]) }}" method="POST" enctype="multipart/form-data">
         @method('PUT')
         @csrf
         <div class="card">
            <div class="card-body">
               <div class="row d-flex align-items-stretch">
                  <div class="col-md-8">
                     <!-- category -->
                     <!-- parent_category -->
                     <div class="form-group">
                        <label for="select_category" class="font-weight-bold">Post</label>
                        <select class="form-control" id="position-option" name="category_id">
                           @foreach ($categories as $category)
                           <option value="{{ $category->id }}">{{ $category->name }}</option>
                           @endforeach
                        </select>
                     </div>
                     <!-- title -->
                     <div class="form-group">
                        <label for="input_post_title" class="font-weight-bold">
                           Title
                        </label>
                        <input id="input_post_title" value="{{ old('title',$post->title) }}" name="title" type="text" class="form-control form-control @error('title') is-invalid @enderror" placeholder="" />
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     <!-- slug -->
                     <div class="form-group">
                        <label for="input_post_slug" class="font-weight-bold">
                           Slug
                        </label>
                        <input id="input_post_slug" value="{{ old('slug',$post->slug) }}" name="slug" type="text" class="form-control  @error('slug') is-invalid @enderror" placeholder="" readonly />
                        @error('slug')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     <!-- short description -->
                     <div class="form-group">
                        <label for="input_post_description" class="font-weight-bold">
                           Short Description
                        </label>
                        <textarea id="input_post_description" name="short_description" value="{{ old('short_description',$post->short_description) }}" placeholder="" class="form-control @error('short_description') is-invalid @enderror" rows="3">{{ old('short_description',$post->short_description) }}</textarea>
                        @error('short_description')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     <!-- content -->
                     <div class="form-group">
                        <label for="input_post_content" class="font-weight-bold">
                           Content
                        </label>
                        <textarea id="input_post_content" name="content" value="{{ old('content',$post->content) }}" placeholder="" class="form-control @error('content') is-invalid @enderror" rows="15">{{ old('content',$post->content) }}</textarea>
                        @error('content')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     <div class="form-group">
                        <label for="image">Choose Image:</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image',$post->image) }}">
                        <div class="form-text">
                           <img id="preview-image" src="/thumbnail/{{ $post->thumbnail }}" alt="preview image" height="200">
                        </div>
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="float-right">
                        <a class="btn btn-warning px-4" href="{{route('posts.index')}}">Back</a>
                        <button type="submit" class="btn btn-primary px-4">
                           Save
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </form>
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
      $("#input_post_title").change(function(event) {
         $("#input_post_slug").val(
            event.target.value
            .trim()
            .toLowerCase()
            .replace(/[^a-z\d-]/gi, "-")
            .replace(/-+/g, "-")
            .replace(/^-|-$/g, "")
         );
      });
   });

   //input image
   $('#image').change(function() {

      let reader = new FileReader();
      reader.onload = (e) => {
         $('#preview-image').attr('src', e.target.result);
      }
      reader.readAsDataURL(this.files[0]);

   });
</script>
@endpush