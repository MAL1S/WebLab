<?php   
    require_once '../vendor/autoload.php';
    require_once '../framework/autoload.php';
    require_once "../controllers/Controller404.php"; 
    require_once "../controllers/MainController.php";
    require_once "../controllers/ObjectController.php";
    require_once "../controllers/SearchController.php";
    require_once "../controllers/NarutoObjectCreateController.php";
    require_once "../controllers/TypeController.php";
    require_once "../controllers/NarutoTypeCreateController.php";
    require_once "../controllers/NarutoObjectDeleteController.php";
    require_once "../controllers/NarutoObjectUpdateController.php";
    require_once "../framework/BaseRestController.php";
    //require_once "../controllers/TypeCharactersController.php";

    $loader = new \Twig\Loader\FilesystemLoader('../views');
    $twig = new \Twig\Environment($loader, [
        "debug" => true
    ]);
    $twig->addExtension(new \Twig\Extension\DebugExtension());

    $pdo = new PDO("mysql:host=localhost;dbname=naruto;charset=utf8", "root", "");

    $router = new Router($twig, $pdo);
    $router->add("/characters/(?P<id>\d+)/edit", NarutoObjectUpdateController::class);
    $router->add("/", MainController::class);
    $router->add("/characters/(?P<id>\d+)", ObjectController::class);
    $router->add("/search", SearchController::class);
    $router->add("/character/create", NarutoObjectCreateController::class);
    $router->add("/type", TypeController::class);
    $router->add("/type/", MainController::class);
    $router->add("/type/create", NarutoTypeCreateController::class);
    $router->add("/characters/delete", NarutoObjectDeleteController::class);
    $router->add("/api/characters/", BaseRestController::class);
    $router->add("/api/characters/(?P<id>\d+)", BaseRestController::class);
    //$router->add("/api/characters/(?P<id>\d+)/edit", BaseRestController::class);

    $router->get_or_default(Controller404::class);
?>