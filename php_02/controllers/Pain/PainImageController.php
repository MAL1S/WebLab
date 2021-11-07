<?php
require_once "PainController.php"; // импортим TwigBaseController

class PainImageController extends PainController {
    public $template = "base_image.twig";
    public $image = "/images/pain.png";
    public $type = "image";

    public function getContext(): array {
        $context = parent::getContext();

        $context['image'] = $this->image;
        $context['type'] = $this->type;

        return $context;
    }   
}