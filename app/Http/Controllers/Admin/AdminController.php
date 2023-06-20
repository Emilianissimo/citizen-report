<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Models\SocialRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index(Request $request)
    {
        
        // if(Auth::user()->is_admin){
        //     $regions = Region::all(); 
        //  }else{
        //     $regions = Auth::user()->regions()->get();
        //  }

        // $region_id = $request->get('region_id', false);
        // if ($region_id){
        //     $region = $regions->find($region_id);
        // }else{
        //     $region = $regions->first();
        // }

        // if(!is_null($region)){
        //     $data = [
        //         'newRequests' => SocialRequest::where('region_id', $region->id)->where('status_id', 1)->get()->count(),
        //         'processRequests' => SocialRequest::where('region_id', $region->id)->where('status_id', 2)->get()->count(),
        //         'solvedRequests' => SocialRequest::where('region_id', $region->id)->where('status_id', 3)->get()->count(),
        //         'unsolvedRequests' => SocialRequest::where('region_id', $region->id)->where('status_id', 4)->get()->count(),
        //         'region' => $region,
        //         'regions' => $regions,
        //         'years' => range(2000, 2050)
        //     ];
        // }else{
        //     $data = [
        //         'newRequests' => 0,
        //         'processRequests' => 0,
        //         'solvedRequests' => 0,
        //         'unsolvedRequests' => 0,
        //         'region' => $region,
        //         'regions' => $regions,
        //         'years' => range(2000, 2050)
        //     ];
        // }
        
        // return view('admin.dashboard', $data);
        return view('admin.dashboard');
    }
}
