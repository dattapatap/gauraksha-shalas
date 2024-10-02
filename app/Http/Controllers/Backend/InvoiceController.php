<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\InvoiceDataTable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index(InvoiceDataTable $dataTable)
    {
        return $dataTable->render('backend.invoice.index');
    }

    public function generateInvoice(Request $request){
        $orederId = $request->order_id;
        // $orederId = 'OD0000011';
        $order = Order::with('orderitems')
                            ->where('order_id', $orederId)
                            ->first()->toArray();
        if($order){

            $products = $order['orderitems'];
            foreach($products as $key=>$item){
                if($item['is_variant'] == true)   {
                    $currVarItem = DB::table('product_variant_items')->where('id', $item['variant_id'])->first();
                    if($currVarItem){
                        $variantType = DB::table('product_variants')->where('id', $currVarItem->product_variant_id)->first();
                        if($variantType){
                            $item['variant_name'] = $currVarItem->name;
                            $item['variant'] = $variantType->name;
                        }else{
                            $item['variant_name'] = '';
                            $item['variant'] = '';
                        }
                    }
                }else{
                    $item['variant_name'] = '';
                    $item['variant'] = '';
                }
                $order['orderitems'][$key] = $item;
            }



            $pdf = Pdf::loadView('backend.pdftemplate/invoice', compact('order'));
            return $pdf->download($orederId.'.pdf');
        }else{
            return abort(404);
        }
    }




}
