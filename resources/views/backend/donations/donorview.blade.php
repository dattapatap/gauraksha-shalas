@extends('backend.layouts.app')
@section('styles')
    <style>
        .add_new button {
            border: none;
            outline: none;
            background-color: #058A69;
            color: #ffffff;
            border-radius: 9px;
            font-family: Lato;
            font-size: 12px;
            padding: 5px 10px;
            /* font-weight: bold; */
            box-shadow: 0px 3px 6px #0000005C;
            width: 140px;
            height: 28px;
        }

        .add_new {
            display: flex;
        }

        .add_customer_div {
            width: 54%;
        }

        .projectTitle_name {
            width: 22% !important;
        }

        @media(min-width:1480px) {
            .add_customer_div {
                width: 63%;
            }

            .projectTitle_name {
                width: 19% !important;
            }
        }

        @media(min-width:1920px) {
            .add_customer_div {
                width: 72%;
            }

            .entries_container {
                width: 87% !important;
            }

            .projectTitle_name {
                width: 16% !important;
            }
        }

        .contents {
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 40px;
            padding: 10px;
        }

        .contents .txt {
            font-size: 14px;
            font-weight: 500;
        }

        .values {
            font-size: 14px;
            font-weight: 600;
        }
    </style>
@endsection

@section('content')


<body>


    <div class="mb-4 d-flex">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin/donations') }}">
                        <i class="bi bi-globe2 small me-2"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Donation List</li>
            </ol>
        </nav>
    </div>



    <div class="card">
        <div class="card-body">

            <div class="table_container container-fluid">
                <div class="table_control_container" style="margin: 5px 0px 4px 2px;">
                    <div class="new add_new">
                        <div class="add_customer_div">
                            <a href="{{ url('admin/donations') }}" type="button" class="btn btn-danger btn-sm">
                                Back
                            </a>
                        </div>
                    </div>
                </div>

                <div class="customer_table">
                    <div class="col-md-12 contents">
                        <div class="col-md-3 txt"> Receipt No</div>
                        <div class="values"> {{ $donor->receipt_no }}</div>
                    </div>
                    <div class="col-md-12 contents">
                        <div class="col-md-3 txt">Donor Name</div>
                        <div class="values"> {{ $donor->donar_name }}</div>
                    </div>
                    <div class="col-md-12 contents">
                        <div class="col-md-3 txt">Donor Phone</div>
                        <div class="values"> {{ $donor->donar_phone }} </div>
                    </div>
                    <div class="col-md-12 contents">
                        <div class="col-md-3 txt">Donor Email</div>
                        <div class="values"> {{ $donor->donar_email }}</div>
                    </div>
                    <div class="col-md-12 contents">
                        <div class="col-md-3 txt"> Payment Id</div>
                        <div class="values"> {{ $donor->payment_id }}</div>
                    </div>
                    <div class="col-md-12 contents">
                        <div class="col-md-3 txt"> Amount </div>
                        <div class="values"> {{ number_format($donor->amount, 2) }}</div>
                    </div>
                    <div class="col-md-12 contents">
                        <div class="col-md-3 txt">Payment Method</div>
                        <div class="values"> {{ $donor->method }}</div>
                    </div>
                    <div class="col-md-12 contents">
                        <div class="col-md-3 txt">Donor PAN</div>
                        <div class="values"> {{ $donor->donar_pan }}</div>
                    </div>
                    <div class="col-md-12 contents">
                        <div class="col-md-3 txt">Donor Date Of Birth</div>
                        <div class="values">
                            @if (isset($donor->donar_dob))
                                {{ \Carbon\Carbon::parse($donor->donar_dob)->format('d/m/Y') }}
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 contents">
                        <div class="col-md-3 txt">Donor City</div>
                        <div class="values"> {{ $donor->donar_city }}</div>
                    </div>

                    <div class="col-md-12 contents">
                        <div class="col-md-3 txt">Donate Category</div>
                        <div class="values"> {{ $donor->category }}</div>
                    </div>
                    <br>
                </div>
            </div>
        </div>

    </div>

@endsection
