<div class="action text-center">
    <span class="btn btn-xs btn-{{ $model->status[$model->active][1] ?? 'default'  }}"> {{ $model->status[$model->active][0] ?? 'Unknown' }} </span>
</div>