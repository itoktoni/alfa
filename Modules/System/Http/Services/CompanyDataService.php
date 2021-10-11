<?php

namespace Modules\System\Http\Services;

use Modules\System\Http\Resources\CompanyCollection;
use Modules\System\Http\Services\DataService;
use Modules\System\Plugins\Views;
use Yajra\DataTables\Facades\DataTables;

class CompanyDataService extends DataService
{

    protected function setAction()
    {
        $this->datatable->addColumn('checkbox', function($model){
           return view(Views::checkbox())->with(['model' => $model]);
        });
        $this->datatable->addColumn('action', function($model){
           return view(Views::action(config('page'), config('folder')))->with(['model' => $model]);
        });
    }

    public function make()
    {
        $this->setFilter();

        if (!request()->ajax()) {

            $pagination = request()->get('page') ? $this->filter->paginate(request()->get('limit') ?? config('website.pagination')) : $this->filter->get();
            return new CompanyCollection($pagination);
        }
        
        $this->datatable = Datatables::of($this->filter);
        $this->setAction();
        $this->setStatus();
        $this->setImage();
        $this->datatable->rawColumns($this->column);
        return $this->datatable->make(true);
    }
}
