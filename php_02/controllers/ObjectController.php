<?php

class ObjectController extends TwigBaseController {
    public $template = "__object.twig";

    public function getContext() : array {
        $context = parent::getContext();

        $query = $this->pdo->prepare("SELECT title,image,info,description,id FROM characters WHERE id= :my_id");
        // подвязываем значение в my_id 
        $query->bindValue("my_id", $this->params['id']);
        $query->execute(); // выполняем запрос
        // тянем данные
        $data = $query->fetch();

        $context['id'] = $this->params['id'];
        $context['title'] = $data['title'];
        $context['description'] = $data['description'];

        return $context;
    }
}