<?php

namespace App\DataTables;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TransactionDataTable extends DataTable
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
                                <a href="" target="_blank" class="dropdown-item"> View Transaction </a>
                            </div>
                        </div>
                    </div>';
            })
            ->editColumn('payment_amount', function($query){
                return '₹' .number_format($query->payment_amount, 2) ;
            })
            ->editColumn('created_at', function($query){
                return date('d-M-Y', strtotime($query->created_at));
            })
            ->editColumn('status', function($query){
                if($query->status === 'captured'){
                    return "<span class='badge bg-success'>". $query->status ."</span>";
                }elseif($query->status === 'Pending'){
                    return "<span class='badge bg-warning'>". $query->status ."</span>";
                }else {
                    return "<span class='badge bg-danger'>".  $query->status ."</span>";
                }
            })
            ->rawColumns(['action','order.payment_type', 'status', 'order.order_id'])
            ->addIndexColumn()
            ->setRowId('id');

    }


    public function query(Transaction $model): QueryBuilder
    {
        return $model->with('user')->orderBy('id', 'desc')->limit(6)->newQuery();
    }


    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('transaction-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0);
    }


    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('SL No')->orderable(false)->searchable(false),
            Column::make('payment_id')->title('Transaction Id'),
            Column::make('payment_name')->title('Donor Name'),
            Column::make('payment_amount')->title('Amount'),
            Column::make('status')->title('Payment Status'),
            Column::make('created_at')->title('Transaction Date')->width(100),
            Column::computed('action')->exportable(false)->printable(false)->width(70)->addClass('text-center'),

        ];
    }


    protected function filename(): string
    {
        return 'Transaction_' . date('YmdHis');
    }
}
