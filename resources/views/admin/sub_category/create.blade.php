@extends('layouts.app')

@section('title')
{{ __('words.sub categories') }}
@endsection

@section('page_title')
<section class="page_title">
	{{ __('words.create') }}
</section>
@endsection

@section('content')

<form method="POST" action="{{ route('admin.sub-categories.store') }}">
        @csrf
		
    	<div class="row mb-5">
			<div class="col-md-3"></div>
            <label for="category" class="col-md-6 col-form-label">
                {{ __('words.category') }}
            </label>
			<div class="col-md-3"></div>
			
            <div class="col-md-3"></div>
			<div class="col-md-6">
				<select id="category" class="form-control @error('category_id') is-invalid @enderror" name="category_id" required>
					<option class="d-none">-- {{ __('words.choose') }} --</option>
					@foreach($categories as $category)
					<option value="{{ $category->id }}">{{ $category->name }}</option>
					@endforeach
				</select>
            </div>
			<div class="col-md-3"></div>
			
			@error('category_id')
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<strong class="text-danger text-sm">{{ $message }}</strong>
			</div>
			@enderror
        </div>
		
		<div class="row mb-2">
			<div class="col-md-3"></div>
            <label for="name_en" class="col-md-6 col-form-label">
                {{ __('words.name_en') }}
            </label>
			<div class="col-md-3"></div>
			
            <div class="col-md-3"></div>
			<div class="col-md-6">
                <input id="name_en" type="text" class="form-control @error('name_en') is-invalid @enderror"
                name="name_en" value="{{ old('name_en') }}" required>
            </div>
			<div class="col-md-3"></div>
			
			@error('name_en')
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<strong class="text-danger text-sm">{{ $message }}</strong>
			</div>
			@enderror
        </div>
		
        <div class="row mb-2">
			<div class="col-md-3"></div>
            <label for="name_fr" class="col-md-6 col-form-label">
                {{ __('words.name_fr') }}
            </label>
			<div class="col-md-3"></div>
			
			<div class="col-md-3"></div>
            <div class="col-md-6">
                <input id="name_fr" type="text" class="form-control @error('name_fr') is-invalid @enderror"
                name="name_fr" value="{{ old('name_fr') }}" required>
            </div>
			<div class="col-md-3"></div>
			@error('name_fr')
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<strong class="text-danger text-sm">{{ $message }}</strong>
			</div>
			@enderror
        </div>
		
		<div class="row mb-5">
			<div class="col-md-3"></div>
            <label for="name_ar" class="col-md-6 col-form-label">
                {{ __('words.name_ar') }}
            </label>
			<div class="col-md-3"></div>
			
			<div class="col-md-3"></div>
            <div class="col-md-6">
                <input id="name_ar" type="text" class="form-control @error('name_ar') is-invalid @enderror"
                name="name_ar" value="{{ old('name_ar') }}" required>
            </div>
			<div class="col-md-3"></div>
			@error('name_ar')
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<strong class="text-danger text-sm">{{ $message }}</strong>
			</div>
			@enderror
        </div>
		
		<div class="row mb-2">
			<div class="col-md-3"></div>
            <label for="title_en" class="col-md-6 col-form-label">
                {{ __('words.title_en') }}
            </label>
			<div class="col-md-3"></div>
			
			<div class="col-md-3"></div>
            <div class="col-md-6">
                <input id="title_en" type="text" class="form-control @error('title_en') is-invalid @enderror"
                name="title_en" value="{{ old('title_en') }}">
            </div>
			<div class="col-md-3"></div>
			@error('title_en')
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<strong class="text-danger text-sm">{{ $message }}</strong>
			</div>
			@enderror
        </div>
		
		<div class="row mb-2">
			<div class="col-md-3"></div>
            <label for="title_fr" class="col-md-6 col-form-label">
                {{ __('words.title_fr') }}
            </label>
			<div class="col-md-3"></div>
			
			<div class="col-md-3"></div>
            <div class="col-md-6">
                <input id="title_fr" type="text" class="form-control @error('title_fr') is-invalid @enderror"
                name="title_fr" value="{{ old('title_fr') }}">
            </div>
			<div class="col-md-3"></div>
			@error('title_fr')
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<strong class="text-danger text-sm">{{ $message }}</strong>
			</div>
			@enderror
        </div>
		
		<div class="row mb-5">
			<div class="col-md-3"></div>
            <label for="title_ar" class="col-md-6 col-form-label">
                {{ __('words.title_ar') }}
            </label>
			<div class="col-md-3"></div>
			
			<div class="col-md-3"></div>
            <div class="col-md-6">
                <input id="title_ar" type="text" class="form-control @error('title_ar') is-invalid @enderror"
                name="title_ar" value="{{ old('title_ar') }}">
            </div>
			<div class="col-md-3"></div>
			@error('title_ar')
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<strong class="text-danger text-sm">{{ $message }}</strong>
			</div>
			@enderror
        </div>
		
		<div class="row mb-2">
			<div class="col-md-3"></div>
            <label for="description_en" class="col-md-6 col-form-label">
                {{ __('words.description_en') }}
            </label>
			<div class="col-md-3"></div>
			
			<div class="col-md-3"></div>
            <div class="col-md-6">
                <textarea id="description_en" type="text" class="form-control @error('description_en') is-invalid @enderror"
                name="description_en" rows="3">{{ old('description_en') }}</textarea>
            </div>
			<div class="col-md-3"></div>
			@error('description_en')
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<strong class="text-danger text-sm">{{ $message }}</strong>
			</div>
			@enderror
        </div>
		
		<div class="row mb-2">
			<div class="col-md-3"></div>
            <label for="description_fr" class="col-md-6 col-form-label">
                {{ __('words.description_fr') }}
            </label>
			<div class="col-md-3"></div>
			
			<div class="col-md-3"></div>
            <div class="col-md-6">
                <textarea id="description_fr" type="text" class="form-control @error('description_fr') is-invalid @enderror"
                name="description_fr" rows="3">{{ old('description_fr') }}</textarea>
            </div>
			<div class="col-md-3"></div>
			@error('description_fr')
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<strong class="text-danger text-sm">{{ $message }}</strong>
			</div>
			@enderror
        </div>
		
		<div class="row mb-4">
			<div class="col-md-3"></div>
            <label for="description_ar" class="col-md-6 col-form-label">
                {{ __('words.description_ar') }}
            </label>
			<div class="col-md-3"></div>
			
			<div class="col-md-3"></div>
            <div class="col-md-6">
                <textarea id="description_ar" type="text" class="form-control @error('description_ar') is-invalid @enderror"
                name="description_ar" rows="3">{{ old('description_ar') }}</textarea>
            </div>
			<div class="col-md-3"></div>
			@error('description_ar')
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<strong class="text-danger text-sm">{{ $message }}</strong>
			</div>
			@enderror
        </div>

        <div class="row mb-4">
			<div class="col-md-3"></div>
			<div class="col-md-6 d-flex bg-white border" style="margin-inline-start: 0.75rem; flex: 0;">
				<label for="visibility" class="col-form-label">
					{{ __('Visibility') }}
				</label>
            	<label class="switch mx-2">
					  <input id="visibility" type="checkbox" name="visibility" {{ old('visibility') == null ? '' : 'checked' }}>
					  <span class="slider"></span>
				</label>
			</div>
		</div>
		
        
        <div class="row mb-0">
            <div class="col-md-3"></div>
            <div class="col-md-3">
            	<button type="submit" class="btn btn-success">
                    {{ __('words.save') }} <i class="fas fa-save"></i>
                </button>
            </div>
        </div>
	</form>

@endsection