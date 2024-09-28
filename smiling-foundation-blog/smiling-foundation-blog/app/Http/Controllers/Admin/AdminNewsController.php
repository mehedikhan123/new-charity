<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsCategory;
use App\Models\News;
use App\Models\Comment;
use App\Models\Reply;
use Auth;
use App\Models\Subscriber;
use App\Mail\Websitemail;

class AdminNewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function create_submit(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:news',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ]);

        $news = new News();
        $news->title = $request->title;
        $news->slug = str()->slug($request->title);
        $news->description = $request->description;
        $final_name = 'news_'.time().'.'.$request->photo->extension();
        $request->photo->storeAs('public/uploads/photo/', $final_name);
        $news->photo = $final_name;
        $news->save();
        // $last_id = $news->id;


        // $news_data = news::where('id',$last_id)->first();


        // if($request->email_send == 1)
        // {
        //     $subscribers = Subscriber::where('status',1)->get();

        //     $subject = 'New news Published';
        //     $message = 'New news has been published. Please visit our website to read the news.<br>';
        //     $message .= '<a href="'.route('news', $news_data->slug).'">Click here to read the news</a>';

        //     foreach($subscribers as $subscriber){
        //         \Mail::to($subscriber->email)->send(new Websitemail($subject,$message));
        //     }
        // }

        return redirect()->route('admin.admin_news_index')->with('success','News created successfully');
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    public function edit_submit(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'unique:news,title,'.$id],
            'description' => 'required',
        ]);

        $news = News::findOrFail($id);

        if($request->photo != null) {
            $request->validate([
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
            ]);
            if(isset($news->photo)) {
                $filePath = public_path('storage/uploads/photo/' . $news->photo);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            $final_name = 'news_'.time().'.'.$request->photo->extension();
            $request->photo->storeAs('public/uploads/photo/', $final_name);
            $news->photo = $final_name;
        }

        $news->title = $request->title;
        $news->slug = str()->slug($request->title);
        $news->description = $request->description;
        $news->update();

        return redirect()->route('admin.admin_news_index')->with('success','News updated successfully');
    }

    public function delete($id)
    {
        $news = news::findOrFail($id);
        if(isset($news->photo)) {
            $filePath = public_path('storage/uploads/photo/' . $news->photo);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $news->delete();

        return redirect()->back()->with('success','News deleted successfully');
    }

    public function changeStatus(Request $request, News $news)
    {
        $news->is_active = $request->is_active ? false : true;
        $isUpdated = $news->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'News status is updated successfully' : 'News status could not be updated successfully';
        return redirect()->route('admin.admin_news_index')->with($status, $message);
    }
}
