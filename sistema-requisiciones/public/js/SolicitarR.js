$(document).on('ready', mainFunction);

function mainFunction()
{
	$productLength = $('#tableProductos tr').length-1;

	if($productLength == 0)
	{
		$('#btnNewRequisicion').attr('disabled', 'disabled');
	}

	$('#proyecto').on('change', funcSelectProyecto);
	$('#actividad').on('change', funcSelectActividad);
	$('#recurso').on('change', funcSelectRecurso);
	$('#producto').on('change', funcSelectProducto);
	$('#btnAddProducto').on('click', funcAddProducto);
}
//NOTA, EN JAVASCRIPT NO FUNCIONA EL LENGUAJE BLADE DE LARAVEL, YA QUE ESE ES LENGUAJE PHP
function funcSelectProyecto()
{
	$proyectoId = $(this).val();
	$userId = $('#idUser').val();

	$.get('/api/requisicion/' + $proyectoId + '/' + $userId + '/project', function(data) {
		var html_select = '<option value="">Actividades</option>';
		html_select += '<option disabled>──────────</option>';
		for (var i=0; i<data.length; ++i)
		{
			if(data[i].project_id == $('#proyecto').val())
			{
				html_select += '<option value="'+data[i].id+'">'+data[i].description+'</option>';
			}
		}
		$('#actividad').html(html_select);
	});
}

function funcSelectActividad()
{
	$actividadId = $(this).val();

	$.get('/api/requisicion/'+$actividadId+'/activity', function(data) {
		var html_select = '<option value="">Recursos</option>';
		html_select += '<option disabled>──────────</option>';
		for (var i=0; i<data.length; ++i)
		    html_select += '<option value="'+data[i].id+'">'+data[i].type+'</option>';
		$('#recurso').html(html_select);
	});

	$('#proyecto option:not(:selected)').attr('disabled', 'disabled');
}

function funcSelectRecurso()
{
	$recursoId = $(this).val();

	$.get('/api/requisicion/'+$recursoId+'/resource', function(data) {
		var html_select = '<option value="">Productos</option>';
		html_select += '<option disabled>──────────</option>';
		for (var i=0; i<data.length; ++i)
			html_select += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
		$('#producto').html(html_select);
	});

	$('#actividad option:not(:selected)').attr('disabled', 'disabled');
}

function funcSelectProducto()
{
	$productoId = $(this).val();

	$.get('/api/requisicion/'+$productoId+'/product', function(data) {
		var html_select = data[0].price;
		$('#precio').val(data[0].price);
	});

	$('#recurso option:not(:selected)').attr('disabled', 'disabled');
}

function funcAddProducto()
{
	$idProducto = $('#producto option:selected').val();
	$nameProducto = $('#producto option:selected').text();
	$priceProducto = $('#precio').val();

	$('#tableProductos')
	.append
	(
		$('<tr>')
		.append
		(
			$('<td>').addClass('text-center')
			.append
			(
				$('<input>').attr('value', $idProducto).attr('id', 'idProducto').attr('type', 'text').attr('name', 'idProducto[]').attr('readonly', 'readonly').addClass('form-control')
			)
		)
		.append
		(
			$('<td>')
			.append
			(
				$('<input>').attr('value', $nameProducto).attr('id', 'nameProducto').attr('type', 'text').attr('name', 'nameProducto[]').attr('readonly', 'readonly').addClass('form-control')
			)
		)
		.append
		(
			$('<td>')
			.append
			(
				$('<input>').attr('value', $priceProducto).attr('id', 'priceProducto').attr('type', 'text').attr('name', 'priceProducto[]').attr('readonly', 'readonly').addClass('form-control')
			)
		)
		.append
		(
			$('<td>').addClass('text-center')
			.append
			(
				$('<div>').attr('id', 'btnDelProducto').addClass('btn btn-danger del')
				.append
				(
					$('<span>').addClass('glyphicon glyphicon-trash')
				)
			)
		)
	)

	$productLength++;

	if($productLength != 0)
	{
		$('#btnNewRequisicion').removeAttr('disabled');
	}
}