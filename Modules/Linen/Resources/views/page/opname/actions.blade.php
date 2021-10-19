<div class="action text-center">
    @if (isset($actions['show']))
    <a id="linkMenu" href="{{ route($route_show, ['code' => $model->{$model->getKeyName()}]) }}"
        class="btn btn-xs btn-primary">{{ __('View') }}</a>
    @endif
</div>