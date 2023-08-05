<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Organization;
use App\Models\Gallery;
use App\Models\Consumption;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancesController extends Controller
{

    public function index(){
        $organizations = null;
        $organizationConsuptions = null;
        $organizationIncomes = null;
        $organization = null;
        if(Auth::user()->is_admin){
            $organizations = Organization::paginate(20);
        }
        elseif(Auth::user()->is_org_admin){
            $organization = Organization::where('id',Auth::user()->organization_id)->first();
            $organizationConsumptions = $organization->consumptions()->orderBy('created_at', "DESC")->paginate(10);
            $organizationIncomes = $organization->incomes()->orderBy('created_at', "DESC")->paginate(10);
            // dd($organizationPosts->first()->gallery()->get());
        }
        return view('admin.finances.index', compact('organization','organizations','organizationConsuptions','organizationIncomes'));
    }

    public function consumptions(){
        if(Auth::user()->is_org_admin){
            $organization = Organization::where('id',Auth::user()->organization_id)->first();
            $organizationConsumptions = $organization->consumptions()->orderBy('created_at', "DESC")->paginate(10);
            return view('admin.finances.consumptions', compact('organizationConsumptions'));
        }
    }

    // public function listChoise($id){
    //     $organization = Organization::findOrFail($id);
    //     return view('admin.finances.postsListForAdmin', compact('organization'));
    // }

    public function consumptionEdit($id)
    {
        $consumption = Consumption::find($id);
        // dd($consumption->getFile());
        return view('admin.finances.consumptionEdit', compact('consumption'));
    }

    public function consumptionUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'text' => 'required',
            'amount' => 'required',
        ]);
        $consumption = Consumption::find($id);
        
        $consumption->edit($request->all());
        if($request->file('image') !== null){
            $consumption->uploadFile($request->file('image'));
        }
        $consumption->user_id = Auth::user()->id;
        return redirect()->back();
    }

    public function incomeEdit($id)
    {
        $income = Income::find($id);
        return view('admin.finances.incomeEdit', compact('income'));
    }

    public function incomeUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required',
            'text' => 'required',
        ]);
        $income = Income::find($id);
        $income->user_id = Auth::user()->id;
        $income->from = $request->get('from');
        $income->edit($request->all());
        if($request->file('image') !== null){
            $income->uploadFile($request->file('image'));
        }
        
        return redirect()->back();
    }

    public function consumptionCreate()
    {
        return view('admin.finances.consumptionCreate');
    }

    public function consumptionStore(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
            'text'   => 'required',
        ]);
        $consumption = Consumption::add($request->all());
        $consumption->uploadFile($request->file('image'));
        return redirect()->route('finances.consumptions');
    }

    public function incomeCreate()
    {
        return view('admin.finances.incomeCreate');
    }

    public function incomeStore(Request $request){

        $this->validate($request, [
            'amount'   => 'required',
            'text'     => 'required',
        ]);

        $income = Income::add($request->all());
        $income->from = $request->get('from');
        $income->uploadFile($request->file('image'));
        return redirect()->route('posts.index');
    }

    public function consumptionDestroy($id)
    {
        Consumption::find($id)->remove();
        return redirect()->back();
    }

    public function incomeDestroy($id)
    {
        Income::find($id)->remove();
        return redirect()->back();
    }

    public function consumptionImageDestroy($id){
        $consumption = Consumption::find($id);
        $consumption->removeFile();
        return redirect()->back();
    }

    public function incomeImageDestroy($id){
        $income = Income::find($id);
        $income->removeFile();
        return redirect()->back();
    }
}