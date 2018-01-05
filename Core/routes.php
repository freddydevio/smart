<?php

return [
    'index/index' => ['controller' => 'IndexController', 'action' => 'index'],
    'modules/index' => ['controller' => 'ModuleController', 'action' => 'index'],
    'modules/install' => ['controller' => 'ModuleController', 'action' => 'install'],
    'modules/list' => ['controller' => 'ModuleController', 'action' => 'list'],
    'modules/get' => ['controller' => 'ModuleController', 'action' => 'get'],
    'modules/settings' => ['controller' => 'ModuleController', 'action' => 'settings'],
    'modules/saveSettings' => ['controller' => 'ModuleController', 'action' => 'saveSettings'],
    'grid/index' => ['controller' => 'GridController', 'action' => 'index'],
    'grid/create' => ['controller' => 'GridController', 'action' => 'create'],
    'grid/save' => ['controller' => 'GridController', 'action' => 'save'],
    'admin/index' => ['controller' => 'AdminController', 'action' => 'index'],
    'dashboard/index' => ['controller' => 'DashboardController', 'action' => 'index'],
];