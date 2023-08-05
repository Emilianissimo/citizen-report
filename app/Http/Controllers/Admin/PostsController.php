<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Organization;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

    public function index(){
        $organizations = null;
        $organizationPosts = null;
        $organization = null;
        if(Auth::user()->is_admin){
            $organizations = Organization::paginate(20);
        }
        elseif(Auth::user()->is_org_admin){
            $organization = Organization::where('id',Auth::user()->organization_id)->first();;
            $organizationPosts = $organization->posts()->orderBy('created_at', "DESC")->paginate(20);

            // dd($organizationPosts->first()->gallery()->get());
        }
        return view('admin.posts.index', compact('organization','organizations','organizationPosts'));
    }

    public function postsListForAdmin($id){
        if(Auth::user()->is_admin){
            $organization = Organization::findOrFail($id);
            $organizationPosts = $organization->posts()->orderBy('created_at', "DESC")->paginate(20);
            return view('admin.posts.postsListForAdmin', compact('organizationPosts','organization'));
        }
    }

    public function edit($id)
    {
        $post = Post::find($id);
        // dd($post->gallery);
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'text' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,mp4',
        ]);
        $post = Post::find($id);
        $post->edit($request->all());
        
        Gallery::addPost($request->file('image'),$id);
        
        return redirect()->back();
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request){

        $this->validate($request, [
            'title'      => 'required',
            'text'     => 'required',
        ]);

        $post = Post::add($request->all());
        return redirect()->route('posts.index');
    }

    public function delete($id)
    {
        Post::find($id)->remove();
        return redirect()->back();
    }

    public function postGalleryDestroy($id){
        Gallery::find($id)->remove();
        return redirect()->back();
    }
}
