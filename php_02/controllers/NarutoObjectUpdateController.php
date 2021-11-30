<?php

require_once "BaseNarutoTwigController.php";

class NarutoObjectUpdateController extends BaseNarutoTwigController {
    public $template = "naruto_object_update.twig";

    public function getContext(): array
    {
        $context = parent::getContext();
        $id = $this->params['id'];

        $sql =<<<EOL
select * from characters where id = :id
EOL; 
        
        $query = $this->pdo->prepare($sql);
        $query->bindValue(":id", $id);
        $query->execute();

        $data = $query->fetch();
        $context['object'] = $data;

        //$this->get($context);
        return $context;
    }

    public function post(array $context) {
         // получаем значения полей с формы
         $id = $this->params['id'];
         $title = $_POST['title'];
         $description = $_POST['description'];
         $type = $_POST['type'];
         $info = $_POST['info'];
         
         // вытащил значения из $_FILES
         $tmp_name = $_FILES['image']['tmp_name'];
         $name =  $_FILES['image']['name'];

        if($_FILES['image']['name']==''){
            $sql = <<<EOL
            UPDATE characters SET title = :title, description = :description, info = :info, type = :type
            WHERE id = :id
            EOL;
            $query = $this->pdo->prepare($sql);
        } else {
            move_uploaded_file($tmp_name, "../public/media/$name");
            $image_url = "/media/$name";
            $sql = <<<EOL
            UPDATE characters SET title = :title, image = :image, description = :description, info = :info, type = :type
            WHERE id = :id
            EOL;
            $query = $this->pdo->prepare($sql);
            $query->bindValue("image", $image_url);
        }        

         $query->bindValue("title", $title);
         $query->bindValue("description", $description);
         $query->bindValue("type", $type);
         $query->bindValue("info", $info);
         $query->bindValue("id", $id);
         
         // выполняем запрос
         $query->execute();
         
         $context['message'] = 'You\'ve successfully edited the object';
         $context['id'] = $id;
 
         $this->get($context);
    }
}