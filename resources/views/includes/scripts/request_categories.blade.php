
<script type="text/javascript">
	
	
	let update = "{{Session::has('update') ? 'yes' : 'no' }}";
	if(update != 'no'){
		window.sessionStorage.clear();
	}
	
	let locale = '{{ app()->getLocale() }}';
	let loader = '<div class="loader"><div></div><div></div><div></div></div>';
	let resultBlock = '';
	
	$(document).on('click', '.navbarToggle', function(){
		
		$('#navbarToggleSubCategories').removeClass('show');
						
		resultBlock = $($(this).attr('data-bs-target')).children().eq(0);
		
		if(!$(this).hasClass('collapsed')){
			if($(this).attr('data-bs-target') == '#navbarToggleCategories'){
				getCategories();
			}
			if($(this).attr('data-bs-target') == '#navbarToggleSubCategories'){
				if($(this).attr('data-cat-id') != $('#navbarToggleSubCategories').attr('data-cat-id')){
					$('#navbarToggleSubCategories').addClass('show');
				}
				$('#navbarToggleSubCategories').attr('data-cat-id', $(this).attr('data-cat-id'));
				getSubCategories($(this).attr('data-cat-id'));
			}
			
		}else{
			if($(this).attr('data-bs-target') == '#navbarToggleSubCategories' && !$('#navbarToggleSubCategories').hasClass('show')){
				if($(this).attr('data-cat-id') != $('#navbarToggleSubCategories').attr('data-cat-id')){					
					$('#navbarToggleSubCategories').addClass('show');			
					getSubCategories($(this).attr('data-cat-id'));					
				}
				$('#navbarToggleSubCategories').attr('data-cat-id', $(this).attr('data-cat-id'));
			}	
			
		}
		
	});
	
	
	function getCategories(){
		let categories = window.sessionStorage.getItem(locale+'_categories');
        if(categories == null){
			resultBlock.html(loader);
			$.ajax({
                type: 'post',
				data: {'_token':'{{ csrf_token() }}'},
                url: '{{route("category")}}',
                success: function(data){					
                    window.sessionStorage.setItem(locale+'_categories', JSON.stringify(data));
					setCategories(data);
				},
				error: function(){
					window.location.replace('{{route("home")}}');
				}
            });
        }else{
            setCategories(JSON.parse(categories));
        }
		
	}
	
	function setCategories(categories){		
		resultBlock.html('');	
		categories.forEach(function(e, i){
			$('<a>').attr('class', 'me-4 text-light text-sm dropdown-toggle navbarToggle')
					.attr('href', '#')
					.attr('data-bs-toggle', 'collapse')
					.attr('data-bs-target', '#navbarToggleSubCategories')
					.attr('data-cat-id', e.id)
					.html(e.name)
					.appendTo(resultBlock);
		});
		
	}
	
	function getSubCategories(id){
		let categories = JSON.parse(window.sessionStorage.getItem(locale+'_categories'));		
		categories.forEach(function(e, i){
			if(e.id == id){
				setSubCategories(e.children);
			}
		});
		
	}
		
	function setSubCategories(subcategories){		
		resultBlock.html('');
		subcategories.forEach(function(e, i){
			let url = '{{route("subcategory", ':id')}}';
			url = url.replace(':id', e.id);
			$('<a>').attr('class', 'me-4 link text-sm')
					.attr('href', url)
					.html(e.name)
					.appendTo(resultBlock);
		});
		
	}
	
	

</script>
