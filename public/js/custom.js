$('select[name=type]').change(function (){

	var wallet_type = $('select[name=type]').val();

	if(wallet_type == "Fiat"){
		$('#wallet_address').css('display', 'none');
		$('#balance').css('display', 'block');
	}
	else
	{
		$('#wallet_address').css('display', 'block');
		$('#balance').css('display', 'none');	
	}
});