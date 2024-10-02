
@extends('backend.layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/datepicker/daterangepicker.css') }}" />
    <style>
        .filter-reports .nav-item.show .nav-link, .filter-reports .nav-link.active {
            color: #fa6401!important;
            background-color: #fff!important;
            border-color: #fa6401 #fa6401 #fefefe!important;
        }
        .filter-reports .nav-link {
            padding: 0.5rem 1.5rem;
        }
        .text-right{
            text-align: right;
        }

    </style>
@endsection


@section('content')

    <div class="mb-2 d-flex">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin/home') }}">
                        <i class="bi bi-globe2 small me-2"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Reports</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body ">

            {{-- Report Main Category --}}
            <ul class="nav nav-pills mb-1 nav-order-items" role="tablist">
                <li class="nav-item @if (request()->segment(3) == 'sales') active @endif" role="presentation">
                    <a class="nav-link @if (request()->segment(3) == 'sales') active @endif" href="{{ url('admin/reports', 'sales') }}" role="tab"
                        aria-controls="pills-home" aria-selected="true">Sales</a>
                </li>
                <li class="nav-item @if (request()->segment(3) == 'customers') active @endif" role="presentation">
                    <a class="nav-link @if (request()->segment(3) == 'customers') active @endif" href="{{ url('admin/reports', 'customers') }}" role="tab"
                        aria-controls="pills-contact" aria-selected="false">Customers</a>
                </li>
                <li class="nav-item @if (request()->segment(3) == 'stocks') active @endif" role="presentation">
                    <a class="nav-link @if (request()->segment(3) == 'stocks') active @endif" href="{{ url('admin/reports', 'stocks') }}" role="tab"
                        aria-controls="pills-contact" aria-selected="false">Stocks</a>
                </li>

                <li class="nav-item @if (request()->segment(3) == 'products') active @endif" role="presentation">
                    <a class="nav-link @if (request()->segment(3) == 'products') active @endif" href="{{ url('admin/reports', 'products') }}" role="tab"
                        aria-controls="pills-contact" aria-selected="false">Products</a>
                </li>
            </ul>

            <hr>

            {{-- Report Types --}}
            @if(request()->segment(3) == 'sales' || request()->segment(3) == 'customers')
            <ul class="nav nav-tabs mb-3 filter-reports" id="myTab " role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link @if(request()->get('range')== 'year' ) active @endif" href="{{ url('admin/reports/'.request()->segment(3).'?range=year') }}">Year</a>
                </li>
                <li class="nav-item " role="presentation">
                    <a class="nav-link @if(request()->get('range')== 'last_month' ) active @endif" href="{{ url('admin/reports/'.request()->segment(3).'?range=last_month') }}"
                        aria-controls="profile">Last Month</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link @if(request()->get('range')== 'current_month' ) active @endif" href="{{ url('admin/reports/'.request()->segment(3).'?range=current_month') }}"> This Month</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link @if(request()->get('range')== 'today' || request()->get('range')=='' ) active @endif" href="{{ url('admin/reports/'.request()->segment(3).'?range=today') }}">Today</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link @if(request()->get('range')== 'custom') active @endif" style="padding: 0.3rem 1rem;width:350px;" href="javascript:void(0)">
                        <div class="search-box position-relative">
                            <form action="{{ url('admin/reports/'.request()->segment(3).'?range=custom') }}">
                                <input type="hidden" value="custom" name="range" required>
                                <label>Custom :</label>
                                <input type="text" name="daterangepicker" id="daterangepicker" @if(request()->get('daterangepicker')) value="{{ request()->get('daterangepicker')}}" @endif required>
                                <button class="btn btn-sm btn-success filter_range" type="submit"> Go</button>
                            </form>
                        </div>
                    </a>
                </li>

                <span style="position: absolute; right:3%;">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="bi bi-download"></i> &nbsp; Download
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item downloadReports" type="xlsx" href="javascript:void(0)">Excel Format</a></li>
                          <li><a class="dropdown-item downloadReports" type="csv" href="javascript:void(0)">CSV Format</a></li>
                        </ul>
                      </div>
                </span>

            </ul>
            @elseif(request()->segment(3) == 'products')
            <ul class="nav mb-3 filter-reports" id="myTab " role="tablist">
                <span >
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="bi bi-download"></i> &nbsp; Download
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item downloadReports" type="xlsx" href="javascript:void(0)">Excel Format</a></li>
                          <li><a class="dropdown-item downloadReports" type="csv" href="javascript:void(0)">CSV Format</a></li>
                        </ul>
                      </div>
                </span>

            </ul>
            @endif

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active">
                    <div class="mt-4">
                        <table id="datatable" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th> Sl No</th>
                                    @if(request()->segment(3) == 'sales')
                                        <th> Order Id </th>
                                        <th> Date </th>
                                        <th> invoice No </th>
                                        <th> Delivery City </th>
                                        <th> Total Cost </th>
                                        <th> Shipping Cost </th>
                                        <th> Taxable Amount </th>
                                        <th> Order Status </th>
                                    @endif

                                    @if(request()->segment(3) == 'customers')
                                        <th> Profile </th>
                                        <th> Name </th>
                                        <th> Role </th>
                                        <th> Mobile </th>
                                        <th> Mail Id </th>
                                        <th> City </th>
                                        <th> Registered Date </th>
                                    @endif

                                    @if(request()->segment(3) == 'stocks')
                                        <th> Project </th>
                                        <th> Variant </th>
                                        <th> SKU </th>
                                        <th> Price </th>
                                        <th> Action </th>
                                    @endif

                                    @if(request()->segment(3) == 'products')
                                        <th> Project </th>
                                        <th> Price </th>
                                        <th> Discount </th>
                                        <th> Brand </th>
                                        <th> Model </th>
                                        <th> Category </th>
                                        <th> Sub Category </th>
                                    @endif

                                </tr>
                            </thead>
                            <tbody id="append_list12">

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection


