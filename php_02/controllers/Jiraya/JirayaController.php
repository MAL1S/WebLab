<?php
require_once "../controllers/TwigBaseController.php"; // импортим TwigBaseController

class JirayaController extends TwigBaseController {
    public $template = "__object.twig";
    public $title = "Jiraya";
    public $urlMain = "/jiraya";
    public $urlImage = "/jiraya/image";
    public $urlInfo = "/jiraya/info";
    public $name = "jiraya";

    public function getContext(): array {
        $context = parent::getContext();

        $context['name'] = $this->name;
        $context['url_main'] = $this->urlMain;
        $context['url_image'] = $this->urlImage;
        $context['url_info'] = $this->urlInfo;

        return $context;
    }   
}