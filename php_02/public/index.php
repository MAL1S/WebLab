<?php
    require_once "../controllers/Controller404.php"; 
    require_once '../vendor/autoload.php';
    require_once "../controllers/MainController.php";
    require_once "../controllers/Jiraya/JirayaController.php";
    require_once "../controllers/Jiraya/JirayaImageController.php";
    require_once "../controllers/Jiraya/JirayaInfoController.php";
    require_once "../controllers/Minato/MinatoController.php";
    require_once "../controllers/Minato/MinatoImageController.php";
    require_once "../controllers/Minato/MinatoInfoController.php";
    require_once "../controllers/Pain/PainController.php";
    require_once "../controllers/Pain/PainImageController.php";
    require_once "../controllers/Pain/PainInfoController.php";

    $url = $_SERVER["REQUEST_URI"];

    $loader = new \Twig\Loader\FilesystemLoader('../views');
    $twig = new \Twig\Environment($loader, [
        "debug" => true // добавляем тут debug режим
    ]);
    $twig->addExtension(new \Twig\Extension\DebugExtension()); // и активируем расширение

    $title = "";
    $template = "";

    $context = []; 
    $controller = new Controller404($twig);

    $pdo = new PDO("mysql:host=localhost;dbname=naruto;charset=utf8", "root", "");
    

    if ($url == "/") {
        $controller = new MainController($twig);
    } elseif (preg_match("#/jiraya/image#", $url)) {
        $controller = new JirayaImageController($twig);
    } elseif (preg_match("#/jiraya/info#", $url)) {
        $controller = new JirayaInfoController($twig);
    } elseif (preg_match("#/jiraya#", $url)) {
        $controller = new JirayaController($twig);
    } elseif (preg_match("#/minato/image#", $url)) {
        $controller = new MinatoImageController($twig);
    } elseif (preg_match("#/minato/info#", $url)) {
        $controller = new MinatoInfoController($twig);
    } elseif (preg_match("#/minato#", $url)) {
        $controller = new MinatoController($twig);
    } elseif (preg_match("#/pain/image#", $url)) {
        $controller = new PainImageController($twig);
    } elseif (preg_match("#/pain/info#", $url)) {
        $controller = new PainInfoController($twig);
    } elseif (preg_match("#/pain#", $url)) {
        $controller = new PainController($twig);
    }

    if ($controller) {
        $controller->setPDO($pdo);
        $controller->get();
    }

?>