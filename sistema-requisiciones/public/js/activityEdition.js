$(document).on('ready', mainFunction);

function mainFunction()
{
	if($('#userTable tr').length == 1)
	{
		$('#btnNewProject').attr('disabled', 'disabled');
	}          

	//$idA = parseInt($('#idActivity').html())+1; //lleva el indice de las actividades que se guardaran en la base de datos
	//$idR = parseInt($('#idResource').html())+1; //lleva el indice de los recursos que se guardaran en la base de datos

	$("#btnNewActivity").on('click', funcNewActivity);
	$("#btnNewResource").on('click', funcNewResource);
	$("#btnNewProduct").on('click', funcNewProduct);
	$("#btnNewUser").on('click', funcNewUser);
	$("#btnDelActivity").on('click', funcDelActivity);
	$("#btnDelResource").on('click', funcDelResource);
	$("#btnDelProduct").on('click', funcDelProduct);
	$("body").on('click', '.del', funcDelUser);
}

function funcNewActivity()
{
	$inputActivity = $('#inputActivity').val();

	$("#activityTable")
	.append
	(
		$('<tr>')
		.append
		(
			$('<td>').width('100').addClass('text-center')
			.append
			(
				$('<input>').attr('value', $inputActivity).attr('id', 'idActivity').attr('type', 'text').attr('name', 'idActivity[]').attr('readonly', 'readonly').addClass('form-control')
			)
		)
		.append
		(
			$('<td>')
			.append
			(
				$('<input>').attr('id', 'aDescription').attr('type', 'text').attr('name', 'activityDescription[]').addClass('form-control')
			)
		)
	)

	$('#selectActivity')
	.append
	(
		$('<option>').text($inputActivity)
	)
}

function funcNewResource()
{
	$inputResource = $('#inputResource').val();
	$selectActivity = $('#selectActivity').val();

	$('#resourceTable')
	.append
	(
		$('<tr>')
		.append
		(
			$('<td>').addClass('text-center')
			.append
			(
				$('<input>').attr('value', $inputResource).attr('id', 'resource-ID').attr('type', 'text').attr('name', 'resource-ID[]').attr('readonly', 'readonly').addClass('form-control')
			)
		)
		.append
		(
			$('<td>')
			.append
			(
				$('<input>').attr('value', $selectActivity).attr('id', 'resource-IDactivity').attr('type', 'text').attr('name', 'resource-IDactivity[]').attr('readonly', 'readonly').addClass('form-control')
			)
		)
		.append
		(
			$('<td>')
			.append
			(
				$('<input>').attr('id', 'resourceType').attr('type', 'text').attr('name', 'resourceType[]').addClass('form-control')
			)
		)
	)

	$('#selectResource')
	.append
	(
		$('<option>').text($inputResource)
	)

	$idR++;
}

function funcNewProduct()
{
	$selectResource = $('#selectResource').val()

	$('#productTable')
	.append
	(
		$('<tr>')
		.append
		(
			$('<td>')
			.append
			(
				$('<input id="product-IDresource" type="text" name="product-IDresource[]" class="form-control" value="'+$selectResource+'" required readonly>')
				//$('<input>').attr('id', 'product-IDresource').attr('type', 'text').attr('name', 'product-IDresource[]').addClass('form-control')
			)
		)
		.append
		(
			$('<td>')
			.append
			(
				$('<input>').attr('id', 'productName').attr('type', 'text').attr('name', 'productName[]').addClass('form-control')
			)
		)
		.append
		(
			$('<td>')
			.append
			(
				$('<input>').attr('id', 'productPrice').attr('type', 'number').attr('step', 'any').attr('name', 'productPrice[]').addClass('form-control')
			)
		)
	)
}

function funcNewUser()
{
	$idUser = $('#user-id').val();
	/*$.get('api/project/'+$idUser+'/user', function(data){
		$html_value = data[0].name;
		$('#uName').attr('value', $html_value);
	});*/

	$.get('api/project/'+ $idUser +'/user', function(data){

		$('#userTable')
		.append
		(
			$('<tr>')
			.append
			(
				$('<td>').addClass('text-center').attr('width', '100')
				.append
				(
					$('<input>').attr('id', 'user-IDactivity').attr('name', 'user-IDactivity[]').addClass('form-control')
				)
			)
			.append
			(
				$('<td>')
				.append
				(
					$('<input>').attr('id', 'id-user').attr('name', 'id-user[]').attr('value', data[0].id).attr('readonly', 'readonly').addClass('form-control')
				)
			)
			.append
			(
				$('<td>')
				.append
				(
					$('<label>').addClass('label-control').text(data[0].name)
				)
			)
			.append
			(
				$('<td>')
				.append
				(
					$('<div>').attr('id', 'btnDelUser').addClass('btn btn-danger del')
					.append
					(
						$('<span>').addClass('glyphicon glyphicon-minus-sign')
					)
				)
			)
		)
		if($('#userTable tr').length > 0)
		{
		$('#btnNewProject').removeAttr('disabled');
		}
	});
}

function funcDelActivity() 
{

	//$(this).parent().parent().fadeOut( "slow", function() { $(this).remove(); } );

	var table = document.getElementById('activityTable');
    var rowCount = table.rows.length;

    if(rowCount > 1)
    {
    table.deleteRow(rowCount -1); //elimina el ultimo elemento de la tabla
    $("select[id=selectActivity] option:last").remove(); //elimina el último select
	}
}

function funcDelResource() 
{
	var table = document.getElementById('resourceTable');
    var rowCount = table.rows.length;

    if(rowCount > 1)
    {
    table.deleteRow(rowCount -1);
    $("select[id=selectResource] option:last").remove();
	}
}

function funcDelProduct() 
{
	var table = document.getElementById('productTable');
    var rowCount = table.rows.length;

    if(rowCount > 1)
    {
    table.deleteRow(rowCount -1);
	}
}

function funcDelUser() 
{
	$(this).parent().parent().fadeOut( "slow", function() { $(this).remove(); } );
}