adminMenu();
confirmMessage();
responseMessage();

$('#settings .dropdown-toggle').click(function(){
	$( $(this).attr('data-target') ).slideToggle();
});