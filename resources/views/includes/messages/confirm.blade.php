<div id="confirm">
    <div class="container direction">
            <strong class="p-2 my-3 message">
			{{$message ?? '' }}
			</strong>
            <div>
                <a id="delete-btn" class="confirm-btns btn btn-outline-danger" data-id="0"
                onclick="document.getElementById('delete-form'+this.dataset.id).submit();">
                    {{ __('words.delete') }}
                </a>
                <a class="confirm-btns btn btn-light">{{ __('words.cancel') }}</a>
            </div>
     </div>
</div>