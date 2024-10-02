@extends('backend.layouts.app')
@section('content')

<div class="row row-cols-1 row-cols-md-3 g-4">
    <div class="col-lg-12 col-md-12">
        <div class="card widget">

            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card border-0">
                        <div class="card-body text-center">
                            <div class="display-5">
                                <img style="width: 23%" src="{{ asset('backend/assets/images/cow-head.png') }}">
                            </div>
                            <h5 class="my-3">{{ $about->cows_in_goshala }}</h5>
                            <div class="text-muted">Total # of Cows In Gowshala</div>
                        </div>
                    </div>
                </div>




                <div class="col-md-3">
                    <div class="card border-0">
                        <div class="card-body text-center">
                            <div class="display-5">
                                <img style="width: 23%" src="{{ asset('backend/assets/images/cow-head.png') }}">
                            </div>
                            <h5 class="my-3">{{ $about->gauvansh_rescued }}</h5>
                            <div class="text-muted">Total # of Rescued Cows</div>
                            {{-- <div class="progress mt-3" style="height: 5px">
                                <div class="progress-bar bg-secondary" role="progressbar" style="width: {{ getPercent($delivered_today, 50)  }}%"  aria-valuemax="100"></div>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0">
                        <div class="card-body text-center">
                            <div class="display-5">
                                <img style="width: 23%" src="{{ asset('backend/assets/images/cow-head.png') }}">
                            </div>
                            <h5 class="my-3"> {{ $about->gauvansh_medicated }}</h5>
                            <div class="text-muted">Total # of Medicated Cows</div>
                            {{-- <div class="progress mt-3" style="height: 5px">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{  getPercent($cancelled_today, 50) }}%" aria-valuemax="100"></div>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card border-0">
                        <div class="card-body text-center">
                            <div class="display-5">
                                <i class="bi bi-wallet text-success"></i>
                            </div>
                            <h5 class="my-3">₹ {{ number_format($totdonations, 2) }}</h5>
                            <div class="text-muted">Total Donations</div>
                            {{-- <div class="progress mt-3" style="height: 5px">
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ getPercent($shipped_today, 50) }}%" aria-valuemax="100"></div>
                            </div> --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
    <div class="col-lg-12 col-md-12">
        <div class="card widget">
            <div class="card-header">
                <h5 class="card-title">Donations Charts</h5>
            </div>

            <div class="row g-4">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex align-items-center mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="display-9 me-3">
                                        <i class="bi bi-bag-check me-2 text-success"></i> Donation Analytics Last 12 Months
                                    </div>
                                </div>
                            </div>
                            <div id="sales-chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-sm-12">
                    <div class="card">
                        <h5 class="my-2 text-center">Recent Transactions</h5>
                        <div class="pt-0 card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-custom mb-0" id="recent-products">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Receipt No</th>
                                            <th>Amount</th>
                                            <th>Donor Name</th>
                                            <th>Transaction Id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($recentDonation as $item)
                                            <tr>
                                                <td>
                                                    {{ Carbon\Carbon::parse()->format('d M Y') }}
                                                </td>
                                                <td>{{ $item->receipt_no }}</td>
                                                <td>₹{{ number_format($item->amount , 2)  }}</td>
                                                <td>{{ $item->donar_name }}</td>
                                                {{-- <td>{{ $item->donar_phone }}</td> --}}
                                                <td>
                                                    <span class="text-danger"> {{ $item->payment_id }} </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center"> No Transaction Exist</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script src="{{ asset('backend/js/admin.js') }}"></script>
@endsection
