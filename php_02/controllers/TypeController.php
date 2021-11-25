<?php

require_once "BaseNarutoTwigController.php";

class TypeController extends BaseNarutoTwigController {
    public $template = "type.twig";


    public function getContext() : array {
        $context = parent::getContext();

        $query = $this->pdo->prepare("SELECT * from types"); 
        $query->execute(); 
        $context['character_types'] = $query->fetchAll();

        return $context;
    }
}