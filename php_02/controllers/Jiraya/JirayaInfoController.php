<?php
require_once "JirayaController.php"; // импортим TwigBaseController

class JirayaInfoController extends JirayaController {
    public $template = "base_info.twig";
    public $text = "E:/web01/php_02/public/info/jiraya.html";
    public $type = "text";

    public function getContext(): array {
        $context = parent::getContext();

        $context['text'] = file_get_contents($this->text);
        $context['type'] = $this->type;

        return $context;
    }   
}