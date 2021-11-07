<?php
require_once "JirayaController.php"; // импортим TwigBaseController

class JirayaImageController extends JirayaController {
    public $template = "base_image.twig";
    public $image = "/images/jiraya.png";
    public $type = "image";

    public function getContext(): array {
        $context = parent::getContext();

        $context['image'] = $this->image;
        $context['type'] = $this->type;

        return $context;
    }   
}