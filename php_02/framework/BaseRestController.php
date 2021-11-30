<?php
class BaseRestController extends BaseController{
    function list() {
        $query=$this->pdo->query("SELECT id, title FROM characters");
        $query->execute();
        $data=$query->fetchAll();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    function retrieve() {
        $query = $this->pdo->prepare("SELECT description, id, image, info FROM characters WHERE id = :id");
        $query->bindValue("id", $this->params['id']);
        $query->execute();

        $data = $query->fetch();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    function create() {
        $data=file_get_contents("php://input");
        $data=json_decode($data,True);
        $sql = <<<EOL
        INSERT INTO characters(title, image, description, info, type)
        VALUES(:title, :image, :description, :info, :type)
        EOL;
        $query=$this->pdo->prepare($sql);
        $query->bindValue("title",  $data['title']);
        $query->bindValue("description",  $data['description']);
        $query->bindValue("type",  $data['type']);
        $query->bindValue("info",  $data['info']);
        $query->bindValue("image",  $data['image']);
        $query->execute();
    
        http_response_code(200);
        header("Content-type:application/json");
        $context['id'] = $this->pdo->lastInsertId(); // получаем id нового добавленного объекта
        echo json_encode(['id'=> $this->pdo->lastInsertId()]);
    }

    function update() {
        $data=file_get_contents("php://input");
        $data=json_decode($data,True);
        $sql=<<<EOL
        UPDATE characters SET description=:description WHERE id=:id
        EOL;
        $query=$this->pdo->prepare($sql);
        $query->bindValue("id", $this->params['id']);
        $query->bindValue("description", $data['description']);
        $query->execute();
    
        http_response_code(200);
        header("Content-type:application/json");
        echo json_encode(['id'=>$this->params['id']]);
    }

    function delete() {
        $query = $this->pdo->prepare("DELETE FROM characters WHERE id = :id");
        $query->bindValue("id", $this->params['id']);
        $query->execute();
        
        http_response_code(200);
    }

    function process_response(){
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'GET'){
            if(isset($this->params['id']))
                $this->retrieve();
            else
                $this->list();
        }
        else if ($method == 'POST'){
            if(isset($this->params['id']))
                $this->update();
            else
                $this->create();
        }
        else if ($method == 'DELETE'){
            $this->delete();
        }
    }
}