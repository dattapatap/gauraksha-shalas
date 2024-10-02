<?php

namespace App\DataTables;

use App\Models\Donor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DonorListDataTable extends DataTable
{

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            // ->addColumn('action', function ($query) {
            //     return '<div class="d-flex jc">
            //             <div class="dropdown">
            //                 <a href="#" data-bs-toggle="dropdown" class="btn btn-floating"
            //                     aria-haspopup="true" aria-expanded="false">
            //                     <i class="bi bi-three-dots"></i>
            //                 </a>
            //                 <div class="dropdown-menu dropdown-menu-end">
            //                     <a href="' . route('admin.customer.show', $query->id) . '" class="dropdown-item"> Show</a>
            //                 </div>
            //             </div>
            //         </div>';
            // })
            // ->editColumn('register_date', function ($query) {
            //     return date('d M Y', strtotime($query->created_at));
            // })
            // ->rawColumns(['action', 'profile', 'register_date' ,'rolecode'])
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Donor $model): QueryBuilder
    {
        return $model->groupBy('donar_name')->orderBy('id', 'desc')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('donorlist-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            -> parameters([
                'pageLength' => 50,
                'aLengthMenu' => [ 50, 100, 200, 500]
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('SL No')->orderable(false)->searchable(false),
            Column::make('donar_name')->title('Donor Name'),
            Column::make('donar_email')->title('Donot Email'),
            Column::make('donar_phone')->title('Donor Mobile'),
            Column::make('donar_city')->title('Donor City'),
            Column::make('donar_pan')->title('Donor Pan')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'DonorList_' . date('YmdHis');
    }
}
