<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AllOrderDataTable extends DataTable
{

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){
                return '<div class="d-flex jc">
                        <div class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="btn btn-floating"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="' . url('admin/orders/show', $query->order_id ) . '" class="dropdown-item"> View Order </a>
                            </div>
                        </div>
                    </div>';
            })
            ->editColumn('customer', function($query){
                return $query->user->name;
            })
            ->editColumn('order_id', function($query){
                return '<a href="'.url('/admin/orders/show', $query->order_id ).'" style="text-decoration:underline;"> '.$query->order_id.'</a>';
            })
            ->editColumn('order_cost', function($query){
                return '₹' .$query->order_cost;
            })
            ->editColumn('shipping_cost', function($query){
                return '₹' .$query->shipping_cost;
            })
            ->addColumn('created_at', function($query){
                return date('d-M-Y', strtotime($query->created_at));
            })
            ->editColumn('payment_type', function($query){
                if($query->payment_type === 'cash'){
                    return "<span class='text-danger'>". $query->payment_type ."</span>";
                }else{
                    return "<span class='text-success'>". $query->payment_type ."</span>";
                }
            })
            ->editColumn('payment_status', function($query){
                if($query->payment_status === 'captured'){
                    return "<span class='badge bg-success'>". $query->payment_status ."</span>";
                }else {
                    return "<span class='badge bg-danger'>".  $query->payment_status ."</span>";
                }
            })
            ->editColumn('status', function($query){
                switch ($query->status) {
                    case 'Pending':
                        return "<span class='badge bg-warning'>Pending</span>";
                        break;
                    case 'Processing':
                        return "<span class='badge bg-info'>Processing</span>";
                        break;
                    case 'Shipped':
                        return "<span class='badge bg-info'>Shipped</span>";
                        break;
                    case 'Delivered':
                        return "<span class='badge bg-success'>Delivered</span>";
                        break;
                    case 'Cancelled':
                        return "<span class='badge bg-danger'>Cancelled</span>";
                        break;
                    default:
                        return "<span class='badge bg-warning'>".$query->status."</span>";
                        break;
                }
            })
            ->rawColumns(['status', 'action', 'payment_type', 'payment_status', 'order_id'])
            ->addIndexColumn()
            ->setRowId('id');
    }


    public function query(Order $model): QueryBuilder
    {
        return $model->with('user')->with('transaction')->orderBy('id', 'desc')->newQuery();
    }


    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('order-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1);
    }

    public function getColumns(): array
    {
        return [

            Column::make('DT_RowIndex')->title('SL No')->orderable(false)->searchable(false),
            Column::make('order_id')->width(100),
            Column::make('created_at')->title('Date')->width(100),
            Column::make('user.name')->title('customer'),
            Column::make('total_qty')->title('Quantity'),
            Column::make('order_cost'),
            Column::make('shipping_cost'),
            Column::make('payment_type')->title('Payment Mode'),
            Column::make('payment_status')->title('Pay Status'),
            Column::make('status')->title('Order Status'),


            Column::computed('action')->exportable(false)->printable(false)->width(60)
            ->addClass('text-center'),
        ];
    }


    protected function filename(): string
    {
        return 'Order_' . date('YmdHis');
    }
}
