<?php

namespace App\DataTables;

use App\Models\Donor;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DonationsListDataTable extends DataTable
{

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addColumn('checkbox', function ($query) {
                return '<input type="checkbox" class="select-row ticked" name="tick" value="' . $query->id . '">';
            })
            ->addColumn('action', function ($query) {
                return '<div class="d-flex justify-content-center">
                            <a href="'. url('/admin/donations/downloadReceipt/'. $query->receipt_no) .'" class="btn btn-sm btn-danger me-1" style="font-size:11px;">
                                <i class="fa fa-file-pdf"></i>
                            </a>
                            <a href="javascript:void(0);" donor_id="'.$query->id.'"
                                class="btn btn-sm btn-primary btn-edit-donor me-1" style="font-size:11px;">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="'. url('admin/donations/show/'. $query->id ).'" class="btn btn-sm btn-info" style="font-size:11px;">
                                <i class="bi bi-eye"></i>
                            </a>

                        </div>';
            })
            ->editColumn('amount', function ($query) {
                return '₹ '. number_format($query->amount, 2);
            })
            ->editColumn('created_at', function ($query) {
                return date('d M Y', strtotime($query->created_at));
            })
            ->rawColumns(['action', 'checkbox', 'amount', 'created_at'])
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Donor $model): QueryBuilder
    {
        return $model->newQuery();
    }


    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('donatitonslist-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            -> parameters([
                'pageLength' => 50,
                'aLengthMenu' => [ 50, 100, 200, 500]
            ]);
    }


    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('SL')->orderable(false)->searchable(false),

            Column::computed('checkbox')->width(30)->addClass('text-center')
            ->title('<input type="checkbox" id="select-all">')
            ->orderable(false)->searchable(false),
            // ->render("'<input type=\"checkbox\" class=\"select-row\" value=\"'+data.id+'\">'"),

            Column::make('receipt_no')->title('Rect No'),
            Column::make('payment_id')->title('Trans. Id'),
            Column::make('amount')->title('Amount'),
            Column::make('created_at')->title('Date')->orderable(true)->width(150),
            Column::make('donar_name')->title('Donor Name'),
            Column::make('donar_phone')->title('Donor Phone')->orderable(false),
            Column::make('pdf_status')->title('Mail Info')->orderable(false),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(50)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'donatitonsList_' . date('YmdHis');
    }


}
