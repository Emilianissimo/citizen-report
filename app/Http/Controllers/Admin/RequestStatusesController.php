<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestStatus;

class RequestStatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = RequestStatus::orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.statuses.index', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.statuses.create');
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
            'title_ru' => 'required',
            'title_uz' => 'required',
        ]);
        $status = RequestStatus::add($request->all());

        return redirect()->route('statuses.edit', $status->id);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(in_array($id, [1,2,3,4])){
            return redirect()->back();
        }

        $status = RequestStatus::find($id);
        return view('admin.statuses.edit', compact('status'));
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
        if(in_array($id, [1,2,3,4])){
            return redirect()->back();
        }

        $this->validate($request, [
            'title_ru' => 'required',
            'title_uz' => 'required',
        ]);
        $status = RequestStatus::find($id);
        $status->edit($request->all());

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
        if(in_array($id, [1,2,3,4])){
            return redirect()->back();
        }
        RequestStatus::find($id)->remove();
        return;
    }
}
