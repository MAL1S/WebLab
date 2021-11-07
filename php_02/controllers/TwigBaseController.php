<?php
require_once "BaseController.php"; // обязательно импортим BaseController

class TwigBaseController extends BaseController {
    public $title = ""; // название страницы
    public $template = ""; // шаблон страницы
    protected \Twig\Environment $twig; // ссылка на экземпляр twig, для рендернига
    
    // теперь пишем конструктор, 
    // передаем в него один параметр
    // собственно ссылка на экземпляр twig
    // это кстати Dependency Injection называется
    // это лучше чем создавать глобальный объект $twig 
    // и быстрее чем создавать персональный $twig обработчик для каждого класс 
    public function __construct($twig)
    {
        $this->twig = $twig; // пробрасываем его внутрь
    }
    
    // переопределяем функцию контекста
    public function getContext() : array
    {
        $menu = [
            [
                "title" => "Jiraya",
                "url_main" => "/jiraya",
                "url_image" => "/jiraya/image",
                "url_info" => "/jiraya/info"
            ],
            [
                "title" => "Minato",
                "url_main" => "/minato",
                "url_image" => "/minato/image",
                "url_info" => "/minato/info"
            ],
            [
                "title" => "Pain",
                "url_main" => "/pain",
                "url_image" => "/pain/image",
                "url_info" => "/pain/info"
            ],
            
        ];

        $context = parent::getContext(); 
        $context['title'] = $this->title;
        $context['menu'] = $menu;

        return $context;
    }
    
    // функция гет, рендерит результат используя $template в качестве шаблона
    // и вызывает функцию getContext для формирования словаря контекста
    public function get() {
        echo $this->twig->render($this->template, $this->getContext());
    }
}