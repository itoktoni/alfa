<?php

namespace Modules\System\Http\Services;

use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Notes;

class SingleService
{
    public function get(CrudInterface $repository, $code, $relation = false)
    {
        if(request()->wantsJson()){
            return Notes::single($repository->singleRepository($code, $relation));
        }
        return $repository->singleRepository($code, $relation);
    }
}
