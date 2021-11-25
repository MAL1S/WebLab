<?php
require_once "BaseNarutoTwigController.php";

class NarutoObjectCreateController extends BaseNarutoTwigController {
    public $template = "naruto_object_create.twig";
    
    // уберем тут abstract, и просто сделаем два пустых метода под get и post запросы
    public function get(array $context) // добавили параметр
    {
        echo $_SERVER['REQUEST_METHOD'];
        
        parent::get($context); // пробросили параметр
    }

    public function post(array $context) {
        // получаем значения полей с формы
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $info = $_POST['info'];
        
        // вытащил значения из $_FILES
        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];
        
        // используем функцию которая проверяет
        // что файл действительно был загружен через POST запрос
        // и если это так, то переносит его в указанное во втором аргументе место
        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name"; // формируем ссылку без адреса сервера

        // создаем текст запрос
        $sql = <<<EOL
INSERT INTO characters(title, image, description, info, type)
VALUES(:title, :image, :description, :info, :type)
EOL;

        // подготавливаем запрос к БД
        $query = $this->pdo->prepare($sql);
        // привязываем параметры
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        $query->bindValue("image", $image_url); // подвязываем значение ссылки к переменной  image_url
        
        // выполняем запрос
        $query->execute();
        
        $context['message'] = 'Вы успешно создали объект';
        $context['id'] = $this->pdo->lastInsertId(); // получаем id нового добавленного объекта

        $this->get($context);
    }
}