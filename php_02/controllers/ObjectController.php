<?php

require_once "BaseNarutoTwigController.php";

class ObjectController extends BaseNarutoTwigController {
    public $template = "__object.twig";

    public function getTemplate() {
        if (isset($_GET['show'])) {
            if ($_GET['show'] == 'image') {
                return "base_image.twig";
            } elseif ($_GET['show'] == 'info') {
                $this->template = "base_info.twig";
            }
        }
        return parent::getTemplate();
    }

    public function getContext() : array {
        $context = parent::getContext();

        $query = $this->pdo->prepare("SELECT title,image,info,description,id FROM characters WHERE id= :my_id"); 
        $query->bindValue("my_id", $this->params['id']);
        $query->execute(); 
        $data = $query->fetch();

        $context['id'] = $this->params['id'];
        $context['title'] = $data['title'];
        $context['description'] = $data['description'];
        $context['image'] = $data['image'];
        $context['text'] = $data['info'];

        if (isset($_GET['show'])) {
            if ($_GET['show'] == 'image') {
                $context['type'] = "image";
            } elseif ($_GET['show'] == 'info') {
                $context['type'] = "text";
            }
        }

        return $context;
    }
}