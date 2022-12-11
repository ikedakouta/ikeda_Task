<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Contracts\Service\Attribute\Required;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  新規作成のページを飛ばす
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // 新規登録されたものを データベースに反映
    public function store(Request $request)

    {
        $inputs=$request->validate([
            'user_name'=>'required|max:100',
            'contents'=>'required|max:100'
        ],
    [
        'user_name.required'=>'名前は必須です。',
        'user_name.max:100'=>'名前が100文字を超えています。',
        'contents.required'=>'投稿内容は必須です。',
        'contents.max:100'=>'投稿内容が100文字を超えています',
    ]);


        $id = Auth::id();
        //インスタンス作成
        $post = new Post();

        $post->id = $id;
        $post->contents = $request->contents = $inputs['contents'];
        $post->user_name = $request->user_name = $inputs['user_name'];


        $post->save();

       return redirect()->to('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $usr_name = $post->user_name;
        $user = DB::table('users')->where('id', $usr_name)->first();


        return view('posts.detail',['post' => $post,'user' => $user]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // $usr_id = $post->user_id;
        $post = \App\Post::findOrFail($id);
        return view('posts.edit',['post' => $post]);
        // return view('posts.edit');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $inputs=$request->validate([
            'contents'=>'required|max:100'
        ],
    [
        'contents.required'=>'投稿内容は必須です。',
        'contents.max:100'=>'投稿内容が100文字を超えています',
    ]);


        $id = $request->post_id;

        //レコードを検索
        $post = Post::findOrFail($id);

        $post->contents = $request->contents;

        //保存（更新）
        $post->save();

        return redirect()->to('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = \App\Post::find($id);
        //削除
        $post->delete();

        return redirect()->to('/posts');
    }

    public function search(Request $request)
    {


        $posts =  POST::where('contents','like',"%{$request->search}%")->paginate(5);

            return view('posts.index',['posts' => $posts]);

    }






}
