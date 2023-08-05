<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->is_admin){
            $users = User::paginate(20);
        }else{
            $users = User::where('organization_id', Auth::user()->organization_id)->paginate(20);
        }
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->is_admin){
            $organizations = Organization::pluck('title', 'id')->all();
        }else{
            $organizations = [
                [Auth::user()->organization_id => Auth::user()->organization->title]
            ];
        }
        return view('admin.users.create', compact('organizations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'phone'     => 'required|unique:users',
            'email'     => 'required',
            'password'  => 'required',
        ]);

        $user = User::add($request->all());
        $user->setAdmin($request->filled('is_admin'));
        $user->setStaff($request->filled('is_staff'));
        $user->setOrgAdmin($request->filled('is_org_admin'));
        if($request->get('organization_id') == 'set_null'){
            $user->organization_id = null;
            $user->save();
        }else{
            $user->setOrganization($request->get('organization_id'));
        }

        if($request->file !== null){
            $user->uploadFIle($request->file);
        }

        $user->generatePassword($request->get('password'));

        return redirect()->route('users.edit', $user->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if (Auth::user()->is_admin){
            $organizations = Organization::pluck('title', 'id')->all();
        }
        else{
            if (!Auth::user()->is_admin && $user->is_admin){
                return redirect()->back();
            }
            if($user->organization_id != Auth::user()->organization_id){
                return redirect()->back();
            }
            $organizations = [
                [Auth::user()->organization_id => Auth::user()->organization->title]
            ];
        }
        
        return view('admin.users.edit', compact('user', 'organizations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (Auth::user()->is_admin == 1 || Auth::user()->is_org_admin == 1){
            $this->validate($request, [
                'name'      => 'required',
                'email'     => 'required',
                'phone'     => [
                    'required',
                    Rule::unique('users')->ignore($user->id),
                ],
            ]);
    
            $user->edit($request->all());
            if(Auth::user()->is_admin == 1){
                $user->setAdmin($request->filled('is_admin'));
                $user->setStaff($request->filled('is_staff'));
                $user->setOrgAdmin($request->filled('is_org_admin'));
            }elseif(Auth::user()->is_org_admin == 1){
                $user->setStaff($request->filled('is_staff'));
            }

            if($request->get('organization_id') == 'set_null'){
                $user->organization_id = null;
                $user->save();
            }else{
                $user->setOrganization($request->get('organization_id'));
            }

            if($request->file() !== null){
                $user->uploadFile($request->file('file'));
            }

            $user->generatePassword($request->get('password'));
    
            return redirect()->back();
        }


        if ($id == Auth::user()->id){
            return redirect()->back();
        }
        if (!Auth::user()->is_admin && $user->is_admin){
            return redirect()->back();
        }

        if($user->organization_id != Auth::user()->organization_id){
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (!Auth::user()->is_admin){
            if ($id == Auth::user()->id){
                return;
            }
            if (!Auth::user()->is_admin && $user->is_admin){
                return;
            }
            if($user->organization_id != Auth::user()->organization_id){
                return;
            }
        }
        $user->remove();

        return;
    }
}
