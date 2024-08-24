<?php

namespace Geekbrains\Application1\Application;

use Exception;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Render
{
    private string $viewFolder = '/Domain/Views/';
    private FilesystemLoader $loader;
    private Environment $environment;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(dirname(__DIR__) . $this->viewFolder);
        $this->environment = new Environment($this->loader, [
            // 'cache' => $_SERVER['DOCUMENT_ROOT'].'/cache/',
        ]);
    }

    public function renderPage(string $contentTemplateName = 'page/page-index.twig', array $templateVariables = [])
    {
        $template = $this->environment->load('main.twig');

        $templateVariables['header'] = 'header.twig';
        $templateVariables['nav'] = 'navigation.twig';
        $templateVariables['footer'] = 'footer.twig';
        $templateVariables['auth'] = 'users/user-auth.twig';
        $templateVariables['content_template_name'] = $contentTemplateName;

        if(isset($_SESSION['auth']['user_name'])){
            $templateVariables['user_authorized'] = true;
            $templateVariables['name'] = $_SESSION['auth']['user_name'];
            $templateVariables['lastname'] = $_SESSION['auth']['user_lastname'];
        }
        return $template->render($templateVariables);
    }

    public function renderPageWithForm(string $contentTemplateName = 'page/page-index.twig', array $templateVariables = [])
    {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        $templateVariables['csrf_token'] = $_SESSION['csrf_token'];

        return $this->renderPage($contentTemplateName, $templateVariables);
    }
}
