<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{
	/**
	* Post一覧を表示する
	* 
	* @param Post Postモデル
	* @return array Postモデルリスト
	*/
	public function index(Post $post)
	{
		return view('posts/index')->with(['posts'=>$post->getPaginateByLimit()]);
		//getPaginateByLimit()はPost.phpで定義したメソッドです。
	}
	
	public function show(Post $post){
		return view('posts/show')->with(['post' => $post]);
		//'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
	}
	
	public function create(){
		return view('posts/create');
	}
	
	public function store(PostRequest $request, Post $post){
		$input = $request['post'];
		$post->timestamps = false;
		$post->fill($input)->save();
		return redirect('/posts/' . $post->id);
	}
	
	public function edit(Post $post){
		return view('posts/edit')->with(['post' => $post]);
	}
	
	public function update(PostRequest $request, Post $post){
		$input = $request['post'];
		$post->timestamps = false;
		$post->fill($input)->save();
		return redirect('/posts/' . $post->id);
	}
	
	public function delete(Post $post){
		$post->timestamps = false;
		$post->delete();
		return redirect('/');
	}
}
