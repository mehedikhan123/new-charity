<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;
use Auth;
use App\Models\Subscriber;
use App\Mail\Websitemail;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::with('rPostCategory')->get();
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        $post_categories = PostCategory::where('is_active', true)->get();
        return view('admin.post.create', compact('post_categories'));
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts',
            'short_description' => 'required',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ]);
        
        if($request->tags == null) {
            $tags = '';
        } else {
            $tags = implode(',', $request->tags);
        }

        $post = new Post();
        $post->post_category_id = $request->post_category_id;
        $post->title = $request->title;
        $post->slug = str()->slug($request->title);
        $post->short_description = $request->short_description;
        $post->description = $request->description;
        $final_name = 'post_'.time().'.'.$request->photo->extension();
        $request->photo->storeAs('public/uploads/photo/', $final_name);
        $post->photo = $final_name;
        $post->tags = $tags;
        $post->save();
        // $last_id = $post->id;


        // $post_data = Post::where('id',$last_id)->first();


        // if($request->email_send == 1)
        // {
        //     $subscribers = Subscriber::where('status',1)->get();

        //     $subject = 'New Post Published';
        //     $message = 'New post has been published. Please visit our website to read the post.<br>';
        //     $message .= '<a href="'.route('post', $post_data->slug).'">Click here to read the post</a>';

        //     foreach($subscribers as $subscriber){
        //         \Mail::to($subscriber->email)->send(new Websitemail($subject,$message));
        //     }
        // }

        return redirect()->route('admin.admin_post_index')->with('success','Post created successfully');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $post_categories = PostCategory::where('is_active', true)->get();
        $post_tags = explode(',',$post->tags);
        return view('admin.post.edit', compact('post', 'post_categories', 'post_tags'));
    }

    public function edit_submit(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'unique:posts,title,'.$id],
            'short_description' => 'required',
            'description' => 'required',
        ]);
        
        if($request->tags == null) {
            $tags = '';
        } else {
            $tags = implode(',', $request->tags);
        }

        $post = Post::findOrFail($id);

        if($request->photo != null) {
            $request->validate([
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
            ]);
            if(isset($post->photo)) {
                $filePath = public_path('storage/uploads/photo/' . $post->photo);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            $final_name = 'post_'.time().'.'.$request->photo->extension();
            $request->photo->storeAs('public/uploads/photo/', $final_name);
            $post->photo = $final_name;
        }

        $post->post_category_id = $request->post_category_id;
        $post->title = $request->title;
        $post->slug = str()->slug($request->title);
        $post->short_description = $request->short_description;
        $post->description = $request->description;
        $post->tags = $tags;
        $post->update();

        return redirect()->route('admin.admin_post_index')->with('success','Post updated successfully');
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        if(isset($post->photo)) {
            $filePath = public_path('storage/uploads/photo/' . $post->photo);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $post->delete();

        return redirect()->back()->with('success','Post deleted successfully');
    }

    public function changeStatus(Request $request, Post $post)
    {
        $post->is_active = $request->is_active ? false : true;
        $isUpdated = $post->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Post status is updated successfully' : 'Post status could not be updated successfully';
        return redirect()->route('admin.admin_post_index')->with($status, $message);
    }

    public function comment()
    {
        $comments = Comment::with('rPost')->get();
        return view('admin.post.comment', compact('comments'));
    }

    public function comment_status_change($id)
    {
        $comment = Comment::findOrFail($id);
        if($comment->status == 'Pending') {
            $comment->status = 'Active';
        } else {
            $comment->status = 'Pending';
        }
        $comment->update();

        return redirect()->back()->with('success','Comment status changed successfully');
    }

    public function comment_delete($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success','Comment deleted successfully');
    }


    public function reply()
    {
        $replies = Reply::with('rComment')->get();
        return view('admin.post.reply', compact('replies'));
    }

    public function reply_status_change($id)
    {
        $reply = Reply::findOrFail($id);
        if($reply->status == 'Pending') {
            $reply->status = 'Active';
        } else {
            $reply->status = 'Pending';
        }
        $reply->update();

        return redirect()->back()->with('success','Reply status changed successfully');
    }

    public function reply_delete($id)
    {
        $reply = Reply::findOrFail($id);
        $reply->delete();

        return redirect()->back()->with('success','Reply deleted successfully');
    }

    public function reply_submit(Request $request)
    {
        $request->validate([
            'reply' => 'required'
        ]);

        $reply = new Reply();
        $reply->comment_id = $request->comment_id;
        $reply->reply = $request->reply;
        $reply->user_type = 'Admin';
        $reply->status = 'Active';
        $reply->save();

        return redirect()->back()->with('success','Reply submitted successfully');
    }
}
