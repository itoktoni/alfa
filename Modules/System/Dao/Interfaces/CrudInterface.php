<?php

namespace Modules\System\Dao\Interfaces;

interface CrudInterface
{
    public function dataRepository();

    public function saveRepository($request);

    public function updateRepository($request, $code);
    
    public function deleteRepository($request);
    
    public function singleRepository($code, $relation = false);
}
