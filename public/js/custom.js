// View Recipient, automatic change of form on select change
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

    	//Add line to datatable
    	$('#recipient_list').DataTable().row.add( [
            data.name,
            data.type,
            data.shares,
            data.wallet_address,
            data.balance,
            data.start_date, 
            '<a href="http://localhost/recipient/'+data.id+'/edit" class="btn btn-default btn-xs btn-flat" data-toggle="modal" data-target="#modal-edit-recipient">Editer</a><a href="http://localhost/recipient/'+data.id+'" class="btn btn-default btn-xs btn-flat" data-toggle="modal" data-target="#modal-edit-recipient">Editer</a>'
        ] ).draw( false );

        $('#alert_message').removeClass('hidden');
        $('#alert_message').find('span').html(data.name + "a été ajouté avec succés !");



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

$('.delete-recipient').on('click', function(e) {  

    var recipientId = $(this).data('id');
    var recipientName = $(this).data('name');

    $("#modal-delete-recipient #recipientName").html( recipientName );
    $("#deleteRecipient").attr('action', function(i, val){
    	return val +"/"+recipientId;
    })

    $('#modal-delete-recipient').modal('show');
});