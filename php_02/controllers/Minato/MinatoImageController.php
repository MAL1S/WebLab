<?php
require_once "MinatoController.php"; // импортим TwigBaseController

class MinatoImageController extends MinatoController {
    public $template = "base_image.twig";
    public $image = "/images/minato.jpg";
    public $type = "image";

    public function getContext(): array {
        $context = parent::getContext();

        $context['image'] = $this->image;
        $context['type'] = $this->type;

        return $context;
    }   
}