<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Organization;
use App\Models\Region;
use App\Models\RequestComment;
use App\Models\RequestStatus;
use App\Models\SocialRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        $requests = SocialRequest::select('id')->get();
        $organizations = Organization::select('id')->get();
        $users = User::select('id')->get();
        $organizationsSet = Organization::orderBy('created_at', 'DESC')->get()->take(3);
        return view('pages.index', compact(
            'requests',
            'organizations',
            'organizationsSet',
            'users'
        ));
    }

    public function requests(Request $request)
    {
        $regions = Region::all();
        $requests = new SocialRequest;

        $filterRegions = $request->get('regions', []);
        $filterCategories = $request->get('categories', []);
        $filterStatuses = $request->get('statuses', []);
        $filterUrgency = $request->get('urgency', []);

        if ($filterRegions) {
            $requests = $requests->whereIn('region_id', $filterRegions);
        }

        if ($filterCategories) {
            $requests = $requests->whereHas('categories', function($q) use ($filterCategories){
                $q->whereIn('category_id', $filterCategories);
            });
        }

        if ($filterStatuses) {
            $requests = $requests->whereIn('status_id', $filterStatuses);
        }

        if ($filterUrgency) {
            $requests = $requests->whereIn('urgency', $filterUrgency);
        }

        $requests = $requests->orderBy('created_at', 'DESC')->paginate(20);
        

        $statuses = RequestStatus::all();
        $categories = Category::all();
        $urgency = [
            0 => __('Низкий'),
            1 => __('Средний'),
            2 => __('Важный'),
            3 => __('Очень важный'),
        ];
        return view('pages.requests.index', compact(
            'requests', 
            'regions', 
            'statuses',
            'categories',
            'urgency',
            'filterRegions',
            'filterCategories',
            'filterStatuses',
            'filterUrgency',
        ));
    }

    public function singleRequest($lang, $slug)
    {
        $socialRequest = SocialRequest::where('slug', $slug)->firstOrFail();
        $comments = $socialRequest->comments()->orderBy('created_at', 'DESC')->paginate(50);
        return view('pages.requests.show', compact(
            'socialRequest',
            'comments'
        ));
    }

    public function storeCommentRequest(Request $request, $lang, $slug)
    {
        $this->validate($request, [
            'text' => 'required'
        ]);
        $socialRequest = SocialRequest::where('slug', $slug)->firstOrFail();
        RequestComment::add($request->all(), $socialRequest->id);
        return redirect()->back();
    }

    public function destroyCommentRequest($lang, $slug, $commentId)
    {
        if(Auth::user()->is_admin || Auth::user()->id == $commentId){
            RequestComment::findOrFail($commentId)->remove();
        }
        return redirect()->back();
    }

    public function requestCreate()
    {
        $regions = Region::all();
        $categories = Category::all();
        $urgency = [
            0 => __('Низкий'),
            1 => __('Средний'),
            2 => __('Важный'),
            3 => __('Очень важный'),
        ];
        return view('pages.requests.create', compact(
            'regions',
            'categories',
            'urgency'
        ));
    }

    public function requestStore(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'text' => 'required',
            'coordinates' => 'required',
            'address' => 'required'
        ]);

        $socialRequest = SocialRequest::add($request->all());
        $socialRequest->setRegion($request->get('region_id'));
        $socialRequest->setCategories($request->get('categories'));

        return redirect()->route('client.requests.show', [
            'locale' => app()->getLocale(),
            'slug' => $socialRequest->slug
        ]);
    }

    public function addFileRequest(Request $request, $lang, $slug)
    {
        $req = SocialRequest::where('slug', $slug)->firstOrFail();
        if(
            Auth::user()->id ==$req->author_id ||
            Auth::user()->is_admin ||
            Auth::user()->id == $req->manager_id || 
            (
                Auth::user()->is_org_admin && 
                Auth::user()->organization_id == $req->manager->organization_id
                )
            )
        {
            $this->validate($request, [
                'file' => 'required|mimes:jpg,jpeg,png,mp4',
            ]);
            Gallery::addRequest($request->file('file'), $req->id);
        }
        return redirect()->back();
    }

    public function destroyFileRequest($lang, $slug, $id)
    {
        $req = SocialRequest::where('slug', $slug)->firstOrFail();
        if(
            Auth::user()->id ==$req->author_id ||
            Auth::user()->is_admin ||
            Auth::user()->id == $req->manager_id || 
            (
                Auth::user()->is_org_admin && 
                Auth::user()->organization_id == $req->manager->organization_id
                )
            )
        {
            $req->gallery()->findOrFail($id)->remove();
        }
        return redirect()->back();
    }
}
