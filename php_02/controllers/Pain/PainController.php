<?php
require_once "../controllers/TwigBaseController.php"; // импортим TwigBaseController

class PainController extends TwigBaseController {
    public $template = "__object.twig";
    public $title = "Pain";
    public $urlMain = "/pain";
    public $urlImage = "/pain/image";
    public $urlInfo = "/pain/info";
    public $name = "pain";

    public function getContext(): array {
        $context = parent::getContext();

        $context['name'] = $this->name;
        $context['url_main'] = $this->urlMain;
        $context['url_image'] = $this->urlImage;
        $context['url_info'] = $this->urlInfo;

        return $context;
    }   
}