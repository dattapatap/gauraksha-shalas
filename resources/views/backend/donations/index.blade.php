@extends('backend.layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .form-control:disabled, .form-control[readonly], .swal2-modal .swal2-input:disabled, .swal2-modal .swal2-input[readonly] {
            background-color: #333434 !important;
            opacity: 1;
        }
        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875em;
            color: #ea4444;
        }

        .table td{
            font-size: 13px;
            text-align: center;
        }
        .add_new {
            display: flex;
            justify-content: right;
        }
    </style>
@endsection


@section('content')

    <div class="mb-4 d-flex">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin/home') }}">
                        <i class="bi bi-globe2 small me-2"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Donation List</li>
            </ol>
        </nav>
    </div>


    <div class="row">
        <div class="col-md-12 mb-2 add_new text-right">
            <div class="customer_action" style="display: flex;gap: 5px;">
                <button type="button" class="btn btn-primary btn-sm send_mail"><img class="emails">&nbsp;Send &nbsp;Email</button>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Modify Donor Form --}}
    <div class="modal fade" id="editDonation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document" >
            <div class="modal-content" style="border: 1px solid #65b38b;">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Donor</h4>
                </div>
                <div class="modal-body p-3">
                    <div class="row">
                        <form id="editDonor">
                            <input type="hidden" id="editdonor_id" name="editdonor_id" value="">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type='text' id="editname" name="editname" class="form-control"
                                            placeholder="Donor Name">
                                        <span class="invalid-feedback" id="editname-input-error"role="alert"><strong></strong></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input type='email' id="editemail" name="editemail" class="form-control"
                                            placeholder="Donor Email">
                                        <span class="invalid-feedback" id="editemail-input-error"
                                            role="alert"><strong></strong></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile No. <span class="text-danger">*</span></label>
                                        <input type='text' id="editmobile" name="editmobile" class="form-control"
                                            placeholder="Donor Mobile">
                                        <span class="invalid-feedback" id="editmobile-input-error"
                                            role="alert"><strong></strong></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pan Number</label>
                                        <input type='text' id="editpan" name="editpan" class="form-control"
                                            placeholder="Donor PAN Number">
                                        <span class="invalid-feedback" id="editpan-input-error"
                                            role="alert"><strong></strong></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>DOB</label>
                                        <input type='date' id="editdate" name="editdate" class="form-control"
                                            placeholder="DD/MM/YYYY"
                                            max="<?= date('Y-m-d', strtotime('-10 year')) ?>">
                                        <span class="invalid-feedback" id="editdate-input-error"
                                            role="alert"><strong></strong></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type='text' id="editcity" name="editcity" class="form-control"
                                            placeholder="City">
                                        <span class="invalid-feedback" id="editcity-input-error"
                                            role="alert"><strong></strong></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Amount <spa class="text-danger">*</spa></label>
                                        <input type='number' id="editamount" name="editamount" class="form-control disabled"
                                            placeholder="amount" readonly>

                                        <span class="invalid-feedback" id="editamount-input-error"
                                            role="alert"><strong></strong></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Transaction Id <span class="text-danger">*</span></label>
                                        <input type='text' id="edittransaction" name="edittransaction" class="form-control disabled"
                                            placeholder="Transaction Id" readonly>
                                        <span class="invalid-feedback" id="edittransaction-input-error"
                                            role="alert"><strong></strong></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" style="text-align: right"> UPDATE </button>
                                <a href="javascript:void(0)" type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</a>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush



@section('scripts')
<script>
    $(document).ready(function(e){

        document.getElementById('select-all').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('.select-row');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });

        /*******************************************Get Edit details of report********************************************/
        $(document).on('click', '.btn-edit-donor', function() {
            var id = $(this).attr('donor_id');
            $('#editDonor')[0].reset();
            $.ajax({
                url:"{{ route('admin.donation.edit')}}",
                type: "POST",
                data : { "donor_id" : id},
                success: function(response) {
                    console.log(response);

                    var data = response.donor;
                    let did = data.id;
                    var name = data.donar_name;
                    var repo_date = data.donar_dob;
                    var phone = data.donar_phone;
                    var email = data.donar_email;
                    var pan = data.donar_pan;
                    var city = data.donar_city;
                    var transaction = data.payment_id;
                    var amount = data.amount;

                    let date = formateDate(repo_date);
                    console.log(date);

                    $('#editname').val(name);
                    $('#editdate').val(date);
                    $('#editemail').val(email);
                    $('#editmobile').val(phone);
                    $('#editpan').val(pan);
                    $('#editcity').val(city);
                    $('#editdonor_id').val(did);
                    $('#edittransaction').val(transaction);
                    $('#editamount').val(amount);

                    $('#editDonation').modal('show');
                },

                error: function(result) {
                    console.log(result);

                    var e = JSON.parse(result.responseText);
                    toastr.error(e.error, "Error", {
                        "timeOut": "1500",
                        "extendedTImeout": "0"
                    });
                }
            });
        });

        $('#editDonor').submit(function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $(".invalid-feedback").children("strong").text("");
            $("#editAddDonor input").removeClass("is-invalid");

            $.ajax({
                url: "{{ route('admin.donation.update')}}",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(response) {
                    console.log(response);
                    if (response.status) {
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error(response.message, "Error", {
                            "timeOut": "1500",
                            "extendedTImeout": "0"
                        });
                    }
                },
                error: function(response) {
                    console.log(response);
                    if (response.responseJSON.status === 400) {
                        let errors = response.responseJSON.errors;
                        Object.keys(errors).forEach(function(key) {
                            $("#" + key + "Input").addClass("is-invalid");
                            $("#" + key + "-input-error").children("strong").text(errors[key][
                                0
                            ]);
                        });
                    }
                },
            });
        });

        $(document).on('click', '.send_mail', function() {
            var id = [];
            $.each($("input[name='tick']:checked"), function() {
                id.push($(this).val());
            });
            if (id.length != '0') {
                if(id.length <= 10){
                    $.ajax({
                        url: "{{ route('admin.donation.sendMail') }}",
                        type: "post",
                        data: { id: id },
                        beforeSend:function(){
                            $('.send_mail').prop('disabled', true);
                            $('.send_mail').text('sending mail');
                        },
                        success: function(response) {
                            console.log(response)
                            $('.send_mail').prop('disabled', false);
                            $('.send_mail').text('Send Mail Please Wait!');
                            toastr.success('Mail updated, check status of mail deliver');
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        },
                        error: function(error){
                            console.log(error);
                            $('.send_mail').prop('disabled', false);
                            $('.send_mail').text('Send Mail');
                        }
                    });
                }else{
                    alert('You can select maximum 10 donors');
                }

            } else {
                alert("Please select at least one record");
            }
        });

    })

    function formateDate(date) {
        let dt = new Date(date);
        var dd = dt.getDate();
        var mm = dt.getMonth() + 1;
        var yyyy = dt.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
        let today = yyyy + '-' + mm + '-' + dd;
        return today;
    }

</script>
@endsection
