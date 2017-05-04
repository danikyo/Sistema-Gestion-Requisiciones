$(document).on('ready', mainFunction);

function mainFunction()
{

	$activityLength = $('#activityTable tr').length-1;
	$resourceLength = $('#resourceTable tr').length-1;
	$productLength = $('#productTable tr').length-1;
	$userLength = $('#userTable tr').length-1;

	if($activityLength == 0 || $resourceLength == 0 || $productLength == 0 || $userLength == 0)
	{
		$('#btnNewProject').attr('disabled', 'disabled');
	}

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
	$inputActivityName = $('#inputActivityName').val();

	if ($inputActivity != '' && $inputActivityName != '')
	{
		$("#activityTable")
		.append
		(
			$('<tr>')
			.append
			(
				$('<td>').width('100').addClass('text-center')
				.append
				(
					$('<input>').attr('value', $inputActivity).attr('id', 'idActivity').attr('type', 'text').attr('name', 'idActivity[]').attr('required', 'required').attr('readonly', 'readonly').addClass('form-control')
				)
			)
			.append
			(
				$('<td>')
				.append
				(
					$('<input>').attr('value', $inputActivityName).attr('id', 'aDescription').attr('type', 'text').attr('name', 'activityDescription[]').attr('required', 'required').attr('readonly', 'readonly').addClass('form-control')
				)
			)
		)

		$('#selectActivity')
		.append
		(
			$('<option>').text($inputActivityName).val($inputActivity)
		)
		$('#selectActivity2')
		.append
		(
			$('<option>').text($inputActivityName).val($inputActivity)
		)

		$('.selectpicker').selectpicker('refresh'); //se encarga de actualizar cuando se agregan options o se remueven

		$activityLength++;
		if($activityLength != 0 && $resourceLength != 0 && $productLength != 0 && $userLength != 0)
		{
			$('#btnNewProject').removeAttr('disabled');
		}
	}
}

function funcNewResource()
{
	$inputResourceId = $('#inputResourceId').val();
	$inputResourceType = $('#inputResourceType').val();
	$selectActivity = $('#selectActivity').val();
	$selectActivityName = $('#selectActivity option:selected').text();

	if ($inputResourceId != '' && $inputResourceType != ''  && $selectActivityName != 'Actividades')
	{
		$('#resourceTable')
		.append
		(
			$('<tr>')
			.append
			(
				$('<td>').addClass('text-center')
				.append
				(
					$('<input>').attr('value', $inputResourceId).attr('id', 'resource-ID').attr('type', 'text').attr('name', 'resource-ID[]').attr('readonly', 'readonly').addClass('form-control')
				)
			)
			.append
			(
				$('<td>')
				.append
				(
					$('<input>').attr('value', $inputResourceType).attr('id', 'resourceType').attr('type', 'text').attr('name', 'resourceType[]').attr('readonly', 'readonly').addClass('form-control')
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
				$('<td>').addClass('text-center')
				.append
				(
					$('<input>').attr('value', $selectActivityName).attr('id', 'resource-name').attr('type', 'text').attr('readonly', 'readonly').addClass('form-control')
				)
			)
		)

		$('#selectResource')
		.append
		(
			$('<option>').text($inputResourceType).val($inputResourceId)
		)

		$('.selectpicker').selectpicker('refresh');

		$resourceLength++;
		if($activityLength != 0 && $resourceLength != 0 && $productLength != 0 && $userLength != 0)
		{
			$('#btnNewProject').removeAttr('disabled');
		}
	}

	$('#btnDelActivity').hide();
}

function funcNewProduct()
{
	$selectResource = $('#selectResource').val()
	$selectResourceType = $('#selectResource option:selected').text();

	if ($selectResourceType != 'Recursos')
	{
		$('#productTable')
		.append
		(
			$('<tr>')
			.append
			(
				$('<td>')
				.append
				(
					$('<input>').attr('id', 'productName').attr('type', 'text').attr('name', 'productName[]').attr('required', 'required').addClass('form-control')
				)
			)
			.append
			(
				$('<td>')
				.append
				(
					$('<input>').attr('id', 'productPrice').attr('type', 'number').attr('step', 'any').attr('name', 'productPrice[]').attr('required', 'required').addClass('form-control')
				)
			)
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
					$('<input>').attr('value', $selectResourceType).attr('id', 'product-TypeResource').attr('name', 'product-TypeResource[]').attr('readonly', 'readonly').addClass('form-control')
				)
			)
		)

		$productLength++;
		if($activityLength != 0 && $resourceLength != 0 && $productLength != 0 && $userLength != 0)
		{
			$('#btnNewProject').removeAttr('disabled');
		}
	}

	$('#btnDelResource').hide();
}

