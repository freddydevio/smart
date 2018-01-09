<?php

namespace Core\View;

class View
{
    /**
     * Render a view file
     *
     * @param string $view The view file
     * @param array $args Associative array of data to display in the view (optional)
     * @return void
     * @throws \Exception
     */
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);
        $file = TEMPLATE_ROOT . $view;  // relative to Core directory
        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }
    /**
     * Render a view template using Twig
     *
     * @param string $template  The template file
     * @param array $args  Associative array of data to display in the view (optional)
     *
     * @return void
     */
    public static function renderTemplate($template, $args = [])
    {
        static $twig = null;
        if ($twig === null) {
            $loader = new \Twig_Loader_Filesystem([TEMPLATE_ROOT]);
            $loader->addPath(__DIR__ . '/../../App/Modules/Weather/Resources/Templates/');
            $loader->addPath(__DIR__ . '/../../App/Modules/Clock/Resources/Templates/');
            $twig = new \Twig_Environment($loader);
        }
        echo $twig->render($template, $args);
    }
}