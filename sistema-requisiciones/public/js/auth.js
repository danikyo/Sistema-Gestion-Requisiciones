$(document).on('ready', mainFunction);

function mainFunction()
{
	$("body").on('click', '.btn-warning', funcAuth);
	$("body").on('click', '.btn-danger', funcDel);
}

function funcAuth()
{
	//se obtiene el valor de la primera columna para otorgárselo al input
	//para obtener la segunda columna 'td:nth-child(2)'
	var dato = $(this).parent().parent().find('td:first').html();
	$('#idUsuario').val(dato);
	$('#option').val("1");
}

function funcDel()
{
	var dato = $(this).parent().parent().find('td:first').html();
	$('#idUsuario').val(dato);
	$('#option').val("0");
}