function funcNewUser()
{
	$idUser = $('#user option:selected').val();
	$idActivity = $('#selectActivity2').val();
	$idActivityName = $('#selectActivity2 option:selected').text();
	/*$.get('api/project/'+$idUser+'/user', function(data){
		$html_value = data[0].name;
		$('#uName').attr('value', $html_value);
	});*/

	if ($idActivityName != 'Actividades')
	{
		$.get('api/project/'+ $idUser +'/user', function(data){

			$('#userTable')
			.append
			(
				$('<tr>')
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
						//$('<label>').addClass('label-control').text(data[0].name)
						$('<input>').attr('value', data[0].name).attr('readonly', 'readonly').addClass('form-control')
					)
				)
				.append
				(
					$('<td>').addClass('text-center').attr('width', '100')
					.append
					(
						$('<input>').attr('id', 'user-IDactivity').attr('name', 'user-IDactivity[]').attr('value', $idActivity).attr('readonly', 'readonly').addClass('form-control')
					)
				)
				.append
				(
					$('<td>').addClass('text-center').attr('width', '100')
					.append
					(
						$('<input>').attr('id', 'user-Nameactivity').attr('name', 'user-Nameactivity[]').attr('value', $idActivityName).attr('readonly', 'readonly').addClass('form-control')
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
		});

		$userLength++;
		if($activityLength != 0 && $resourceLength != 0 && $productLength != 0 && $userLength != 0)
		{
			$('#btnNewProject').removeAttr('disabled');
		}
	}
}

function funcDelActivity() 
{
	var table = document.getElementById('activityTable');
    var rowCount = table.rows.length;

    if(rowCount > 1)
    {
	    table.deleteRow(rowCount -1); //elimina el ultimo elemento de la tabla
	    $("select[id=selectActivity] option:last").remove(); //elimina el último select
	}

	$('.selectpicker').selectpicker('refresh');

	$activityLength--;
	if($activityLength == 0 || $resourceLength == 0 || $productLength == 0 || $userLength == 0)
	{
		$('#btnNewProject').attr('disabled', 'disabled');
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

	var table2 = document.getElementById('resourceTable');
	var rowCount2 = table2.rows.length;
	if(rowCount2 == 1)
	{
		$('#btnDelActivity').show();
	}

	$('.selectpicker').selectpicker('refresh');

	$resourceLength--;
	if($activityLength == 0 || $resourceLength == 0 || $productLength == 0 || $userLength == 0)
	{
		$('#btnNewProject').attr('disabled', 'disabled');
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

	var table2 = document.getElementById('productTable');
	var rowCount2 = table2.rows.length;
	if(rowCount2 == 1)
	{
		$('#btnDelResource').show();
	}

	$productLength--;
	if($activityLength == 0 || $resourceLength == 0 || $productLength == 0 || $userLength == 0)
	{
		$('#btnNewProject').attr('disabled', 'disabled');
	}
}

function funcDelUser() 
{
	$(this).parent().parent().fadeOut( "slow", function() { $(this).remove(); } );

	$userLength--;
	if($activityLength == 0 || $resourceLength == 0 || $productLength == 0 || $userLength == 0)
	{
		$('#btnNewProject').attr('disabled', 'disabled');
	}

	$productLength--;
	if($productLength == 0)
	{
		$('#btnNewRequisicion').attr('disabled', 'disabled');
	}
}