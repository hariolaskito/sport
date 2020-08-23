$(function() {
	var date_start, date_finish;
    $('#formtrans').parsley();
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
        if ($('#source_city').val() == "") {
            complete = false;
            alert("Silahkan pilih Asal Kota");
        }
        if ($('#target_city').val() == "") {
            complete = false;
            alert("Silahkan pilih Tujuan Kota");
        }
        if ($('#date_start').val() == "") {
            complete = false;
            alert("Silahkan pilih tanggal keberangkatan");
        }
        if (complete) {
            $('.dispackage').show();
            $('#source_city').attr("disabled", "disabled");
            $('#target_city').attr("disabled", "disabled");
            $('#quantity').attr("disabled", "disabled");
            $('#date_start').attr("disabled", "disabled");
            $(this).hide();
            $('#btnreset').show();
            generatepack();
            return false;
        }
    });
    $('#btnreset').on('click', function() {
        $(this).hide();
        $('#btngenerate').show();
        $('.dispackage').hide();
        $('.discustomer').hide();
        $('.disaction').hide();
        $('#source_city').removeAttr("disabled");
        $('#target_city').removeAttr("disabled");
        $('#quantity').removeAttr("disabled");
        $('#date_start').removeAttr("disabled");
        $('#time_start').removeAttr("disabled");
        return false;
    });

    $('#table-pack').on('click','.btn-order', function(){
        $(this).attr('disabled','disabled');
        $(this).closest('tr').addClass('warning');
        $('.discustomer').show();
        $('.dispasenger').empty();
        $('.disaction').show();
        for (var i = 1; i <= $('#quantity').val(); i++) {
            $('.dispasenger').append(
                    "<div class='row panel panel-default'>"+
                        "<div class='panel-heading'>"+
                          "<h3 class='panel-title'>Penumpang "+i+"</h3>"+
                        "</div>"+
                        "<div class='panel-body'>"+
                          "<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>"+
                            "<div class='form-group'>"+
                              "<label for='input-id' class='control-label col-md-2'>Nama Penumpang</label>"+
                              "<div class='col-md-4'>"+
                                "<input class='form-control name-pasenger' name='name-pasenger[]' required/>"+
                              "</div>"+
                            "</div>"+
                            "<div class='form-group'>"+
                              "<label for='input-id' class='control-label col-md-2'>ID Card</label>"+
                              "<div class='col-md-3'>"+
                                "<input class='form-control id-card-pasenger' name='id-card-pasenger[]' required/>"+
                              "</div>"+
                            "</div>"+
                          "</div>"+
                        "</div>"+
                      "</div>"+
                    "</div>");    
        }
        generatetotal();
        generateinfo();
    });

function generatetotal() {
    var elmrow = $('#table-pack').find('tr.warning');
    var price = elmrow.find('.in-price').val();
    var quantity = $('#quantity').val();
    var discount = $('#discount').val();
	$('#total').val((price*quantity)-discount);
}

function generateinfo(){
    var elmrow = $('#table-pack').find('tr.warning');
    var source = $('#source_city').find('option:selected').text();
    var target = $('#target_city').find('option:selected').text();
    var price = elmrow.find('.in-price').val();
    var quantity = $('#quantity').val();
    var armada = elmrow.find('td').eq('3').text();
    var date_start = new moment(elmrow.find(".in-date-start").val());
    var date_finish = new moment(elmrow.find('.in-date-finish').val());

    $('#price_id').val(elmrow.find('.in-id').val());
    $('#price').val(price);
    $('#txdet-source').html(source);
    $('#txdet-target').html(target);
    $('#txdet-armada').html(armada);
    $('#txdet-quantity').html(quantity+" Penumpang");
    $('#txdet-price').html("Rp "+price);
    $('#txdet-start').html(date_start.format('D MMMM YYYY')+"<br>"+date_start.format('HH:mm'));
    $('#txdet-finish').html(date_finish.format('D MMMM YYYY')+"<br>"+date_finish.format('HH:mm'));
}

