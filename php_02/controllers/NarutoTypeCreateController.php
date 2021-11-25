<?php
require_once "BaseNarutoTwigController.php";

class NarutoTypeCreateController extends BaseNarutoTwigController {
    public $template = "naruto_type_create.twig";
    
    // уберем тут abstract, и просто сделаем два пустых метода под get и post запросы
    public function get(array $context) // добавили параметр
    {
        echo $_SERVER['REQUEST_METHOD'];
        
        parent::get($context); // пробросили параметр
    }

    public function post(array $context) {
        // получаем значения полей с формы
        $name = $_POST['name'];
        
        // вытащил значения из $_FILES
        $tmp_name = $_FILES['image']['tmp_name'];
        $file_name =  $_FILES['image']['name'];
        
        // используем функцию которая проверяет
        // что файл действительно был загружен через POST запрос
        // и если это так, то переносит его в указанное во втором аргументе место
        move_uploaded_file($tmp_name, "../public/media/$file_name");
        $image_url = "/media/$file_name"; // формируем ссылку без адреса сервера

        // создаем текст запрос
        $sql = <<<EOL
INSERT INTO types(name, image)
VALUES(:name, :image)
EOL;

        // подготавливаем запрос к БД
        $query = $this->pdo->prepare($sql);
        // привязываем параметры
        $query->bindValue("name", $name);
        $query->bindValue("image", $image_url); // подвязываем значение ссылки к переменной  image_url
        
        // выполняем запрос
        $query->execute();
        
        $context['message'] = 'You\'ve successfuly created new type of characters';
        //$context['id'] = $this->pdo->lastInsertId(); // получаем id нового добавленного объекта

        $this->get($context);
    }
}