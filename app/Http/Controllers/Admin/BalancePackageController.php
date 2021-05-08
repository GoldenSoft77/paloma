<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\BalancePackage;

class BalancePackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    //Show all Balance Packages
    public function index()
    {
        $balancepackages = BalancePackage::all();
        return view('balancePackages.balancepackages',compact('balancepackages'));
    }
    //Add New Balance Package
    public function create()
    {
        return view('balancePackages.add_balance_package');
    }
    //Save New Balance Package
    public function store(Request $request) {
      
        $data = [
            'units' => $request->units,
            'cost' => $request->cost,
            'company' => $request->company,
        ];
      
        $balance_package = BalancePackage::create($data);
        return redirect('balancepackages')->with('message','New Package has been added successfully');
    }
    //Edit a specific Balance Package
    public function edit($id)
    {
        $balance_package = BalancePackage::where('id',$id)->first();
        return view('balancePackages.edit_balance_package', compact('balance_package'));
    }
   //Update a specific Balance Package
    public function update(Request $request, $id)
    {
        $balance_package = BalancePackage::where('id',$id)->first();

        $data = [
            'units' => $request->units,
            'cost' => $request->cost,
            'company' => $request->company,
        ];

        $balance_package->update($data);

        return redirect()->back()->with('message', 'Package has been updated successfully');

    }
    //Delete a specific Balance Package
    public function destroy($id)
    {
        $balance_package = BalancePackage::where('id',$id)->delete();

        return redirect('balancepackages')->with('message','The Package has been removed successfully');
    }

    //API For Balance Packages
    public function showBalancePackageApi(Request $request){
      
        $balance_package = BalancePackage::where('company',$request->company)->get();
        $success['balance_package'] = $balance_package;
        return response()->json(['code' => 1,"data"=>$success], 200);
    }
   
}
