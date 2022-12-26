@foreach ($categories as $category)
<!-- category list -->
<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center pr-0">
   <label class="mt-auto mb-auto">
      <!-- todo: show category name -->
      {{ $category->name }}
   </label>
   <div>
      {{-- <!-- detail -->
      <a href="#" class="btn btn-sm btn-primary" role="button">
        <i class="fas fa-eye"></i>
      </a> --}}
      <!-- edit -->
      <a href="{{route('categories.edit',['category' => $category])}}" class="btn btn-sm btn-info" role="button">
         <i class="fas fa-edit"></i>
      </a>
      <!-- delete -->
      <form class="d-inline" action=" {{ route('categories.destroy', ['category' => $category]) }}" role="alert" method="POST" onclick="return confirm('Hapus Data?')">
         @csrf
         @method('DELETE')
         <button type=" submit" class="btn btn-sm btn-danger">
            <i class=" fas fa-trash"></i>
         </button>
      </form>
   </div>
   <!-- todo:show subcategory -->
</li>
<!-- end  category list -->
@endforeach