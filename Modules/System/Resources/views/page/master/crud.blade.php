<div class="navbar-fixed-bottom" id="menu_action">
    <div class="text-right action-wrapper">
        @switch($action_function)

        @case('index')
        @isset($actions['create'])
        <a href="{!! route($route_create) !!}" class="btn btn-success">{{ __('Create') }}</a>
        @endisset
        
        @isset($actions['delete'])
        <button type="submit" onclick="return confirm('Are you sure to delete data ?');" id="delete-action"
            value="delete" name="action" class="btn btn-danger">{{ __('Delete') }}</button>
        @endisset
        @break

        @case('create')
        <a id="linkMenu" href="{!! route($route_index) !!}" class="btn btn-warning">{{ __('Back') }}</a>
        <button type="reset" class="btn btn-default">{{ __('Reset') }}</button>
        @isset($actions['create'])
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        @endisset
        @break

        @case('edit')
        <a id="linkMenu" href="{!! route($route_index) !!}" class="btn btn-warning">{{ __('Back') }}</a>
        @isset($actions['update'])
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        @endisset
        @break

        @case('show')
        <a id="linkMenu" href="{!! route($route_index) !!}" class="btn btn-warning">{{ __('Back') }}</a>
        @isset($actions['update'])
        <a id="linkMenu" href="{!! route($route_edit, ['code' => $model->{$model->getKeyName()} ]) !!}" class="btn
            btn-primary">{{ __('Update') }}</a>
        @endisset
        @break

        @endswitch
    </div>
</div>
