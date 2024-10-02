@extends('backend.layouts.app')
@section('content')
    <div class="mb-4">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin') }}">
                        <i class="bi bi-globe2 small me-2"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Communities</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="d-md-flex gap-4 align-items-center">
            </div>

            <div id="customerlist-table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="customerlist-table_length"><label>Show <select
                                    name="customerlist-table_length" aria-controls="customerlist-table"
                                    class="custom-select custom-select-sm form-control form-control-sm">
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    <option value="500">500</option>
                                </select> entries</label></div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div id="customerlist-table_filter" class="dataTables_filter"><label>Search:<input type="search"
                                    class="form-control form-control-sm" placeholder=""
                                    aria-controls="customerlist-table"></label></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table dataTable no-footer" id="customerlist-table" role="grid"
                            aria-describedby="customerlist-table_info" style="width: 1147px;">
                            <thead>
                                <tr role="row">
                                    <th title="SL No" class="sorting_asc" rowspan="1" colspan="1" aria-label="SL No"
                                        style="width: 68px;">SL No</th>
                                    <th title="Name" class="sorting" tabindex="0" aria-controls="customerlist-table"
                                        rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending"
                                        style="width: 161px;">Community Name</th>
                                    <th title="Email" class="sorting" tabindex="0" aria-controls="customerlist-table"
                                        rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending"
                                        style="width: 286px;">Email</th>
                                    <th title="contact" class="sorting" tabindex="0" aria-controls="customerlist-table"
                                        rowspan="1" colspan="1"
                                        aria-label="contact: activate to sort column ascending" style="width: 105px;">
                                        contact</th>
                                    <th title="City" class="sorting" tabindex="0" aria-controls="customerlist-table"
                                        rowspan="1" colspan="1" aria-label="City: activate to sort column ascending"
                                        style="width: 57px;">Organisation Name</th>
                                    <th title="Register Date" class="sorting" tabindex="0"
                                        aria-controls="customerlist-table" rowspan="1" colspan="1"
                                        aria-label="Register Date: activate to sort column ascending" style="width: 152px;">
                                        Register Date</th>
                                    <th title="Action" width="50" class="text-center sorting" tabindex="0"
                                        aria-controls="customerlist-table" rowspan="1" colspan="1"
                                        aria-label="Action: activate to sort column ascending" style="width: 52px;">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="351" role="row" class="odd">
                                    <td class="sorting_1">1</td>
                                    <td>Sushil yadav</td>
                                    <td>sushil.gajraj.yadav@gmail.com</td>
                                    <td>9152919200</td>
                                    <td></td>
                                    <td>15 May 2024</td>
                                    <td class=" text-center">
                                        <div class="d-flex jc">
                                            <div class="dropdown">
                                                <a href="#" data-bs-toggle="dropdown" class="btn btn-floating"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="bi bi-three-dots"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="http://127.0.0.1:8000/admin/customer/351"
                                                        class="dropdown-item"> Show</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="350" role="row" class="even">
                                    <td class="sorting_1">2</td>
                                    <td>Tamal Chowdhury</td>
                                    <td>wings.stretched@gmail.com</td>
                                    <td>7001533669</td>
                                    <td></td>
                                    <td>15 May 2024</td>
                                    <td class=" text-center">
                                        <div class="d-flex jc">
                                            <div class="dropdown">
                                                <a href="#" data-bs-toggle="dropdown" class="btn btn-floating"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="bi bi-three-dots"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="http://127.0.0.1:8000/admin/customer/350"
                                                        class="dropdown-item"> Show</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="349" role="row" class="odd">
                                    <td class="sorting_1">3</td>
                                    <td>Arindam Biswas</td>
                                    <td>arindamab95@gmail.com</td>
                                    <td>7908748345</td>
                                    <td></td>
                                    <td>15 May 2024</td>
                                    <td class=" text-center">
                                        <div class="d-flex jc">
                                            <div class="dropdown">
                                                <a href="#" data-bs-toggle="dropdown" class="btn btn-floating"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="bi bi-three-dots"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="http://127.0.0.1:8000/admin/customer/349"
                                                        class="dropdown-item"> Show</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="348" role="row" class="even">
                                    <td class="sorting_1">4</td>
                                    <td>Anirban Laha</td>
                                    <td>lahaanirban37@gmail.com</td>
                                    <td>6297788219</td>
                                    <td></td>
                                    <td>15 May 2024</td>
                                    <td class=" text-center">
                                        <div class="d-flex jc">
                                            <div class="dropdown">
                                                <a href="#" data-bs-toggle="dropdown" class="btn btn-floating"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="bi bi-three-dots"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="http://127.0.0.1:8000/admin/customer/348"
                                                        class="dropdown-item"> Show</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr id="347" role="row" class="odd">
                                    <td class="sorting_1">5</td>
                                    <td>arvind kapoor</td>
                                    <td>arvkapoor@gmail.com</td>
                                    <td>9886070376</td>
                                    <td></td>
                                    <td>15 May 2024</td>
                                    <td class=" text-center">
                                        <div class="d-flex jc">
                                            <div class="dropdown">
                                                <a href="#" data-bs-toggle="dropdown" class="btn btn-floating"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i class="bi bi-three-dots"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="http://127.0.0.1:8000/admin/customer/347"
                                                        class="dropdown-item"> Show</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div id="customerlist-table_processing" class="dataTables_processing card"
                            style="display: none;">Processing...</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="customerlist-table_info" role="status" aria-live="polite">
                            Showing 1 to 5 of 5 entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="customerlist-table_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="customerlist-table_previous">
                                    <a href="#" aria-controls="customerlist-table" data-dt-idx="0" tabindex="0"
                                        class="page-link">Previous</a></li>
                                <li class="paginate_button page-item active"><a href="#"
                                        aria-controls="customerlist-table" data-dt-idx="1" tabindex="0"
                                        class="page-link">1</a></li>
                                <li class="paginate_button page-item next disabled" id="customerlist-table_next"><a
                                        href="#" aria-controls="customerlist-table" data-dt-idx="2" tabindex="0"
                                        class="page-link">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@push('scripts')
    {{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} --}}
@endpush
