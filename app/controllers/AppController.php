<?php

class AppController{
    protected function isPost(): bool {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function isGet(): bool {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    protected function isAuthorized(): bool {
        return isset($_SESSION['user']);
    }
    protected function render(string $template = null, array $variables = [], string $redirectUrl = null){
        if ($redirectUrl) {
            header('Location: ' . $redirectUrl);
            exit;
        }
    
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