<div class="action text-center">
    @if (isset($actions['show']))
    <a id="linkMenu" href="{{ route($route_show, ['code' => $model->{$model->getKeyName()}]) }}"
        class="btn btn-xs btn-primary">{{ __('View') }}</a>
    @endif
    @if (isset($actions['edit']) && isset($model) && $model->mask_status != OpnameStatus::Selesai)
    <a id="linkMenu" href="{{ route($route_edit, ['code' => $model->{$model->getKeyName()}]) }}"
        class="btn btn-xs btn-success">{{ __('Edit') }}</a>
    @endif
</div>