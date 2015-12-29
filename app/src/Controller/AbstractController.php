<?php

namespace App\Controller;

use Slim\Container;
use App\Model\UserInterface;

abstract class AbstractController
{
    protected $view;
    protected $logger;
    protected $pdo;
    protected $flash;
    protected $mailer;
    protected $router;
    protected $userManager;

    public function __construct(Container $container)
    {
        $this->view = $container->get('view');
        $this->logger = $container->get('logger');
        $this->pdo = $container->get('pdo');
        $this->flash = $container->get('flash');
        $this->mailer = $container->get('mailer');
        $this->router = $container->get('router');
        $this->userManager = $container->get('userManager');
    }

    public function sendMail($subject, $content, UserInterface $user)
    {
        $message = Swift_Message::newInstance($subject)
            ->setFrom(['noreply@matcha.com' => 'Matcha Admin'])
            ->setTo([$user->getEmail() => $user->getUsername()])
            ->setBody($content)
            ->setContentType('text/html');
    }
}
