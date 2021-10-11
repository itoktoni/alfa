<?php

namespace Modules\System\Http\Services;

use Modules\System\Dao\Interfaces\CrudInterface;

class ShowService
{
    public function show(CrudInterface $repository, $code, $relation = false)
    {
        return $repository->singleRepository($code, $relation);
    }
}
