<div class="action text-center">
    @if (isset($actions['update']))
    <a id="linkMenu" href="{{ route($route_edit, ['code' => $model->{$model->getKeyName()}, 'company_id' => $model->mask_company_id]) }}" class="btn btn-xs btn-primary">@lang('pages.update')</a>
    @endif
    @if (isset($actions['show']))
    <a id="linkMenu" href="{{ route($route_show, ['code' => $model->{$model->getKeyName()}]) }}" class="btn btn-xs {{ $model->{$model->getDeletedAtColumn()} ? 'btn-danger' : 'btn-warning' }}">@lang('pages.show')</a>
    @endif
    @if($model->{$model->getDeletedAtColumn()})
    <a id="linkMenu" onclick="return confirm('Are you sure to activate data ?');" href="{{ route($route_edit, ['code' => $model->{$model->getKeyName()}, 'activate' => 1]) }}" class="btn btn-xs btn-success">@lang('activate')</a>
    @endif
</div>