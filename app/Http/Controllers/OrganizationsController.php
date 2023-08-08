<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Organization;
use App\Models\Post;
use App\Models\Region;
use App\Models\SocialRequest;
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
        $posts = $organization->posts()->orderBy('created_at', "DESC")->paginate(8);
        $incomes = $organization->incomes()->orderBy('created_at', "DESC")->paginate(8);
        $consumptions = $organization->consumptions()->orderBy('created_at', "DESC")->paginate(8);
        $requests = SocialRequest::whereHas('manager.organization')->orderBy('created_at', "DESC")->paginate(8);
        // dd($requests);

        return view('pages.organizations.posts', compact(
            'posts',
            'organization',
            'incomes',
            'consumptions',
            'requests'
        ));
    }

    public function getIncomes($lang, $id)
    {
        $organization = Organization::findOrFail($id);
        $incomes = $organization->incomes()->orderBy('created_at', "DESC")->paginate(8);

        return view('pages.organizations.incomes', compact(
            'organization',
            'incomes',
        ));
    }

    public function getConsumptions($lang, $id)
    {
        $organization = Organization::findOrFail($id);
        $consumptions = $organization->consumptions()->orderBy('created_at', "DESC")->paginate(8);

        return view('pages.organizations.consumptions', compact(
            'organization',
            'consumptions'
        ));
    }

    public function getRequests($lang, $id)
    {
        $organization = Organization::findOrFail($id);
        // $requests = SocialRequest::whereHas('manager.organization')->orderBy('created_at', "DESC")->paginate(1);

        $requests = SocialRequest::whereHas('manager', function ($query) use ($organization) {
            $query->where('organization_id', $organization->id);
        })->orderBy('created_at', 'DESC')->paginate(10);

        return view('pages.organizations.requests', compact(
            'organization',
            'requests'
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

    public function incomes($lang, $id)
    {
        return redirect()->back();
    }

    public function addIncome(Request $request, $lang, $id)
    {
        return redirect()->back();
    }

    public function deleteIncome($lang, $id, $incomeId)
    {
        return redirect()->back();
    }

    public function consumptions($lang, $id)
    {
        return redirect()->back();
    }

    public function addConsumption(Request $request, $lang, $id)
    {
        return redirect()->back();
    }

    public function deleteConsumption($lang, $id, $consumptionId)
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
