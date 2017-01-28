<?php
require_once 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader, array());

$request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();

$action = $request->get('action');

$isAjax = $request->isXmlHttpRequest();

$title =  ucfirst($action);

$content = $twig->render('index.html.twig', array(
        'title' => $title,
        'content' => "Content of $action ",
        'type' => $isAjax ? 'ajax' : 'standard'
    )
);

$response = new \Symfony\Component\HttpFoundation\Response($content, 200, array('X-Ajax-Title' => $title));

$response->send();