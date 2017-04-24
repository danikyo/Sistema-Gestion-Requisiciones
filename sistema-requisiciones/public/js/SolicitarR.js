$(document).on('ready', mainFunction);

function mainFunction()
{
	$('#proyecto').on('change', funcSelectProyecto);
	$('#actividad').on('change', funcSelectActividad);
	$('#recurso').on('change', funcSelectRecurso);
	$('#producto').on('change', funcSelectProducto);
	$('#btnAddProducto').on('click', funcAddProducto);
}

function funcSelectProyecto()
{
	$proyectoId = $(this).val();

	$.get('/api/requisicion/' + $proyectoId + '/project', function(data) {
		var html_select = '<option value="">Seleccione una Actividad</option>';
		for (var i=0; i<data.length; ++i)
			html_select += '<option value="'+data[i].id+'">'+data[i].description+'</option>';
		$('#actividad').html(html_select);
	});
}

function funcSelectActividad()
{
	$actividadId = $(this).val();

	$.get('/api/requisicion/'+$actividadId+'/activity', function(data) {
		var html_select = '<option value="">Seleccione un Recurso</option>';
		for (var i=0; i<data.length; ++i)
			html_select += '<option value="'+data[i].id+'">'+data[i].type+'</option>';
		$('#recurso').html(html_select);
	});
}

function funcSelectRecurso()
{
	$recursoId = $(this).val();

	$.get('/api/requisicion/'+$recursoId+'/resource', function(data) {
		var html_select = '<option value="">Seleccione un Producto</option>';
		for (var i=0; i<data.length; ++i)
			html_select += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
		$('#producto').html(html_select);
	});
}

function funcSelectProducto()
{
	$productoId = $(this).val();

	$.get('/api/requisicion/'+$productoId+'/product', function(data) {
		var html_select = data[0].price;
		$('#precio').val(data[0].price);
	});
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
}