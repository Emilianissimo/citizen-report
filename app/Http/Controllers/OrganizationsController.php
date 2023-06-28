<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Region;
use Illuminate\Http\Request;

class OrganizationsController extends Controller
{
    public function index(Request $request)
    {
        $region_id = $request->get('region_id');
        if(is_null($region_id)){
            $organizations = Organization::paginate(12);
        }else{
            $organizations = Organization::whereHas('regions', function($q) use ($region_id){
                $q->where('region_id', $region_id);
            })->paginate(12);
        }
        $regions = Region::all();
        return view('pages.organizations.index', compact('organizations', 'regions', 'region_id'));
    }
}
