<div class="action text-center">
    @if (isset($actions['update']))
    <a id="linkMenu" href="{{ route($route_edit, ['code' => $model->{$model->getKeyName()}]) }}"
        class="btn btn-xs btn-primary">{{ __('Isi data linen') }}</a>
    @endif
</div>