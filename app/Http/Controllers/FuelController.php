<?php

namespace App\Http\Controllers;
use App\VehicleModel;
use App\Http\Requests\FuelRequest;
use Illuminate\Http\Request;
use App\FuelModel;
use App\Expense;
class FuelController extends Controller
{
    public function index()
    { 
        $data['data'] = FuelModel::orderBy('id', 'desc')->where('deleted_at',null)->get();
        return view('fuel.index',$data);
    }
    public function create()
    {
    	$data['vehicles'] = VehicleModel::whereIn_service("1")->get();
    	return view('fuel.create', $data);
    }

    public function store(FuelRequest $request)
    {

      $expense = new Expense();
      $expense->vehicle_id = $request->get('vehicle_id');
      $expense->user_id = $request->get('user_id');
      $expense->expense_type = '8';
      $expense->comment = $request->get('note');
      $expense->date = $request->get('date');
      $amount = $request->get('qty') * $request->get('cost_per_unit');
      $expense->amount = $amount;
      $expense->save();

       $fuel = new FuelModel();
       $fuel->vehicle_id = $request->get('vehicle_id');
       $fuel->user_id = $request->get('user_id');
       $fuel->mileage_type = $request->get('mileage_type');
       $condition = FuelModel::orderBy('id','desc')->where('vehicle_id',$request->get('vehicle_id'))->first();
       // dd($condition->qty);
       if($condition['vehicle_id'] == $request->get('vehicle_id'))
       {
       
          $fuel->start_meter = $request->get('start_meter');
         $fuel->end_meter = "0";
         $fuel->consumption = "0";
        $condition->end_meter = $end = $request->get('start_meter');
         // dd($condition->end_meter);
       // $fuel->start_meter = $start = $request->get('start_meter');
       // dd($condition->start_meter);
        // dd($end); //value fetched
       $condition->consumption = $con = ($end - $condition->start_meter) / $request->get('qty');
        $condition->save();
       // dd($con);
      

       }
       else
       {
        
         $fuel->start_meter = $request->get('start_meter');
         $fuel->end_meter = "0";
         $fuel->consumption = "0";

       }
       $fuel->reference = $request->get('reference');
       $fuel->province = $request->get('province');
       $fuel->note = $request->get('note');
       
       $fuel->qty = $request->get('qty');
       $fuel->fuel_from = $request->get('fuel_from');
       $fuel->vendor_name = $request->get('vendor_name');
       $fuel->cost_per_unit = $request->get('cost_per_unit');
       $fuel->date = $request->get('date');   
       $fuel->complete = $request->get("complete");
       $fuel->save();
       return redirect('fuel');
    }

    public function edit($id)
    {
      // return $id;
      // $data['vehicle'] = VehicleModel::whereId(2)->get();
       $data['data'] = $data = FuelModel::whereId($id)->get()->first();
       $data['vehicle_id'] = $data->vehicle_id;
       // return $vehicle_id;
    
      // dd($data);
       return view('fuel.edit',$data);
    }

    public function update(Request $request)
    {
      // dd($request->all());
     $fuel = FuelModel::find($request->get("id"));
    // $form_data = $request->all();
     $fuel->start_meter = $request->get('start_meter');
     $fuel->reference = $request->get('reference');
     $fuel->province = $request->get('province');
     $fuel->note = $request->get('note');
     
     $fuel->qty = $request->get('qty');
     $fuel->fuel_from = $request->get('fuel_from');
     $fuel->vendor_name = $request->get('vendor_name');
     $fuel->cost_per_unit = $request->get('cost_per_unit');
     $fuel->date = $request->get('date');   
     $fuel->complete = $request->get("complete");
     $fuel->save();
      
      return redirect()->route('fuel.index');

    }

    public function destroy(Request $request)
    {
     
      FuelModel::find($request->get('id'))->delete();
      return redirect()->route('fuel.index');
    }
}
