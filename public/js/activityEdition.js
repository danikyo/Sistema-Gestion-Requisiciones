$(document).on('ready', mainFunction);

function mainFunction()
{
	$("#btnNewActivity").on('click', funcNewActivity);
	$("body").on('click', '.btn-danger', funcDeleteRow);
}

function funcDeleteRow() 
{
	$(this).parent().parent().fadeOut( "slow", function() { $(this).remove(); } );
}

function funcNewActivity()
{
	$("#activityTable")
	.append
	(
		$('<tr>')
		.append
		(
			$('<td>')
			.append
			(
				$('<input>').attr('type', 'text').addClass('form-control').attr('name', 'Adescription[]')
			)
		)
		.append
		(
			$('<td>').addClass('text-center')
			.append
			(
				$('<div>').addClass('btn btn-sm btn-danger').text('Quitar')
			)
		)
	)
}