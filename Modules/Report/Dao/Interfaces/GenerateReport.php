<?php

namespace Modules\Report\Dao\Interfaces;

interface GenerateReport
{
    public function data();
    public function generate($name, $share);
}
