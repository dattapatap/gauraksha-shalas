<?php

namespace App\DataTables;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BlogDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addColumn('action', function($query){
                return '
                        <div class="d-flex jc">
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" class="btn btn-floating"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="'.route('admin.blogs.edit', $query->id).'" class="dropdown-item"> Edit</a>
                                    <a href="javascript:void(0);" data="'.$query->id.'" class="dropdown-item delete-blog">Delete</a>
                                </div>
                            </div>
                        </div>';


            })
            ->addColumn('image', function($query){
                 return "<a target='_new' href='".asset('storage/'.$query->image)."'><img style='width:100px;border-radius:10px;' src='".asset('storage/'.$query->image)."' ></img>";
            })
            ->editColumn('category.name', function($query){
                return $query->category->name;
            })
            ->editColumn('publish_date', function($query){
                return date('d-m-y', strtotime($query->created_at));
            })
            ->editColumn('status', function($query){
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
            ->rawColumns(['action', 'image', 'status'])
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Blog $model): QueryBuilder
    {
        return $model::with('category')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('blog-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(0);

    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('DT_RowIndex')->title('SL No')->orderable(false)->searchable(false),
            Column::make('image')->orderable(false),
            Column::make('category.name')->title('Category')->orderable(false),
            Column::make('title')->orderable(true),
            Column::make('status')->title('Publish')->orderable(true),
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
        return 'Blog_' . date('YmdHis');
    }
}
