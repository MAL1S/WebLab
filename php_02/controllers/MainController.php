<?php
require_once "BaseNarutoTwigController.php"; // импортим TwigBaseController

class MainController extends BaseNarutoTwigController {
    public $template = "main.twig";
    public $title = "Главная";

    public function getContext(): array
    {
        $context = parent::getContext();
        
        if (isset($_GET['type'])) {
            $query = $this->pdo->prepare("SELECT * FROM characters WHERE type = :type");
            $query->bindValue("type", $_GET['type']);
            $query->execute();
        } else {
            $query = $this->pdo->query("SELECT * FROM characters");
        }

        $context['characters'] = $query->fetchAll();
        
        return $context;
    }
}