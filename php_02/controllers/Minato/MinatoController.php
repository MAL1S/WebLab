<?php
require_once "../controllers/TwigBaseController.php"; // импортим TwigBaseController

class MinatoController extends TwigBaseController {
    public $template = "__object.twig";
    public $title = "Minato";
    public $urlMain = "/minato";
    public $urlImage = "/minato/image";
    public $urlInfo = "/minato/info";
    public $name = "minato";

    public function getContext(): array {
        $context = parent::getContext();

        $context['name'] = $this->name;
        $context['url_main'] = $this->urlMain;
        $context['url_image'] = $this->urlImage;
        $context['url_info'] = $this->urlInfo;

        return $context;
    }   
}