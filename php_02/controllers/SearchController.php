<?php

require_once "BaseNarutoTwigController.php";

class SearchController extends BaseNarutoTwigController {
    public $template = "search.twig";

    public function getContext(): array {
        $context = parent::getContext();

        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $description = isset($_GET['description']) ? $_GET['description'] : '';

        $sql = <<<EOL
SELECT id, title, info
FROM characters
WHERE (:title='' OR title like CONCAT('%', :title, '%'))
        AND (type = :type OR :type='')
        AND (info = '' OR info like CONCAT('%', :description, '%'))
EOL;
        $query = $this->pdo->prepare($sql);

        $query->bindValue("description", $description);
        $query->bindValue("title", $title);
        $query->bindValue("type", $type);
        $query->execute();

        $context['objects'] = $query->fetchAll();

        return $context;
    }
}