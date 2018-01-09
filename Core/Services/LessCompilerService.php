<?php

namespace Core\Services;

class LessCompilerService extends Service
{

    const CSS_OUTPUT_ADMIN_FILE = APPLICATION_ROOT . '/App/Public/Assets/admin/app.css';
    const CSS_OUTPUT_DASHBOARD_FILE = APPLICATION_ROOT . '/App/Public/Assets/dashboard/app.css';
    const CSS_OUTPUT_MODULES_FILE = APPLICATION_ROOT . '/App/Public/Assets/modules/app.css';

    public function compileLessFiles()
    {
        $this->compileDashboardLessFiles();
        $this->compileAdminLessFiles();
        $this->compileModuleLessFiles();
    }

    private function compileDashboardLessFiles()
    {
        try {
            $options = array('compress' => true);
            $parser = new \Less_Parser($options);

            $files = [
                APPLICATION_ROOT . '/App/Resources/Assets/css/dashboard/app.less',
                APPLICATION_ROOT . '/App/Modules/Weather/Resources/Assets/less/app.less',
                APPLICATION_ROOT . '/App/Modules/Clock/Resources/Assets/less/app.less',
            ];

            foreach ($files as $file) {
                $parser->parseFile($file);
            }

            $css = $parser->getCss();

            $this->saveCssFile($css, self::CSS_OUTPUT_DASHBOARD_FILE);

        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            var_dump($error_message);
            die();
        }
    }

    private function compileAdminLessFiles()
    {
        try {
            $options = array('compress' => true);
            $parser = new \Less_Parser($options);

            $files = [
                APPLICATION_ROOT . '/App/Resources/Assets/css/admin/app.less',
            ];

            foreach ($files as $file) {
                $parser->parseFile($file);
            }

            $css = $parser->getCss();

            $this->saveCssFile($css, self::CSS_OUTPUT_ADMIN_FILE);

        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            var_dump($error_message);
            die();
        }
    }

    private function compileModuleLessFiles()
    {
        try {
            $options = array('compress' => true);
            $parser = new \Less_Parser($options);

            $files = [
                APPLICATION_ROOT . '/App/Modules/Weather/Resources/Assets/less/app.less',
                APPLICATION_ROOT . '/App/Modules/Clock/Resources/Assets/less/app.less',
            ];

            foreach ($files as $file) {
                $parser->parseFile($file);
            }

            $css = $parser->getCss();

            $this->saveCssFile($css, self::CSS_OUTPUT_MODULES_FILE);

        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            var_dump($error_message);
            die();
        }
    }

    private function saveCssFile($content, $filePath) {

        if(!is_file($filePath)){
            $newFile = fopen($filePath,"w");
            fwrite($newFile, "");
            fclose($newFile);
        }

        file_put_contents($filePath, $content);
    }
}