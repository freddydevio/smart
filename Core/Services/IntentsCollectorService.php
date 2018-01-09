<?php

namespace Core\Services;

use Core\Modules\Modules;

class IntentsCollectorService extends Service
{
    public function getModulesIntents()
    {
        /** @var Modules $moduleService */
        $moduleService = $this->serviceContainer->getService('modules');
        $modulesList = $moduleService->getListModules(false);

        $moduleIntents = [];

        foreach ($modulesList as $module) {
            $intentsFile = str_replace('Bootstrap.php', 'SpeechServices/intents.php', $module['path']);
            if(is_file($intentsFile)) {
                $intents = include_once($intentsFile);
                $moduleIntents[] = $intents;
            }
        }

        return $moduleIntents;
    }
}