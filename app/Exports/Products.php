<?php

namespace App\Exports;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Products extends DefaultValueBinder implements FromCollection, WithHeadings , ShouldAutoSize, WithCustomValueBinder
{


    public $request;
    function __construct($request) {
            $this->request = $request;
    }

    public function collection()
    {

        $orders  = Project::select('products.id', 'products.name', 'products.slug', 'br.brand_name', 'pm.model_name', 'ct.name as ct_name', 'sct.name as sct_name',
                        'ctt.name as ctt_name', 'products.sku', 'products.price', 'products.client_discount', 'products.distributor_discount',
                        'products.warrenty', 'products.short_description', 'products.features', 'products.created_at')
                        ->leftJoin('brands as br', 'br.id', '=', 'products.brand_id')
                        ->leftJoin('product_models as pm', 'pm.id', '=', 'products.model_id')
                        ->leftJoin('categories as ct', 'ct.id', '=', 'products.category_id')
                        ->leftJoin('sub_categories as sct', 'sct.id', '=', 'products.sub_category_id')
                        ->leftJoin('category_types as ctt', 'ctt.id', '=', 'products.type_id');

        if ( $this->request->search) {
            $val =  $this->request->search;
            $orders->Where('products.name', 'LIKE', "%$val%");
            $orders->orWhere('products.sku', 'LIKE', "%$val%");
            $orders->orWhere('products.price', 'LIKE', "%$val%");
            $orders->orWhere('products.client_discount', 'LIKE', "%$val%");
            $orders->orWhere('products.distributor_discount', 'LIKE', "%$val%");
            $orders->orWhere('products.warrenty', 'LIKE', "%$val%");
            $orders->orWhere('products.short_description', 'LIKE', "%$val%");
            $orders->orWhere('br.brand_name', 'LIKE', "%$val%");
            $orders->orWhere('pm.model_name', 'LIKE', "%$val%");
            $orders->orWhere('ct.name', 'LIKE', "%$val%");
            $orders->orWhere('sct.name', 'LIKE', "%$val%");
            $orders->orWhere('ctt.name', 'LIKE', "%$val%");
        }
        $datas = $orders->get();

        foreach($datas as $key=>$row){
            $row->id = $key + 1;
        }
        return $datas;
    }


    public function map($row): array
    {
        return [

        ];
    }

    public function headings(): array
    {
        return ["Sr. No.", "Project Name", "Project Slug", "Brand",  "Madel", "Project Category", "Project Sub Category", "Project Type",
                    "SKU Units", "Price ", "Client Discount", "Distributor Discount", "Warrenty", "Short Descriptions", "Features", "Created Date"];
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_NUMERIC);

            return true;
        }
        return parent::bindValue($cell, $value);
    }


}
