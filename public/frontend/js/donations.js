

var validator;

$(document).ready(function(){

	$('input:radio[name="radio_amount"]').change(function(){
		$('.amount_medicle').val(parseInt($(this).val()));
	});

	$('input:radio[name="radio_amount_1"]').change(function(){
		$('.amount_midday').val(parseInt($(this).val()));
	});


	$('.donar_pay_form').submit(function(event){
		event.preventDefault();
		var thisform = $(this);
		if(validatePaymentForm('donar_pay_form')){
			$.ajax({
				url: "/initilise-payment",
				type: "POST",
				data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend:function(){
                    $('.btn-donate').prop('disabled', true);
                    $('.btn-donate').text('Donation initilisig...');
                },
				success: function (response) {
					console.log(response);

                    if(response.status == true){
                        let data = response.data;
                        var options = {
                            "key":data.key ,  "amount": data.amount, "currency": "INR", "name": "Gaurakshashalas", "description": " ",
                            "image": base_url+"/frontend/images/logo.png"  , "order_id": data.order_id, "notes" : data.notes,
                            "prefill": { "name": data.name,  "email": data.email,  "contact": data.phone },
                            "theme": { "color": "#09351c"},
                            "handler": function (response){
                                console.log(response);
                                $.ajax({
                                    type:'POST',
                                    url :base_url+'/payment-verify',
                                    data:{
                                            razorpay_payment_id:response.razorpay_payment_id,
                                            razorpay_signature:response.razorpay_signature ,
                                            razorpay_order_id:response.razorpay_order_id
                                    },
                                    success:function(razResponcse){
                                        console.log(razResponcse);

                                        if(razResponcse.status == true){
                                            $('.about-content').css("display", "none");
                                            $('.success-box').css("display", "block");
                                            $('#paidAmount').text((data.amount/100).toFixed(2) )
                                            $('#paidName').text(data.name)
                                        }else{
                                            $('.btn-donate').prop('disabled', false);
                                            $('.btn-donate').text('DONATE');

                                            $('.alert-boxt').css("display", "block");
                                            $('.alert-boxt .paymen-failed').text(razResponcse.message);
                                        }
                                    }
                                });
                            },
                            "modal": {
                                escape: true,
                                backdropclose: false,
                                "ondismiss": function(){
                                    console.log('Cncelled');
                                    // Enable donate button and show cancelled popup
                                    $('.btn-donate').prop('disabled', false);
                                    $('.btn-donate').text('DONATE');

                                    $('.alert-box').css("display", "block");
                                    $('.paymen-failed').text("Donation Cancelled");
                                    setTimeout(() => {
                                        $('.alert-box').css("display", "none");
                                    }, 10000);
                                }
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.on('payment.failed', function (response){
                            // Enableed Donate buttton and show payment failed sections
                            $('.btn-donate').prop('disabled', false);
                            $('.btn-donate').text('DONATE');

                            $('.alert-box').css("display", "block");
                            $('.paymen-failed').text("Donation has been failed, Pleaset try again!");
                            setTimeout(() => {
                                $('.alert-box').css("display", "none");
                            }, 10000);
                        });
                        rzp1.open();
                    }

				},
				error: function(response) {
                    console.log(response);
                    $('.btn-donate').prop('disabled', false);
                    $('.btn-donate').text('DONATE');
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
		}
	});


	function executePayment(data){

		var html  = '<form action="https://secure.payu.in/_payment" id="payment_form_submit" method="post">'+
					'<input type="hidden" id="udf5" name="udf5" value="PayUBiz_PHP7_Kit"/>'+
					'<input type="hidden" id="surl" name="surl" value=\"'+data.surl+'\" />'+
					'<input type="hidden" id="furl" name="furl" value=\"'+data.furl+'\" />'+
					'<input type="hidden" id="curl" name="curl" value=\"'+data.surl+'\" />'+
					'<input type="hidden" id="key" name="key" value=\"'+ data.key+'\" />'+
					'<input type="hidden" id="txnid" name="txnid" value=\"'+ data.txnid+'\" />'+
					'<input type="hidden" id="amount" name="amount" value=\"'+ data.amount+'\" />'+
					'<input type="hidden" id="productinfo" name="productinfo" value=\"'+ data.productinfo+'\" />'+
    				'<input type="hidden" id="firstname" name="firstname" value=\"'+ data.firstname+'\" />'+
					'<input type="hidden" id="email" name="email" value=\"'+ data.email+'\" />'+
					'<input type="hidden" id="phone" name="phone" value=\"'+ data.phone+'\" />'+
					'<input type="hidden" id="city" name="city" value=\"'+ data.city+'\" />'+
					'<input type="hidden" id="udf1" name="udf1" value="'+data.pan+'"/>'+
					'<input type="hidden" id="udf2" name="udf2" value="'+data.dob+'"/>'+
					'<input type="hidden" id="udf3" name="udf3" value="'+data.category+'"/>'+
					'<input type="hidden" id="hash" name="hash" value="'+data.hash+'" />'+
					'</form>';

    	var form = jQuery(html);
		jQuery('body').append(form);
		console.log(html);
		form.submit();
	}


	function validatePaymentForm(form_dt){
		validator = $('.'+ form_dt).validate({
        rules: {
        	amount:{ required:true, number: true, min:1 },
        	full_name: { required: true, lettersonly:true, minlength:3},
            dob: { date:true,},
            email: {required:true,email:true,},
            phone: {required: true,number:true, mobileIN:true,},
            city: {lettersonly:true, minlength:3},
            pan: {panind:true},
            category: {required:true},
        },
        messages: {
            amount:{ required:"Required field", },
        	full_name: { required: "Required field",},
            dob: {required: "Required field",},
            phone: {required: "Required field"},
            category: {required: "Required field"},
            email: {required: "Required field"},
        },
	    errorPlacement: function(error, element) {
	    	error.insertAfter($(element).parent('div'));
	    },
	    highlight: function ( element) {
		    $( element ).removeClass( "error" );
		 }
    });

    if (validator.form())
        return true;
    else
        return false;
	}
});
