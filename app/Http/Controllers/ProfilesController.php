<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Organization;
use App\Models\Post;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\SocialRequest;

class ProfilesController extends Controller
{
    public function index(Request $request,$lang,$id){
        $user = User::findOrFail($id);
        $posts = null;
        $requests = null;
        $organization = null;
        if($user->organization_id){
            $organization = Organization::findOrFail($user->organization_id);
            $requests = $user->socialRequestsAsManager()->paginate(8);
            $posts = Post::where('organization_id',$organization->id)->orderBy('created_at','DESC')->paginate(8);
            // dd($requests);
        }
        else{
            if($user->socialRequestsAsAuthor !== 0){
                $requests = $user->socialRequestsAsAuthor()->paginate(8);
            }
        };

        return view('pages.profiles.index',compact('user','organization','requests','posts'));
    }

    public function profileSettings(Request $request,$lang,$id){
        $user = User::findOrFail($id);
        $posts = null;
        $requests = null;
        $organization = null;
        if($user->organization_id){
            $organization = Organization::findOrFail($user->organization_id);
            $requests = $user->socialRequestsAsManager()->paginate(8);
            $posts = Post::where('organization_id',$organization->id)->orderBy('created_at','DESC')->paginate(8);
        }
        else{
            if($user->socialRequestsAsAuthor !== 0){
                $requests = $user->socialRequestsAsAuthor()->paginate(8);
            }
        };

        return view('pages.profiles.profile-settings',compact('user','organization','requests','posts'));
    }

    public function profilePictureDestroy(Request $request, $lang ,$id)
    {
        // dd($id);
        $user = User::find($id);
        if (!Auth::user()){
            return redirect()->back();
        }

        $user->removeFile();
        $user->save();
        return redirect()->back();
    }
    
    public function update(Request $request, $lang ,$id)
    {
        // dd($request->file('picture'));
        $user = User::find($id);
        if (!Auth::user()){
            return redirect()->back();
        }

        $this->validate($request, [
            'name'      => 'required',
            'phone'     => [
                'required',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);
        $phone = str_replace(
			['(',')','-',' '],
			'',
			$request->get('phone')
		);
        $user->name = $request->get('name');
        $user->phone = $phone;
        $user->email = $request->get('email');

        if($request->file() !== null){
            $user->uploadFile($request->file('picture'));
        }

        $user->generatePassword($request->get('password'));
        $user->save();

        return redirect()->back();
    }
}