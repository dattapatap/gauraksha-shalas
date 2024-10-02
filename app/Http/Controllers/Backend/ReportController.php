<?php

namespace App\Http\Controllers\Backend;

use App\Exports\Customers;
use App\Exports\Products;
use App\Exports\Sales;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    public function index()
    {
        return view('backend.reports.index');
    }


    public function filterReports(Request $request){

        $category = $request->category;
        $ranges = $request->range;


        $date_start = date('Y-m-d 00:00:00');
        $date_end = date('Y-m-d 23:59:59');

        if($ranges == 'custom'){
            $range = explode(' - ', $request->get('reportrange'));
            $date_start = Carbon::createFromFormat('d/m/Y', $range[0])->startOfDay();
            $date_end = Carbon::createFromFormat('d/m/Y', $range[1])->endOfDay();
        }elseif($ranges == 'current_month'){
            $date_start = Carbon::now()->startOfMonth();
            $date_end = Carbon::now()->endOfMonth();
        }elseif($ranges == 'last_month'){
            $date_start = Carbon::now()->startOfMonth()->subMonthsNoOverflow();
            $date_end = Carbon::now()->subMonthsNoOverflow()->endOfMonth();
        }elseif($ranges == 'year'){
            $date_start = Carbon::now()->startOfYear();
            $date_end = Carbon::now()->endOfYear();
        }else{
            $date_start = date('Y-m-d 00:00:00');
            $date_end = date('Y-m-d 23:59:59');
        }

        if($category == 'sales'){

            $orders  = Order::select('id', 'order_id', 'invoice_no', 'tax_id','delivery_name' , 'city', 'subtotal', 'shipping_cost', 'tax_amount', 'status', 'created_at' )
                                ->whereNotIn('status', ['Cancelled', 'Initiated'])
                                ->whereDate('created_at', '>=', $date_start )
                                ->whereDate('created_at', '<=', $date_end );


            return DataTables::of($orders)
                    ->addIndexColumn()
                    ->editColumn('subtotal', function($order){
                        return '₹'.number_format(round($order->subtotal), 2);
                    })
                    ->editColumn('shipping_cost', function($order){
                        return '₹'.number_format(round($order->shipping_cost), 2);
                    })
                    ->editColumn('tax_amount', function($order){
                        return '₹'.number_format(round($order->tax_amount), 2);
                    })
                    ->editColumn('created_at', function ($data){
                        return Carbon::parse($data->created_at)->format('d M y h:i A');
                    })
                    ->filterColumn('created_at', function ($query, $keyword) {
                        $query->whereRaw("DATE_FORMAT(created_at,'d% M% y%') LIKE ?", ["%$keyword%"]);
                    })
                    ->rawColumns([])
                    ->make(true);
        }

        if($category == 'customers'){

            $users  = User::select('id', 'profile', 'name', 'rolecode', 'email','mobile' , 'city', 'created_at' )
                                ->whereDate('created_at', '>=', $date_start )
                                ->whereDate('created_at', '<=', $date_end );

            return DataTables::of($users)
                    ->addIndexColumn()
                    ->editColumn('profile', function($user){
                        if($user->profile  && Storage::disk('public')->exists($user->profile)){
                            $img =  Storage::disk('public')->url($user->profile);
                        }else{
                            $img = asset('assets/img1/testimonal.jpg');
                        }
                        return '<img class="rounded" style="width:30px" src="' . $img . '">';
                    })
                    ->editColumn('rolecode', function($user){
                        if($user->rolecode == 'Client'){
                            return '<span class="badge bg-primary">Client</span>' ;
                        }else{
                            return '<span class="badge bg-info">Distributor</span>' ;
                        }
                    })
                    ->editColumn('created_at', function ($data){
                        return Carbon::parse($data->created_at)->format('d M y h:i A');
                    })
                    ->filterColumn('created_at', function ($query, $keyword) {
                        $query->whereRaw("DATE_FORMAT(created_at,'d% M% y%') LIKE ?", ["%$keyword%"]);
                    })
                    ->rawColumns(['profile', 'rolecode'])
                    ->make(true);
        }

        if($category == 'stocks'){

            $products  = Project::select('products.id', 'products.name', 'products.sku', 'products.price', 'products.slug', 'products.created_at',
                                'pvi.name as variant', 'pvi.sku as vsku', 'pvi.price as vprice', 'pvi.id as vid', 'pv.id as pvid')
                                ->leftJoin('product_variants as pv', 'pv.product_id', '=', 'products.id')
                                ->leftJoin('product_variant_items as pvi', 'pvi.product_variant_id', '=', 'pv.id')
                                ->orderBy('products.sku', 'asc');

            return DataTables::of($products)
                    ->addIndexColumn()
                    ->editColumn('variant', function($product){
                        if($product->variant != null){
                            return $product->variant;
                        }else{
                            return '--' ;
                        }
                    })
                    ->editColumn('price', function($product){
                        if($product->variant != null){
                            if($product->vprice == 0){
                                return '₹'.number_format($product->price, 2);
                            }else{
                                return '₹'.number_format($product->vprice, 2);
                            }
                        }else{
                            return '₹'.number_format($product->price, 2);
                        }
                    })
                    ->editColumn('sku', function($product){
                        if($product->variant != null){
                            return $product->vsku;
                        }else{
                            return $product->sku;
                        }
                    })
                    ->addColumn('action', function($query){
                        if($query->variant != null){
                            return '<div class="d-flex">
                                        <a class="btn btn-sm btn-default" target="_blank"  href="' . url('admin/products/'.$query->slug.'/variants/'.$query->pvid.'/items/'.$query->vid.'/edit') . '"><i class="bi bi-pencil"></i></a>
                                        <a class="btn btn-sm btn-default" target="_blank" href="' . url('product-details/'. $query->slug .'?variant='.base64_encode($query->vid)) . '"> <i class="bi bi-eye"></i> </a>
                                    </div>';
                        }else{
                            return '<div class="d-flex">
                                        <a class="btn btn-sm btn-default" target="_blank" href="'. url('admin/products/' .$query->id . '/edit') . '"><i class="bi bi-pencil"></i></a>
                                        <a class="btn btn-sm btn-default" target="_blank" href="' . url('product-details/'. $query->slug) . '"> <i class="bi bi-eye"></i> </a>
                                    </div>';
                        }
                    })

                    ->editColumn('created_at', function ($data){
                        return Carbon::parse($data->created_at)->format('d M y h:i A');
                    })
                    ->filterColumn('created_at', function ($query, $keyword) {
                        $query->whereRaw("DATE_FORMAT(created_at,'d% M% y%') LIKE ?", ["%$keyword%"]);
                    })
                    ->rawColumns(['variant', 'action'])
                    ->make(true);

        }

        if($category == 'products'){

            $users  = Project::select('products.id', 'products.name', 'products.slug', 'br.brand_name', 'pm.model_name', 'ct.name as ct_name', 'sct.name as sct_name',
                                'ctt.name as ctt_name', 'products.sku', 'products.price', 'products.client_discount', 'products.distributor_discount', 'products.product_type',
                                'products.warrenty', 'products.short_description', 'products.features')
                                ->leftJoin('brands as br', 'br.id', '=', 'products.brand_id')
                                ->leftJoin('product_models as pm', 'pm.id', '=', 'products.model_id')
                                ->leftJoin('categories as ct', 'ct.id', '=', 'products.category_id')
                                ->leftJoin('sub_categories as sct', 'sct.id', '=', 'products.sub_category_id')
                                ->leftJoin('category_types as ctt', 'ctt.id', '=', 'products.type_id');

            return DataTables::of($users)
                    ->editColumn('price', function($order){
                        return '₹'.number_format(round($order->price), 2);
                    })
                    ->editColumn('client_discount', function($order){
                        return ($order->client_discount).' %';
                    })
                    ->addIndexColumn()
                    ->make(true);
        }


    }


    public function downloadReport(Request $request)
    {
        $category     = $request->category;
        $file_format  = $request->file_format;

        if ( $category == 'customers' ) {
            if ($file_format == 'xlsx') {
                $response = Excel::download(new Customers($request), 'customer_list.xlsx', \Maatwebsite\Excel\Excel::XLSX);
                return $response;
            } else if ($file_format == 'csv') {
                $response = Excel::download(new Customers($request), 'customer_list.csv', \Maatwebsite\Excel\Excel::CSV);
                return $response;
            }
        }
        elseif ($category == 'sales'){
            if ($file_format == 'xlsx') {
                $response = Excel::download(new Sales($request), 'sales.xlsx', \Maatwebsite\Excel\Excel::XLSX);
                return $response;
            } else if ($file_format == 'csv') {
                $response = Excel::download(new Sales($request), 'sales.xlsx', \Maatwebsite\Excel\Excel::CSV);
                return $response;
            }
        } elseif ($category == 'stocks'){
            $myFile = Excel::download(new Sales($request), 'admin_list.xlsx', \Maatwebsite\Excel\Excel::XLSX);
            return $myFile;
        } elseif ($category == 'products'){
            if ($file_format == 'xlsx') {
                $response = Excel::download(new Products($request), 'product_list.xlsx', \Maatwebsite\Excel\Excel::XLSX);
                return $response;
            } else if ($file_format == 'csv') {
                $response = Excel::download(new Products($request), 'product_list.xlsx', \Maatwebsite\Excel\Excel::CSV);
                return $response;
            }
        }

    }


}
