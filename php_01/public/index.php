<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"  rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
        <a class="navbar-brand" href="#"><i class="fas fa-at"></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/jiraya">Jiraya</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/minato">Minato</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pain">Pain</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <div class="container">
    <?php 
        require_once '../vendor/autoload.php';

        $loader = new \Twig\Loader\FilesystemLoader('../views');

        // создаем собственно экземпляр Twig с помощью которого будет рендерить
        $twig = new \Twig\Environment($loader);

        $title = "";
        $template = "";

        $context = [];
        $menu = [ // добавил список словариков
            [
                "title" => "Main",
                "url" => "/",
            ],
            [
                "title" => "Jiraya",
                "url" => "/jiraya",
            ],
            [
                "title" => "Minato",
                "url" => "/minato",
            ],
            [
                "title" => "Pain",
                "url" => "/pain",
            ]
        ];


        $url = $_SERVER["REQUEST_URI"];
     
        if ($url == "/") {
            require "../views/main.php";
        } elseif (preg_match("#^/jiraya#", $url)) {
            require "../views/jiraya.php";
        } elseif (preg_match("#^/minato#", $url)) {
            require "../views/minato.php";
        } elseif (preg_match("#^/pain#", $url)) {
            require "../views/pain.php";
        }
        ?>  
    </div>
    </body>
</html>