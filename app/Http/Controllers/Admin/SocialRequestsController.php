<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Region;
use App\Models\RequestComment;
use App\Models\RequestStatus;
use Illuminate\Http\Request;
use App\Models\SocialRequest;
use Illuminate\Support\Facades\Auth;

class SocialRequestsController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::user()->is_admin){
            $inititalRegionSet = Region::pluck('id')->all();
        }else{
            $inititalRegionSet = Auth::user()->organization->getRegionIds();
        }

        $requests = SocialRequest::whereIn('region_id', $inititalRegionSet);

        $filterRegions = $request->get('regions');
        $filterCategories = $request->get('categories');
        $filterStatuses = $request->get('statuses');
        $filterUrgency = $request->get('urgency');

        if ($filterRegions) {
            # Check if chosen ids are available for current user
            if(!Auth::user()->is_admin){
                $filterRegions = array_intersect(Auth::user()->organization->getRegionIds(), $filterRegions);
            }
            $requests = $requests->whereIn('region_id', $filterRegions);
        }

        if ($filterCategories) {
            $requests = $requests->with(['categories' => function($q) use ($filterCategories){
                $q->wherePivot('category_id', 'in', $filterCategories);
            }]);
        }

        if ($filterStatuses) {
            $requests = $requests->whereIn('status_id', $filterStatuses);
        }

        if ($filterUrgency) {
            $requests = $requests->whereIn('urgency', $filterUrgency);
        }

        $requests = $requests->orderBy('created_at', "DESC")->paginate(20);
        

        $statuses = RequestStatus::pluck('title_ru', 'id')->all();
        $categories = Category::pluck('title_ru', 'id')->all();
        if(Auth::user()->is_admin){
            $regions = Region::pluck('title_ru', 'id')->all();
        }else{
            $regions = Region::whereIn('id', Auth::user()->organization->getRegionIds())->pluck('title_ru', 'id')->all();
        }
        $urgency = [
            0 => 'Низкий',
            1 => 'Средний',
            2 => 'Важный',
            3 => 'Очень важный',
        ];
        return view('admin.requests.index', compact(
            'requests', 
            'statuses', 
            'categories', 
            'regions',
            'filterRegions',
            'filterCategories',
            'filterStatuses',
            'filterUrgency',
            'urgency',
        ));
    }

    public function show($id)
    {
        if(Auth::user()->is_admin){
            $socialRequest = SocialRequest::findOrFail($id); 
        }else{
            $socialRequest = SocialRequest::whereIn('region_id', Auth::user()->organization->getRegionIds())->findOrFail($id);
        }
        $statuses = RequestStatus::pluck('title_ru', 'id')->all();
        $comments = $socialRequest->comments()->orderBy('created_at', 'DESC')->paginate(20);
        $gallery = $socialRequest->gallery()->get();

        return view('admin.requests.show', compact(
            'socialRequest',
            'statuses',
            'comments',
            'gallery',
        ));
    }

    public function changeStatus(Request $request, $id)
    {
        SocialRequest::findOrFail($id)->setStatus($request->get('status_id'));
        return redirect()->back();
    }
}