@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="{{ asset('backend/assets/libs/datepicker/daterangepicker.js') }}"></script>

<script>
    $(document).ready(function(){
        let main_category ="{{ request()->segment(3) }}";
        let range ="{{ request()->get('range') }}";
        let daterangepicker ="{{ request()->get('daterangepicker') }}";

        load_data();
        function load_data(from_date = "" ){

            $("#datatable").DataTable({
                processing: false,
                serverSide: true,
                bDestroy: false,
                autoWidth: false,
                deferRender: true,
                responsive:true,
                lengthMenu: [100, 200, 300, 500],
                order: [ [0, 'desc'] ],
                ajax :{
                        type: 'GET',
                        data:{'category':main_category , 'range': range, 'reportrange':daterangepicker},
                        url: base_url +"/admin/reports/ajax/fetch",
                        error:function(err){ console.log(err);},
                        complete: function () {
                            $('div.dataTables_filter input').addClass("filterCol");
                        }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'id', orderable: true, searchable: false},
                    @if(request()->segment(3) == 'sales')
                        {data: 'order_id', name: 'order_id', orderable: false, searchable: true},
                        {data: 'created_at', name: 'created_at', orderable: true, searchable: true},
                        {data: 'invoice_no', name: 'invoice_no', orderable: false, searchable: true},
                        {data: 'city', name: 'city', orderable: false, searchable: true},
                        {data: 'subtotal', name: 'subtotal', orderable: false, searchable: true},
                        {data: 'shipping_cost', name: 'shipping_cost', orderable: false, searchable: true},
                        {data: 'tax_amount', name: 'tax_amount', orderable: false, searchable: true},
                        {data: 'status',  name: 'status', orderable: false, searchable: false },
                    @endif

                    @if(request()->segment(3) == 'customers')
                        {data: 'profile', name: 'profile', orderable: false, searchable: false},
                        {data: 'name', name: 'name', orderable: false, searchable: true},
                        {data: 'rolecode', name: 'rolecode', orderable: true, searchable: true},
                        {data: 'mobile', name: 'mobile', orderable: false, searchable: true},
                        {data: 'email', name: 'email', orderable: false, searchable: true},
                        {data: 'city', name: 'city', orderable: false, searchable: true},
                        {data: 'created_at', name: 'created_at', orderable: false, searchable: true},
                    @endif

                    @if(request()->segment(3) == 'stocks')
                        {data: 'name', name: 'name', orderable: false, searchable: true},
                        {data: 'variant', name: 'pvi.name', orderable: true, searchable: true},
                        {data: 'sku', name: 'sku', orderable: true, searchable: true},
                        {data: 'price', name: 'price', orderable: false, searchable: true},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    @endif

                    @if(request()->segment(3) == 'products')
                        {data: 'name', name: 'name', orderable: false, searchable: true},
                        {data: 'price', name: 'price', orderable: true, searchable: true},
                        {data: 'client_discount', name: 'client_discount', orderable: true, searchable: true},
                        {data: 'brand_name', name: 'br.brand_name', orderable: false, searchable: true},
                        {data: 'model_name', name: 'pm.model_name', orderable: false, searchable: true},
                        {data: 'ct_name', name: 'ct.name', orderable: false, searchable: true},
                        {data: 'sct_name', name: 'sct.name', orderable: false, searchable: true},
                    @endif
                ],
                @if(request()->segment(3) == 'sales')
                    'columnDefs': [
                        { "targets": [5,6,7], "className": "text-right"},
                    ],
                @endif
                @if(request()->segment(3) == 'stocks')
                    'columnDefs': [
                            {"width": "10%", "targets": 0},
                            { "targets": [1], "width": "30%",  "className": "text-center"},
                    ],
                @endif
            });

        }

        $('.downloadReports').click(function(e){

            let report_type = $(this).attr('type');

            e.preventDefault();
            $.ajax({
                xhrFields: { responseType: 'blob',},
                type: 'POST',
                url: base_url + '/admin/download/reports',
                data: { category: main_category,range:range, file_format:report_type, reportrange: daterangepicker, 'search': $('.filterCol').val() },
                success: function(result, status, xhr) {
                    console.log(result);
                    var disposition = xhr.getResponseHeader('content-disposition');
                    var matches = /"([^"]*)"/.exec(disposition);
                    var filename = (matches != null && matches[1] ? matches[1] : main_category+'.'+report_type);

                    // The actual download
                    var blob = new Blob([result], {
                        type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                    });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = filename;

                    document.body.appendChild(link);

                    link.click();
                    document.body.removeChild(link);
                },
                error:function(error){
                    console.log(error);
                }
            });
        });


    });
</script>




{{-- Daterangepicker --}}
<script type="text/javascript">
    var start = moment().subtract(29, 'days');
    var end = moment();


    $('input[name="daterangepicker"]').daterangepicker({
        autoUpdateInput: false,
        minDate: '02/16/2012',
        maxDate: end,
        locale: {
            cancelLabel: 'Clear'
        }
    }).on("apply.daterangepicker", function (e, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    });

</script>


@endpush
