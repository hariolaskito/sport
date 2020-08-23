$(function(){

	$('#btngenerate').on('click', function(){
		$('.seatCharts-row').remove();
		$('.seatCharts-legendItem').remove();
		$('#seat-map,#seat-map *').unbind().removeData();
		var column = $('#incolumn').val();
		var row = $('#inrow').val();
		var arrmap = Array();
		for(var i = 0 ; i < row; i ++){
			var str = "";
			for(var j = 0; j < column; j++){
				str = str + "a";
			}
			arrmap.push(str);
		}
		var firstSeatLabel = 1;
		var sc = $('#seat-map').seatCharts({
	        map: arrmap,
	        seats: {
	            a: {
	                price   : 99.99,
	                classes : 'front-seat' //your custom CSS class
	            }

	        },
	        naming : {
				top : false,
				getLabel : function (character, row, column) {
					return firstSeatLabel++;
				},
			},
	        click: function () {
	            if (this.status() == 'available') {
	                //do some stuff, i.e. add to the cart
	                return 'selected';
	            } else if (this.status() == 'selected') {
	                //seat has been vacated
	                return 'available';
	            } else if (this.status() == 'unavailable') {
	                //seat has been already booked
	                return 'unavailable';
	            } else {
	                return this.style();
	            }
	        }
	    });
	});

	$('#formvehicle').on('submit', function(){
		if ($('#formvehicle').parsley().isValid()) {
			var name = $('input[name=name]').val();
			var brand = $('input[name=brand]').val();
			var year = $('input[name=year]').val();
			var noplate = $('input[name=noplate]').val();
			var isactive = $('input[name=isactive]').val();
			var description = $('textarea[name="description"]').val();
			var arrid = []; arrstat = [];
			$('#seat-map').find('.seatCharts-seat').each(function(){
				arrid.push($(this).attr('id'));
				arrstat.push($(this).attr('aria-checked'));
			});
			var data  = {
				_token : $('input[name=_token]').val(),
				name : name,
				brand : brand,
				year : year,
				noplate : noplate,
				isactive : isactive,
				description : description,
				arrid : arrid,
				arrstat : arrstat
			};
			console.log(data);
			$.ajax({
				method : "POST",
				url : $('input[name=url]').val(),
				data : data,
				dataType : 'json',
				success : function (response, textStatus, jqXHR){
					if(response.status == 1){
						window.location.href = $('#btncancel').attr('href');
					}else{
						alert(response.message);
					}
				}
			});
		}
		return false;
	});
});