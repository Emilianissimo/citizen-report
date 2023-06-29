<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Organization;
use App\Models\Region;
use App\Models\RequestStatus;
use App\Models\SocialRequest;
use App\Models\User;
use Illuminate\Http\Request;

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
        $requests = SocialRequest::orderBy('created_at', 'DESC');

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

        $requests = $requests->paginate(20);
        

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
        $socialRequest = SocialRequest::where('slug', $slug)->first();
        return view('pages.requests.show', compact(
            'socialRequest'
        ));
;    }
}
