@isset ($message)
    
<div class="responseMessage alert alert-{{ $type ?? 'info'}} col-10 col-sm-8 col-md-6 col-lg-4">
	{{ $message }}
</div>

@endisset
