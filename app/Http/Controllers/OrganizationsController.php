<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Organization;
use App\Models\Post;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationsController extends Controller
{
    public function index(Request $request)
    {
        $region_id = $request->get('region_id');
        if(is_null($region_id)){
            $organizations = Organization::orderBy('created_at', 'DESC')->paginate(12);
        }else{
            $organizations = Organization::whereHas('regions', function($q) use ($region_id){
                $q->where('region_id', $region_id);
            })->orderBy('created_at', 'DESC')->paginate(12);
        }
        $regions = Region::all();
        return view('pages.organizations.index', compact('organizations', 'regions', 'region_id'));
    }

    public function posts($lang, $id)
    {
        $organization = Organization::findOrFail($id);
        $posts = $organization->posts()->orderBy('created_at', "DESC")->paginate(12);

        return view('pages.organizations.posts', compact(
            'posts',
            'organization'
        ));
    }

    public function show($lang, $id, $slug)
    {
        $organization = Organization::findOrFail($id);
        $post = $organization->posts()->where('slug', $slug)->first();
        $comments = $post->comments()->orderBy('created_at', 'DESC')->paginate(50);

        return view('pages.organizations.singlePost', compact(
            'post',
            'organization',
            'comments'
        ));
    }

    public function create($lang, $id)
    {
        return redirect()->back();
    }

    public function store(Request $request, $lang, $id)
    {
        return redirect()->back();
    }

    public function edit($lang, $id, $slug)
    {
        return redirect()->back();
    }

    public function update(Request $request, $lang, $id, $slug)
    {
        return redirect()->back();
    }

    public function destroy($lang, $id, $slug)
    {
        return redirect()->back();
    }

    public function comment(Request $request, $lang, $id, $slug)
    {
        $this->validate($request, [
            'text' => 'required'
        ]);
        $post = Post::where('slug', $slug)->firstOrFail();
        Comment::add($request->all(), $post->id);
        return redirect()->back();
    }

    public function commentDelete($lang, $id, $slug, $commentId)
    {
        if(Auth::user()->is_admin || Auth::user()->id == $commentId){
            Comment::findOrFail($commentId)->remove();
        }
        return redirect()->back();
    }

    public function addFile(Request $request, $lang, $id, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        if(
            Auth::user()->id == $post->user_id ||
            Auth::user()->is_admin ||
            (
                Auth::user()->is_org_admin && 
                Auth::user()->organization_id == $post->user->organization_id
                )
            )
        {
            $this->validate($request, [
                'file' => 'required|mimes:jpg,jpeg,png,mp4',
            ]);
            Gallery::addPost($request->file('file'), $post->id);
        }
        return redirect()->back();
    }

    public function destroyFile($lang, $id, $slug, $fileId)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        if(
            Auth::user()->id == $post->user_id ||
            Auth::user()->is_admin ||
            (
                Auth::user()->is_org_admin && 
                Auth::user()->organization_id == $post->user->organization_id
                )
            )
        {
            $post->gallery()->findOrFail($fileId)->remove();
        }
        return redirect()->back();
    }
}
