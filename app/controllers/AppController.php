<?php

require_once __DIR__.'/../repositories/CategoryRepository.php';

class AppController{
    protected $message = [];

    protected function isPost(): bool {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function isGet(): bool {
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    protected function isAuthorized(): bool {
        return isset($_SESSION['user']);
    }

    protected function isAuthorizedAsAdmin(): bool {
        return isset($_SESSION['user']) && $_SESSION['user']->role === 'admin';
    }

    private function setSessionCategories() {
        if (!isset($_SESSION['categories']) || empty($_SESSION['categories'])) {
            $categoryRepository = new CategoryRepository();
            $_SESSION['categories'] = $categoryRepository->getAllCategories();
        }
    }

    protected function render(string $template = null, array $variables = []) {
        $templatePath = __DIR__ . '/../templates/' . $template . '.php';
        $output = "File not found";
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->setSessionCategories();

        if (file_exists($templatePath)) {
            if (isset($_SESSION['messages'])) {
                $variables['messages'] = $_SESSION['messages'];
                unset($_SESSION['messages']);
            }
            extract($variables);
            ob_start();
            include $templatePath;
            $output = ob_get_clean();
        }
        echo $output;
    }
}