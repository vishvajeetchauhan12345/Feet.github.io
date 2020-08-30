@extends('layouts.app')

@section('content')
<div style="margin:5% 40% 0% 33%;float:left; width:500px; box-shadow:0 0 3px #aaa; height:auto;color:#666;">
   <div style="width:100%; padding:10px; float:left; background:#1ca8dd; color:#fff; font-size:30px; text-align:center;">
  Invoice
   </div>
    <div style="width:100%; padding:0px 0px;border-bottom:1px solid rgba(0,0,0,0.2);float:left;">
        <div style="width:30%; float:left;padding:10px;">
           
            <span style="font-size:14px;float:left; width:100%;">
              
                {{ $booking->customer->name }}
            </span>
       
        </div>
    
        <div style="width:40%; float:right;padding:">
            <span style="font-size:14px;float:right;  padding:10px; text-align:right;">
                <b>@lang('fleet.date') : </b>{{ $info->date }}
            </span>
            <span style="font-size:14px;float:right;  padding:10px; text-align:right;">
               <b>@lang('fleet.receipt')#</b>
               {{ $i['income_id'] }}
            </span>
        </div>
    </div>
   
    <div style="width:100%; padding:0px; float:left;">
     
          <div style="width:100%;float:left;background:#efefef;">
            <span style="float:left; text-align:left;padding:10px;width:50%;color:#888;font-weight:600;">
           @lang('fleet.vehicle')
           </span>
         <span style="font-weight:600;float:left;padding:10px ;width:40%;color:#888;text-align:right;">
         {{$booking->vehicle['make']}} - {{$booking->vehicle['model']}} - {{$booking->vehicle['license_plate']}}
        </span>
      </div>
    
      <div style="width:100%;float:left;">
            <span style="float:left; text-align:left;padding:10px;width:50%;color:#888;">
            @lang('fleet.mileage') (km)
          
            
        </span>
         <span style="font-weight:normal;float:left;padding:10px ;width:40%;color:#888;text-align:right;">
           {{ $info['mileage'] }}
        </span>
      </div>
     <div style="width:100%;float:left;">
            <span style="float:left; text-align:left;padding:10px;width:50%;color:#888;">
            @lang('fleet.amount')          
            
        </span>
         <span style="font-weight:normal;float:left;padding:10px ;width:40%;color:#888;text-align:right;">
           {{ $info['amount'] }}
        </span>
      </div>
    
         <div style="width:100%;float:left; background:#fff;">
           
         <span style="font-weight:600;float:right;padding:10px 0px;width:40%;color:#666;text-align:center;">
           Total : {{ $info['amount'] }}
        </span>
      </div>

    </div>
@endsection