function generatepack() {
    var startinput = $('#date_start').val();
    var arrstartinput = startinput.split("-");
    start_date = new moment(arrstartinput[2]+"-"+arrstartinput[1]+"-"+arrstartinput[0]+" 00:00:00");
    $.ajax({
        method : "GET",
        url : Router.route('schedule.available', {
            source_city : $('#source_city').val(),
            target_city : $('#target_city').val(),
            date : start_date.format("YYYY-MM-DD"),
            quantity : $('#quantity').val()
        }),
        dataType : 'json',
        success : function (response, textStatus, jqXHR){
            $('#table-pack').find('tbody').empty();
            if(response.length>0){
                for (var i = 0; i < response.length; i++) {
                    var date_start = new moment(response[i].date_start);
                    var date_finish = new moment(response[i].date_finish);
                    var duration = moment.duration(date_finish.diff(date_start));
                    var txduration;
                    if(duration.hours()>=1){
                        txduration = duration.hours()+" jam";
                    }else{
                        txduration = duration.minutes()+" menit";
                    }
                    var content = "<tr>"+
                                    "<input type='hidden' class='in-id' value='"+response[i].id+"'/>"+
                                    "<td class='text-center'><input type='hidden' class='in-date-start' value ='"+response[i].date_start+"'>"+date_start.format("HH:mm")+"</td>"+
                                    "<td class='text-center'><input type='hidden' class='in-date-finish' value ='"+response[i].date_finish+"'>"+date_finish.format("HH:mm")+"</td>"+
                                    "<td class='text-center'>"+txduration+"</td>"+
                                    "<td class='text-center'>"+response[i].name_vehicle+"</td>"+
                                    "<td class='text-center'><input type='hidden' class='in-price' value ='"+response[i].price+"'>"+response[i].price+"</td>"+
                                    "<td class='text-center'><b>"+response[i].sisa_quota+" Tersedia</b></td>"+
                                    "<td class='text-center'><a class='btn btn-lg btn-primary btn-order'>Pesan</a></td>"+
                                  "</tr>";
                      $('#table-pack').find('tbody').append(content);              
                }
            }else{
                $('#table-pack').find('tbody').append("<tr><td colspan='7' class='text-center'>Jadwal Tidak Ditemukan</td></tr>");
            }
        }
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

function getCity(id, trgelement){
    $.ajax({
        type : "GET",
        url : "/webtravel/city/show/"+id,
        dataType : 'JSON',
        success : function (response, textStatus, jqXHR){
          trgelement.empty();
          trgelement.append("<option value=''>Pilih Kota...</option>")
          for(var i = 0; i < response.length; i++){
            trgelement.append("<option value='"+response[i].id+"'>"+response[i].name+"</option>");
          }
        }
      });
  }
function submitData(){
    var price_id = $('input[name=price_id]').val();
    var discount = $('input[name=discount]').val();
    var quantity = $('input[name=quantity]').val();
    var name = $('input[name=name]').val();
    var address = $('textarea[name=address]').val();
    var phone = $('input[name=phone]').val();
    var note = $('textarea[name=note]').val();
    var id_card = $('input[name=id_card]').val();
    var arrpasname = [];
    var arrpasidcard = [];
    $('.dispasenger').find('.row').each(function(){
        arrpasname.push($(this).find('.name-pasenger').val());
        arrpasidcard.push($(this).find('.id-card-pasenger').val());
    });
    var data  = {
        _token : $('input[name=_token]').val(),
        price_id : price_id,
        discount : discount,
        quantity : quantity,
        name : name,
        address : address,
        phone : phone,
        id_card : id_card,
        note : note,
        arrpasname : arrpasname,
        arrpasidcard : arrpasidcard
    };
    console.log(data);
    if(confirm("Apakah anda yakin akan menyimpan transksi ini?")){
        $.ajax({
            method : "POST",
            url : Router.route('trans_travel.store'),
            data : data,
            dataType : 'json',
            success : function (response, textStatus, jqXHR){
                if(response.status == 1){
                    alert(response.message);
                    window.location.href = Router.route('trans_travel.create');
                }else{
                    alert(response.message);
                }
            }
        });
    }
}  

});

