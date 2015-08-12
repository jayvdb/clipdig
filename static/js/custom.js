$(window).load(function() {
	console.log( "window loaded" );
	$('.loading').fadeOut("slow");
});


$(document).ready(function(){
	$('a[data-toggle=tab]').click(function() {
		var lokasi=$(this).attr('href').replace('#','');
		localStorage.setItem('tab_category',lokasi);
	});
	
	var ambil_lokasi=localStorage.getItem('tab_category');
	$('div#'+ambil_lokasi).addClass('in active');
	$('a[href=#'+ambil_lokasi+']').parent().addClass('active');
	
	
	
	
	var 	locations = $(location).attr('href');
			split1 = locations.split("?");
			split2 = split1[1].split("&category");
			base = split2[0];
	localStorage.setItem('last_location',locations);
	
	
	$('div.category select').change(function() {
		
		count_class = $('div.category select').length;
		category = "&category=";
		for (i=0;i<count_class;i++){
			a = $('div.category select:eq('+i+')');
			category += ";"+a.attr("name") +":"+ a.val()  ;
		}
		
		url = "?"+ base + category;
		window.location.replace(url);
		
	});
	
	$('input[name=tgl1]').change(function() {
		//alert($(this).val());
		val = $(this).val();
		$('input[name=tgl2]').parent().attr('data-date-start-date',val);
	});
	
	
});
