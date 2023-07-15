/**
 * 	show/hide admin menu
 * */
 function hideAdminMenu(){
	$('body').css('overflow', 'auto');
	$('#adminMenu').addClass('d-none');
 }
 function showAdminMenu(){
	$('body').css('overflow', 'hidden');
	$('#adminMenu').css('top', $(window).scrollTop());
	$('#adminMenu').removeClass('d-none');
 }
 function adminMenu(){
	$('.adminMenuControl').click(function (e) {
		e.preventDefault();
		if($('#adminMenu').hasClass('d-none')){
			showAdminMenu();
		}else{
			hideAdminMenu();
		}
	});
	$('#adminMenu .menu-item').on('click', function(){
		hideAdminMenu();
	});
 }
 
 
/**
 * 	confirmation window
 * */
function confirmMessage(){
	$('.confirm').click(function (e) {
		e.preventDefault();
		$('body').css('overflow', 'hidden');
		$('#confirm').css('top', $(window).scrollTop());
		$('#confirm-window').removeClass('d-none');
	});
	$('.confirm-btns').click(function () {
		$('body').css('overflow', 'auto');
		$('#confirm-window').addClass('d-none');
	});
}
 
 
 /*
* show/hide response meassage
*/
function hideResponseMessage(){
	$('.responseMessage').css('left', '-85%');
}
function displayResponseMessage(){
	$('.responseMessage').css('left', '1%');
}
function responseMessage(){
	$('.responseMessage').on('click', function(e){
		hideResponseMessage();
	});
    displayResponseMessage();
    let interval = setInterval(function(){
        hideResponseMessage();
        clearInterval(interval);            
    }, 4000);
}

//AJAX search
function search(url, token, key, exceptions){
    return $.ajax({
            type: 'post',
            url: url,
            data: {
				'_token': token, 
				'key': key,
				'exceptions': exceptions
			}
    });
}