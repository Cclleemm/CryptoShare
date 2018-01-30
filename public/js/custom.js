// View Recipient, automatic change of form on select change
$('#modifyRecipient select[name=type]').on('change', function (){

	var wallet_type = $('#modifyRecipient select[name=type]').val();

	if(wallet_type == "Fiat"){
		$('#modifyRecipient .wallet_address').css('display', 'none');
		$('#modifyRecipient .balance').css('display', 'block');
	}
	else
	{
		$('#modifyRecipient .wallet_address').css('display', 'block');
		$('#modifyRecipient .balance').css('display', 'none');	
	}
});

$('#addRecipient select[name=type]').on('change', function (){

	var wallet_type = $('#addRecipient select[name=type]').val();

	if(wallet_type == "Fiat"){
		$('#addRecipient .wallet_address').css('display', 'none');
		$('#addRecipient .balance').css('display', 'block');
	}
	else
	{
		$('#addRecipient .wallet_address').css('display', 'block');
		$('#addRecipient .balance').css('display', 'none');	
	}
});

$(document).on('submit', '#addRecipient', function(e) {  
    e.preventDefault();
     
    $('input+small').text('');
    $('input').parent().removeClass('has-error');
     
    $.ajax({
        method: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: "json"
    })
    .done(function(data) {

    	location.reload();
        $('#modal-add-recipient').modal('hide');
    })
    .fail(function(data) {
    	var data = data.responseJSON;
        $.each(data.errors, function (key, value) {
            var input = '#addRecipient input[name=' + key + ']';
            $(input + '+small').text(value);
            $(input).parent().addClass('has-error');
        });
    });
});

$(document).on('submit', '#modifyRecipient', function(e) {  
    e.preventDefault();
     
    $('input+small').text('');
    $('input').parent().removeClass('has-error');
     
    $.ajax({
        method: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: "json"
    })
    .done(function(data) {

    	location.reload();
        $('#modal-modify-recipient').modal('hide');
    })
    .fail(function(data) {
    	var data = data.responseJSON;
        $.each(data.errors, function (key, value) {
            var input = '#modifyRecipient input[name=' + key + ']';
            $(input + '+small').text(value);
            $(input).parent().addClass('has-error');
        });
    });
});

$('.modify-recipient').on('click', function(e) {  

	var recipientId = $(this).data('id');

    $('#modifyRecipient input[name=name]').val($(this).data('name'));
    $('#modifyRecipient input[name=wallet_address]').val($(this).data('wallet'));
    $('#modifyRecipient input[name=type]').val($(this).data('type'));
    $('#modifyRecipient input[name=balance]').val($(this).data('balance'));
    $('#modifyRecipient input[name=shares]').val($(this).data('shares'));
    $('#modifyRecipient input[name=start_date]').val($(this).data('start'));

    $("#modifyRecipient").attr('action', function(i, val){
    	return "/recipient/"+recipientId;
    })

    $('#modal-modify-recipient').modal('show');
});


$('.delete-recipient').on('click', function(e) {  

    var recipientId = $(this).data('id');
    var recipientName = $(this).data('name');

    $("#modal-delete-recipient #recipientName").html( recipientName );
    $("#deleteRecipient").attr('action', function(i, val){
    	return "/recipient/"+recipientId;
    })

    $('#modal-delete-recipient').modal('show');
});