<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SliderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                return '<div class="d-flex jc">
                        <div class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="btn btn-floating"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="' . route('admin.slider.edit', $query->id) . '" class="dropdown-item"> Edit</a>
                                <a href="javascript:void(0);" data="' . $query->id . '" class="dropdown-item delete-brand">Delete</a>
                            </div>
                        </div>
                    </div>';
            })
            ->addColumn('banner', function ($query) {
                return "<a href='" . asset("storage/" . $query->image) . "' target='_new'><img width='150px' src='" . asset("storage/" . $query->image) . "' ></img></a>";
            })
            ->editColumn('slider_type', function ($query) {
                if ($query->slider_type == 1) {
                    return '<span class="badge bg-success">Web</span>';
                } else {
                    return '<span class="badge bg-info">Mobile</span>';
                }
            })
            ->editColumn('status', function ($query) {
                if($query->status == 1){
                    $button = '<div class="form-check form-switch">
                                    <input class="form-check-input change-status" type="checkbox" id="'.$query->id.'" checked>
                                </div>';
                }else {
                    $button = '<div class="form-check form-switch">
                                    <input class="form-check-input change-status" type="checkbox" id="'.$query->id.'">
                                </div>';
                }
                return $button;
            })
            ->rawColumns(['sl','banner', 'action', 'slider_type', 'status'])
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Slider $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('slider-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('DT_RowIndex')->title('SL No')->orderable(false)->searchable(false),
            Column::make('banner')->width(200),
            Column::make('title'),
            Column::make('serial'),
            Column::make('slider_type'),
            Column::make('status')->title('Publish'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Slider_' . date('YmdHis');
    }
}
