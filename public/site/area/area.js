function showLocation(province , city , town) {
	
	var loc	= new Location();
	var title	= ['省份' , '地级市' , '市、县、区'];
	$.each(title , function(k , v) {
		title[k]	= '<option value="" key="0">'+v+'</option>';
	})
	
	$('#loc_province').append(title[0]);
	$('#loc_city').append(title[1]);
	$('#loc_town').append(title[2]);
	
	
	$('#loc_province').change(function() {
		$('#loc_city').empty().append(title[1])
		loc.fillOption('loc_city', '0,' + $(this).find("option:selected").attr("key"));
		$('#loc_city').attr("value", "");
		$('#loc_town').empty().append(title[2]).attr("value", "");
		$('#loc_provinceCode').val($(this).find("option:selected").attr("key"));
	})
	
	$('#loc_city').change(function() {
		$('#loc_town').empty().append(title[2]);
		loc.fillOption('loc_town', '0,' + $('#loc_province').find("option:selected").attr("key") + ',' + $('#loc_city').find("option:selected").attr("key"));
		$('#loc_town').attr("value", "");
		$('#loc_cityCode').val($(this).find("option:selected").attr("key"));
	})
	
	$('#loc_town').change(function() {
	    $('#loc_townCode').val($(this).find("option:selected").attr("key"));
	})
	
	if (province) {
		loc.fillOption('loc_province' , '0' , province);
		if (city) {
			loc.fillOption('loc_city' , '0,'+province , city);
			if (town) {
				loc.fillOption('loc_town' , '0,'+province+','+city , town);
			}
		}
		
	} else {
		loc.fillOption('loc_province' , '0');
	}
		
}