<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Region;
use App\Models\RequestStatus;
use Illuminate\Http\Request;
use App\Models\SocialRequest;
use Illuminate\Support\Facades\Auth;

class SocialRequestsController extends Controller
{
    public function index()
    {
        if(Auth::user()->is_admin){
            $requests = SocialRequest::orderBy('created_at', 'DESC')->paginate(20);
        }else{

            $requests = SocialRequest::whereIn('region_id', Auth::user()->getRegionIds())->orderBy('created_at', 'DESC')->paginate(20);
        }
        $statuses = RequestStatus::all();
        $categories = Category::all();
        $regions = Region::all();
        return view('admin.requests.index', compact('requests', 'statuses', 'categories', 'regions'));
    }
}
