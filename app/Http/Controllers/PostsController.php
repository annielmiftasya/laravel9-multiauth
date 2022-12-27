<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::get();
        $category = request()->category_id;
        $data['q'] = $request->query('q');
        $data['posts'] = Posts::leftJoin('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.*', 'categories.name')
            ->where('category_id', 'like', '%' . $category . '%')
            ->where('title', 'like', '%' . $data['q'] . '%')
            ->paginate(5)
            ->withQueryString();
        return view('posts.index', $data, compact('categories'));
    }

    public function userInterface(Request $request)
    {
        $categories = Category::get();
        $category = request()->category_id;
        $data['q'] = $request->query('q');
        $data['posts'] = Posts::leftJoin('categories', 'posts.category_id', '=', 'categories.id')
            ->select('posts.*', 'categories.name')
            ->where('category_id', 'like', '%' . $category . '%')
            ->where('title', 'like', '%' . $data['q'] . '%')
            ->paginate(5)
            ->withQueryString();
        return view('userInterface', $data, compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Posts $post)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required|string',
            'slug' => 'required|string|unique:posts,slug',
            'short_description' => 'required|string',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        // image upload

        $image = $request->file('image');
        $input['imagename'] = time() . '.' . $image->extension();
        $thumbnail = "small_" . $input['imagename'];
        $destinationPath = public_path('/thumbnail');
        $img = Image::make($image->path());
        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $thumbnail);


        $destinationPath = public_path('/image');
        $image->move($destinationPath, $input['imagename']);
        $data['image'] = $input['imagename'];
        $data['thumbnail'] = $thumbnail;
        try {
            $post->create($data);
            return redirect()->route('posts.index')->with('success', 'Data Berhasil DiTambah');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $post)
    {
        //
        $data['post'] = $post;
        return view('posts.show', $data);
    }

    public function detail(Posts $post)
    {
        //
        $data['post'] = $post;
        return view('posts.detail', $data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $post)
    {
        //
        $categories = Category::get();
        $data['post'] = $post;
        return view('posts.edit', $data, compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $post)
    {
        //
        $request->validate([
            'category_id' => 'required',
            'title' => 'required|string',
            'slug' => 'required|string',
            'short_description' => 'required|string',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $data = $request->all();
        if ($image = $request->file('image')) {
            $post->removeImage();
            $input['imagename'] = time() . '.' . $image->extension();
            $thumbnail = "small_" . $input['imagename'];
            $destinationPath = public_path('/thumbnail');
            $img = Image::make($image->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $thumbnail);
            $destinationPath = public_path('/image');
            $image->move($destinationPath, $input['imagename']);
            $data['image'] = $input['imagename'];
            $data['thumbnail'] = $thumbnail;
        } else {
            unset($data['image']);
            unset($data['thumbnail']);
        }
        try {
            $post->update($data);
            return redirect()->route('posts.index')->with('success', 'Data Berhasil DiTambah');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $post)
    {
        //
        $post->removeImage();
        $post->delete();
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
