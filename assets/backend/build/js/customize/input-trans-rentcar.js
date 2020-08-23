$(function() {
	var start_date, finish_date;
    $('#formtrans').parsley();
    $('#table-pack').DataTable();
    $('#discount').on('change', function() {
        generatetotal();
    })
    $('#date_start').datepicker({
        format: 'dd-mm-yyyy',
        defaultDate: new Date(),
        "autoclose": true
    });
    $('#formtrans').on('click', 'input[name=pack_id]', function() {
    	$('#discustomer').show();
    	$('.disaction').show();
        generatetotal();
    });
    $('#btngenerate').on('click', function() {
        var complete = true;
        if ($('#type').val() == "") {
            complete = false;
            alert("You must choose packet type");
        }
        if ($('#date_start').val() == "") {
            complete = false;
            alert("You ,ust choose date start first");
        }
        if (complete) {
            $('.dispackage').show();
            $('#type').attr("disabled", "disabled");
            $('#quantity').attr("disabled", "disabled");
            $('#date_start').attr("disabled", "disabled");
            $('#time_start').attr("disabled", "disabled");
            $(this).hide();
            $('#btnreset').show();
            generatepack();
        }
    });
    $('#btnreset').on('click', function() {
        $(this).hide();
        $('#btngenerate').show();
        $('.dispackage').hide();
        $('#discustomer').hide();
        $('.disaction').hide();
        $('#type').removeAttr("disabled");
        $('#quantity').removeAttr("disabled");
        $('#date_start').removeAttr("disabled");
        $('#time_start').removeAttr("disabled");
    });

function generatetotal() {
	$('#total').val("0");
	$('#discount').val("0");
    var type = $('#type').val();
    if (type != 0) {
        if ($('#formtrans input[name=pack_id]:checked').length) {
            var price = 0;
            if (type == '12') {
                price = $('#formtrans input[name=pack_id]:checked').closest("tr").find("td").eq(5).text().trim();
                price = parseFloat(price);
            } else {
                price = $('#formtrans input[name=pack_id]:checked').closest("tr").find("td").eq(6).text().trim();
                price = parseFloat(price);
            }
            console.log(price);
            var discount = parseFloat($('#discount').val());
            var quantity = parseInt($('#quantity').val());
            var total = (quantity * price) - discount;
            $('#total').val(total);
        } else {
            $('#total').val(0);
        }
    } else {
        $('#total').val(0);
    }
}

function generatepack() {
    var type = $('#type').val();
    var startinput = $('#date_start').val();
    var quantity = $('#quantity').val();
    var arrstartinput = startinput.split("-");
    var hours = type * quantity;
    start_date = new moment(arrstartinput[2]+"-"+arrstartinput[1]+"-"+arrstartinput[0]+" "+$("#time_start").val());
    $('#txdate-start').html(start_date.format("DD MMMM YYYY"));
    $('#txtime-start').html(start_date.format("HH:mm"));
    finish_date = new moment(arrstartinput[2]+"-"+arrstartinput[1]+"-"+arrstartinput[0]+" "+$("#time_start").val());
    finish_date = finish_date.add(hours, 'hours');
    $('#txdate-finish').html(finish_date.format("DD MMMM YYYY"));
    $('#txtime-finish').html(finish_date.format("HH:mm"));
    $('#table-pack').DataTable().destroy();
    $('#table-pack').DataTable({
        processing: true,
        serverSide: true,
        ajax: Router.route('pack_rentcar.activepack',{
         startdate : start_date.format("YYYY-MM-DD HH:mm:")+"01",
         enddate : finish_date.format("YYYY-MM-DD HH:mm:ss")
        }),
        columns: [{
            data: 'id',
            name: 'action',
            orderable: false,
            searchable: false,
            className: 'text-center'
        }, {
            data: 'name',
            name: 'name'
        }, {
            data: 'brand',
            name: 'brand',
            className: 'text-center'
        }, {
            data: 'year',
            name: 'year',
            className: 'text-center'
        }, {
            data: 'noplate',
            name: 'noplate',
            className: 'text-center'
        }, {
            data: 'price_12',
            name: 'price_12',
            className: 'text-center'
        }, {
            data: 'price_24',
            name: 'price_24',
            className: 'text-center'
        }]
    });

    $('#formtrans').on('submit', function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
		if ($('#formtrans').parsley().isValid()) {
			submitData();
		}
        $("#formtrans").unbind('submit');
		return false;
	});
}  

function submitData(){
	var pack_id = $('input[name=pack_id]:checked').val();
	var discount = $('input[name=discount]').val();
	var quantity = $('input[name=quantity]').val();
	var type = $('#type').val();
	var startinput = start_date.format("YYYY-MM-DD HH:mm:")+"01";
	var finishinput = finish_date.format("YYYY-MM-DD HH:mm:ss");
	var name = $('#name').val();
	var idcard = $('#idcard').val();
	var address = $('#address').val();
	var phone = $('#phone').val();
	var memo = $('#memo').val();
	var data  = {
		_token : $('input[name=_token]').val(),
		pack_id : pack_id,
		discount : discount,
		quantity : quantity,
		type : type,
		date_start : startinput,
		date_finish : finishinput,
		name : name,
		idcard : idcard,
		address : address,
		phone : phone,
		memo : memo
	};
	console.log(data);
	$.ajax({
		method : "POST",
		url : Router.route('trans_rentcar.store'),
		data : data,
		dataType : 'json',
		success : function (response, textStatus, jqXHR){
			if(response.status == 1){
				alert(response.message);
				window.location.href = $('#btncancel').attr('href');
			}else{
				alert(response.message);
			}
		}
	});
}

});

