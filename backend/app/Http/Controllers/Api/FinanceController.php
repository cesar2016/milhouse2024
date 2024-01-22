<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function daily_cash(){

        $reports = Payment::whereDate('date_payment', now())
            ->join('clients', 'payments.client_id', '=', 'clients.id')
            ->get();


            //echo $reports;
            if( count($reports) < 1){

                return response()->json([

                    'street_cash_lonly' => $this->street_cash(),

                ]);


            }



        $date = $reports[0]->date_payment; //'2023-10-31 10:10:10';
        $date_format = Carbon::parse($date)->format('d-m-Y');


        return response()->json([
                'report' => $reports,
                'date_format' => $date_format,
                'street_cash' => $this->street_cash(),
                'sum_debt' => $reports->sum('debt'),
                'sum_payment' => $reports->sum('payment'),
                'sum_countdown' => $reports->sum('countdown'),

            ]);
    }

    public function frame_cash(Request $request){


        // Funcion vieja por periodo
        /*$reports = Payment::whereDate('date_payment', '>=', $request->from)
            ->whereDate('date_payment', '<=', $request->until)
            ->join('clients', 'payments.client_id', '=', 'clients.id')
            ->get();*/

        //return $request->month;

        if($request->day > 1){

            $reports = Payment::whereMonth('date_payment', $request->month)
            ->whereYear('date_payment', $request->age)
            ->whereDay('date_payment', $request->day)
            ->join('clients', 'payments.client_id', '=', 'clients.id')
            ->get();

        }else{

            $reports = Payment::whereMonth('date_payment', $request->month)
            ->whereYear('date_payment', $request->age)
            ->join('clients', 'payments.client_id', '=', 'clients.id')
            ->get();

        }





        return response()->json([
                'report' => $reports,
                'street_cash' => $this->street_cash(),
                'sum_debt' => $reports->sum('debt'),
                'sum_payment' => $reports->sum('payment'),
                'sum_countdown' => $reports->sum('countdown'),

            ]);
    }

    public function street_cash(){

          $sum_total_debt = Payment::all()->sum('debt');
          $sum_total_payment = Payment::all()->sum('payment');
          $sum_total_countdow = Payment::all()->sum('countdown');

        return $sum_total_debt - ($sum_total_payment - $sum_total_countdow);

    }
}
