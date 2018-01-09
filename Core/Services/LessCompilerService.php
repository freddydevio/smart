<?php

namespace Core\Services;

class LessCompilerService extends Service
{

    const CSS_OUTPUT_FILE = APPLICATION_ROOT . '/App/Public/Assets/app.css';

    public function compileLessFiles()
    {
        try {
            $options = array('compress' => true);
            $parser = new \Less_Parser($options);

            $files = [
                APPLICATION_ROOT . '/App/Resources/Assets/css/admin/app.less',
                APPLICATION_ROOT . '/App/Resources/Assets/css/dashboard/app.less',
                APPLICATION_ROOT . '/App/Modules/Weather/Resources/Assets/less/app.less',
                APPLICATION_ROOT . '/App/Modules/Clock/Resources/Assets/less/app.less',
            ];

            foreach ($files as $file) {
                $parser->parseFile($file);
            }

            $css = $parser->getCss();

            $this->saveCssFile($css);

        } catch (\Exception $e) {
            $error_message = $e->getMessage();
            var_dump($error_message);
            die();
        }
    }

    private function saveCssFile($content) {

        if(!is_file(self::CSS_OUTPUT_FILE)){
            $newFile = fopen(self::CSS_OUTPUT_FILE,"w");
            fwrite($newFile, "");
            fclose($newFile);
        }

        file_put_contents(self::CSS_OUTPUT_FILE, $content);
    }
}