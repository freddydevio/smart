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
    'lesscompiler/index' => ['controller' => 'LessCompilerController', 'action' => 'index'],
    'admin/index' => ['controller' => 'AdminController', 'action' => 'index'],
    'admin/settings' => ['controller' => 'AdminController', 'action' => 'settings'],
    'admin/saveSettings' => ['controller' => 'AdminController', 'action' => 'saveSettings'],
    'dashboard/index' => ['controller' => 'DashboardController', 'action' => 'index'],
];