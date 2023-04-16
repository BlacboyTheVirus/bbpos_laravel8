<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Invoiceitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       // top 10 customers
        $top_customers = DB::table('customers')
                ->join('invoices', 'invoices.customer_id', '=', 'customers.id')
                ->select('customers.*', DB::raw("(customer_amount_due + customer_invoice_due) as total_dues"), DB::raw("sum(invoice_grand_total) as total_invoice"), DB::raw("sum(invoice_amount_paid) as total_paid"), DB::raw('COUNT(invoices.id) as invoice_count'))
                ->where('customers.id', '<>', '1')
                ->groupBy('customers.id')
                ->orderBy('total_invoice', 'desc')
                ->take(5)->get();
                
                //  dd($top_customers);


        return view('dashboard', compact(['top_customers']));
    }


   

    public function barchartdata(){

        $invoices = Invoice::select(
            DB::raw('sum(invoice_grand_total) as sales_total'), 
            DB::raw("DATE_FORMAT(invoice_date,'%m') as monthKey")
        )
        ->whereYear('invoice_date', date('Y'))
        ->groupBy('monthKey')
        ->orderBy('monthKey', 'ASC')
        ->get();

        $salesdata = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach($invoices as $invoice){
            $salesdata[$invoice->monthKey-1] = $invoice->sales_total;
        }

       
        $expenses = Expense::select(
            DB::raw('sum(expenses_amount) as expense_total'), 
            DB::raw("DATE_FORMAT(expenses_date,'%m') as monthKey")
        )
        ->whereYear('expenses_date', date('Y'))
        ->groupBy('monthKey')
        ->orderBy('monthKey', 'ASC')
        ->get();

        $expensedata = [0,0,0,0,0,0,0,0,0,0,0,0];
        foreach($expenses as $expense){
            $expensedata[$invoice->monthKey-1] = $expense->expense_total;
        }
        


        $sav_total = Invoiceitem::where('product_name', 'SAV')->sum('total_amount');
        $flex_total = Invoiceitem::where('product_name', 'Flex')->sum('total_amount');
        
        $totals[] = number_format($flex_total,2,'.', '');
        $totals[] = number_format($sav_total,2,'.', '');
        
       
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        foreach ($months as &$value) {
            $value = $value." '". date('y');
        }
        $data = array(
            "months" => $months,
            "sales" => $salesdata,
            "expenses" => $expensedata,
            "totals" => $totals,
        );

        return response()->json($data);
    }


    public function gettabsdata(Request $request){

        $curdate = strtotime(date('d-m-Y')); 
        $curday = date('w', $curdate); //0-6

        $start_of_week = date('Y-m-d', strtotime('-'.$curday.' days', $curdate));
        $start_of_month = date('Y-m-01');
        $start_of_year = date('Y-01-01');

        $filter = "id > 0"; //no filter

        $dates = $request->period;
        
        
        //INVOICE SUMMARY
         
        if($dates=='today'){
           $filter = " invoice_date = '". date('Y-m-d')."'";
        }

        if($dates=='week'){
            $filter = " invoice_date >= '". $start_of_week."'";
        }

        if($dates=='month'){
            $filter = " invoice_date >= '".$start_of_month."'";
        }

        if($dates=='year'){
            $filter = " invoice_date >= '". $start_of_year."'";
        }

          $total_invoice = DB::table('invoices')->select('*')->whereRaw($filter)->sum('invoice_grand_total');
          $paid_invoice = DB::table('invoices')->select('*')->whereRaw($filter)->sum('invoice_amount_paid');
          $due_invoice = $total_invoice - $paid_invoice;

          $invoice_count =  DB::table('invoices')->select('*')->whereRaw($filter)->count();
        
        
        
        // EXPENSES SUMMARY 

            if($dates=='today'){
                 $filter = " expenses_date = '". date('Y-m-d')."'";
            }
    
            if($dates=='week'){
                $filter = " expenses_date >= '". $start_of_week."'";
            }
    
            if($dates=='month'){
                $filter = " expenses_date >= '".$start_of_month."'";
            }
    
            if($dates=='year'){
                $filter = " expenses_date >= '". $start_of_year."'";
            }
       
            $total_expenses = DB::table('expenses')->select('*')->whereRaw($filter)->sum('expenses_amount');



            //JOB COUNT SUMMARY         
            if($dates=='today'){
                $filter = " invoice_date = '". date('Y-m-d')."'";
            }
    
            if($dates=='week'){
                $filter = " invoice_date >= '". $start_of_week."'";
            }
    
            if($dates=='month'){
                $filter = " invoice_date >= '".$start_of_month."'";
            }
    
            if($dates=='year'){
                $filter = " invoice_date >= '". $start_of_year."'";
            }
    
            $invoices =  Invoice::whereRaw($filter)->with('invoiceitems')->get();
                $job_count = 0;

                $flex_total = 0;
                $sav_total = 0;
            
                foreach ($invoices as $invoice){
                    $latest = $invoice->invoiceitems;

                    foreach ($latest as $item){
                        $job_count += $item->quantity;

                        if ($item->product_name=="SAV") $sav_total += $item->total_amount;
                        if ($item->product_name=="Flex") $flex_total += $item->total_amount;

                    }

                }    
               

        


        
         
        //  $dates = $this->input->post('dates');
		// if($dates=='Today'){
      	// 	//$this->db->where("$table_date > DATE_SUB(NOW(), INTERVAL 1 DAY)");
      	// 	$this->db->where("$table_date",date("Y-m-d"));
      	// }
      	// if($dates=='Weekly'){
      	// 	$this->db->where("$table_date > DATE_SUB(NOW(), INTERVAL 1 WEEK)");
      	// }
      	// if($dates=='Monthly'){
      	// 	$this->db->where("$table_date > DATE_SUB(NOW(), INTERVAL 1 MONTH)");
      	// }
      	// if($dates=='Yearly'){
      	// 	$this->db->where("$table_date > DATE_SUB(NOW(), INTERVAL 1 YEAR)");
      	// }

        $data = array(
            "invoice_amount" => number_format($total_invoice),
            "invoice_payment" => number_format($paid_invoice),
            "invoice_due" => number_format($due_invoice),
            "expenses_total" => number_format($total_expenses),
            "invoice_count" => number_format($invoice_count),
            "job_count" => number_format($job_count),
            "flex_total" => money_format($flex_total, 0),
            "sav_total" => money_format($sav_total, 0),
        );
        
      
        
        return response()->json($data);
      
    }
}
