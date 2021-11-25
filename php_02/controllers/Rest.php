<?php

require_once //import

class Rest extends BaseNarutoTwigController {
    function list() {
        $query = $this->pdo->query("SELECT * FROM characters");
        $query->execute();

        $data = $query->fetchAll();
        
    }
}