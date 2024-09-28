<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentReplyRequest;
use App\Http\Requests\Comment\CommentSubmitRequest;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Comment;
use App\Models\Reply;
use Carbon\Carbon;
use App\Mail\Websitemail;
use App\Models\Admin;
use App\Models\News;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('rPostCategory')->paginate(15);
        $news = News::orderBy('id', 'desc')->take(5)->get();
        // foreach ($posts as $post) {
        //     if($post->rPostCategory->slug === 'successful-stories') {
                // dd('aisi');
            //     return view('front.story', compact('posts'));
            // } else {
                return view('front.blog', compact('posts', 'news'));
        //     }
        // }
    }

    public function news()
    {
        $news = News::orderBy('id', 'desc')->paginate(15);
        return view('front.news.index', compact('news', 'news'));
    }

    public function successfulStory()
    {
        $posts = Post::with('rPostCategory')
        ->whereHas('rPostCategory', function ($query) {
            $query->where('slug', 'successful-stories');
        })
        ->paginate(15);
        
        return view('front.story', compact('posts'));
    }

    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->first();
        $latest_posts = Post::orderBy('id', 'desc')->limit(5)->get();
        $post_categories = PostCategory::orderBy('name', 'asc')->get();
        $post_date = Carbon::parse($post->created_at)->format('j F, Y');
        $post_tags = explode(',', $post->tags);
        $tags = Post::pluck('tags')->flatMap(function ($item) {
            return explode(',', $item);
        })->unique()->values();

        $total_comments = Comment::where('status', 'Active')->where('post_id',$post->id)->count();
        $comments = Comment::orderBy('id','asc')->where('status','Active')->where('post_id',$post->id)->get();

        return view('front.post', compact('post', 'latest_posts', 'post_categories', 'post_date', 'tags', 'post_tags', 'comments', 'total_comments'));
    }

    public function showStory(string $slug)
    {
        $post = Post::where('slug', $slug)->first();
        $latest_posts = Post::orderBy('id', 'desc')->limit(5)->get();
        $post_categories = PostCategory::orderBy('name', 'asc')->get();
        $post_date = Carbon::parse($post->created_at)->format('j F, Y');
        $post_tags = explode(',', $post->tags);
        $tags = Post::pluck('tags')->flatMap(function ($item) {
            return explode(',', $item);
        })->unique()->values();

        $total_comments = Comment::where('status', 'Active')->where('post_id',$post->id)->count();
        $comments = Comment::orderBy('id','asc')->where('status','Active')->where('post_id',$post->id)->get();

        return view('front.successful-story', compact('post', 'latest_posts', 'post_categories', 'post_date', 'tags', 'post_tags', 'comments', 'total_comments'));
    }

    public function showNews(string $slug)
    {
        $news = News::where('slug', $slug)->first();
        // $latest_news = News::orderBy('id', 'desc')->limit(5)->get();
        $news_date = Carbon::parse($news->created_at)->timezone('Asia/Dhaka')->format('l, j F, Y h:i A');

        return view('front.news.show', compact('news', 'news_date'));
    }

    public function category(string $slug)
    {
        $post_category = PostCategory::where('slug', $slug)->first();
        $posts = Post::where('post_category_id', $post_category->id)->paginate(15);
        return view('front.category', compact('posts', 'post_category'));
    }

    public function tag(string $name)
    {
        $posts = Post::whereRaw("FIND_IN_SET(?, tags)", [$name])->paginate(15);
        $tag_name = $name;
        return view('front.tag', compact('posts', 'tag_name'));
    }

    public function commentSubmit(CommentSubmitRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['status'] = 'Pending';
        $comment = Comment::create($validatedData);

        // Send Email to Admin
        $subject = 'New Comment Submitted';
        $message = 'A new comment has been submitted on your blog post. Please login to your admin panel to approve it.<br>';
        $message .= '<a href="'.route('admin.admin_comment').'">Click Here</a>';

        $admin_email = Admin::first()->email;

        if($comment && $admin_email) {
            Mail::to($admin_email)->send(new Websitemail($subject,$message));
        }

        return redirect()->back()->with('success','Comment submitted successfully');
    }

    public function commentReply(CommentReplyRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['user_type'] = 'Visitor';
        $validatedData['status'] = 'Pending';
        $reply = Reply::create($validatedData);

        // Send Email to Admin
        $subject = 'New Reply Submitted';
        $message = 'A new reply has been submitted on your blog post. Please login to your admin panel to approve it.<br>';
        $message .= '<a href="'.route('admin.admin_reply').'">Click Here</a>';

        $admin_email = Admin::first()->email;

        if($reply && $admin_email) {
            Mail::to($admin_email)->send(new Websitemail($subject,$message));
        }

        return redirect()->back()->with('success', 'Reply submitted successfully');
    }
}
