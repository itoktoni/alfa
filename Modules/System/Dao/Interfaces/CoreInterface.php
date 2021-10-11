<?php

namespace Modules\System\Dao\Interfaces;

interface CoreInterface
{
    public function deleteModule($folder);

    public function saveModule($code, $moduleName, $controller, $folder, $enable, $sort = 1, $description = null);

    public function deleteAction($code);

    public function saveAction($code, $name, $link, $controller, $function, $path, $visible);

    public function deleteModuleConnectionAction($code);

    public function saveModuleAction($module, $action);
}
