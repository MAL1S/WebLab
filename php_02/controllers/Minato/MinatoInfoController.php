<?php
require_once "MinatoController.php"; // импортим TwigBaseController

class MinatoInfoController extends MinatoController {
    public $template = "base_info.twig";
    public $text = "E:/web01/php_02/public/info/minato.html";
    public $type = "text";

    public function getContext(): array {
        $context = parent::getContext();

        $context['text'] = file_get_contents($this->text);
        $context['type'] = $this->type;

        return $context;
    }   
}