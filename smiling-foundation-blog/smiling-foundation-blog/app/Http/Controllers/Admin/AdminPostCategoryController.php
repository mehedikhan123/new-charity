<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCategory;
use App\Models\Post;

class AdminPostCategoryController extends Controller
{
    public function index()
    {
        $post_categories = PostCategory::all();
        return view('admin.post_category.index', compact('post_categories'));
    }

    public function create()
    {
        return view('admin.post_category.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:post_categories']
        ]);

        $obj = new PostCategory();
        $obj->name = $request->name;
        $obj->slug = str()->slug($request->name);
        $obj->save();

        return redirect()->route('admin.admin_post_category_index')->with('success','Post Category created successfully');
    }

    public function edit($id)
    {
        $post_category = PostCategory::findOrFail($id);
        return view('admin.post_category.edit', compact('post_category'));
    }

    public function edit_submit(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'unique:post_categories,name,'.$id]
        ]);

        $obj = PostCategory::findOrFail($id);
        $obj->name = $request->name;
        $obj->slug = str()->slug($request->name);
        $obj->update();

        return redirect()->route('admin.admin_post_category_index')->with('success','Post Category updated successfully');
    }

    public function delete($id)
    {
        $posts = Post::where('post_category_id', $id)->get();
        foreach($posts as $post) {
            $filePath = public_path('storage/uploads/photo/'.$post->photo);
            if(isset($filePath)) {
                unlink($filePath);
            }
        }

        Post::where('post_category_id',$id)->delete();
        PostCategory::where('id',$id)->delete();

        return redirect()->back()->with('success','Post Category deleted successfully');
    }

    public function changeStatus(Request $request, PostCategory $postCategory)
    {
        $postCategory->is_active = $request->is_active ? false : true;
        $isUpdated = $postCategory->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Post Category status is updated successfully' : 'Post Category status could not be updated successfully';
        return redirect()->route('admin.admin_post_category_index')->with($status, $message);
    }
}
