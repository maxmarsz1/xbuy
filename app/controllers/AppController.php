<?php

class AppController{
    protected function isPost(): bool {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function isGet(): bool {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }
    protected function render(string $template = null, array $variables = []){
        $templatePath = __DIR__ . '/../templates/' . $template . '.php';
        $output = "File not found";

        if(file_exists($templatePath)){
            extract($variables);
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        echo $output;
    }
}