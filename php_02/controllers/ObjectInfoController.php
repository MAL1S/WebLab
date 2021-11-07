<?php

class ObjectInfoController extends ObjectController {
    public $template = "base_info.twig";
    public function getContext(): array
    {
        $context = parent::getContext();
        
        $query = $this->pdo->prepare("SELECT info,id FROM characters WHERE id= :my_id");
         
        $query->bindValue("my_id", $this->params['id']);
        $query->execute(); 

        $data = $query->fetch();
        
        $context['texttext'] = $data['info'];
        $context['type'] = "text";
        return $context;
    }
}