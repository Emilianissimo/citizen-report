<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Region;

class OrganizationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizations = Organization::orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.organizations.index', compact('organizations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::pluck('title_ru', 'id')->all();
        return view('admin.organizations.create', compact('regions'));
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
            'title' => 'required',
            'file' => 'mimes:jpeg,jpg,png',
        ]);
        $organization = Organization::add($request->all());
        $organization->setRegions($request->get('regions'));
        $organization->uploadFile($request->file('picture'));

        return redirect()->route('organizations.edit', $organization->id);

    }

    public function show($id)
    {
        $organization = Organization::findOrFail($id);
        $posts = $organization->posts()->paginate(20);
        return view('admin.organizations.show', compact('organization', 'posts'));
    }

    public function consumptions($id)
    {
        $organization = Organization::findOrFail($id);
        $consumptions = $organization->consumptions()->paginate(20);
        return view('admin.organizations.consumptions', compact('organization', 'consumptions'));
    }

    public function incomes($id)
    {
        $organization = Organization::findOrFail($id);
        $incomes = $organization->incomes()->paginate(20);
        return view('admin.organizations.incomes', compact('organization', 'incomes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $regions = Region::pluck('title_ru', 'id')->all();
        $organization = Organization::find($id);
        return view('admin.organizations.edit', compact('organization', 'regions'));
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
        $this->validate($request, [
            'title' => 'required',
            'file' => 'mimes:jpeg,jpg,png',
        ]);
        $organization = Organization::find($id);
        $organization->edit($request->all());
        $organization->setRegions($request->get('regions'));
        $organization->uploadFile($request->file('picture'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Organization::find($id)->remove();
        return;
    }
}
