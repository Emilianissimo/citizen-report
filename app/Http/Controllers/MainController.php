<?php

namespace App\Http\Controllers;

use App\Models\Organization;
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
}
