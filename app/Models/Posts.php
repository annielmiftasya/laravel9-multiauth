<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'image', 'thumbnail', 'short_description', 'content', 'category_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function removeImage()
    {
        if (File::exists(public_path('image/' . $this->image)) && File::exists(public_path('thumbnail/' . $this->thumbnail))) {
            File::delete(public_path('image/' . $this->image));
            File::delete(public_path('thumbnail/' . $this->thumbnail));
        } else {
            dd('File does not exists.');
        }
    }
}
