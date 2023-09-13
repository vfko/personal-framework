<?php


final class App extends Router {

    private int $is_error = 0;
    private string $body_template;
    private array $page_data;
    private array $template_data = array();
    private object $controller;

    public function __construct(string $uri) {

        parent::__construct($uri);
        $this->controller = $this->getControllerInstance($this->url_parameters, $this->_get_vars, $this->_post_vars, $this->controller_parameters);
        $this->body_template = $this->getBodyTemplate($this->url_parameters);
        $this->page_data = $this->controller->getPageData();
        $this->template_data = ($this->is_error === 0) ? $this->controller->getTemplateData() : $this->template_data;
    }

    private function getControllerInstance($url_parameters, $_get_vars, $_post_vars, $controller_parameters) {

        if ($url_parameters[0] === '/' || $url_parameters[0] === '' || $url_parameters[0] === 'index.php') {
            $controller_name = HOME_PAGE_CONTROLLER;
        } elseif (in_array($url_parameters[0], $this->list_of_apps)) {
            $controller_name = $this->createControllerName($url_parameters);
        } else {
            $this->is_error = 1;
            $controller_name = ERROR_PAGE_CONTROLLER;
        }

        return new $controller_name($_get_vars, $_post_vars, $controller_parameters);
    }

    public function getPagedata(): array {
        return $this->page_data;
    }

    public function getTemplateData(): array {
        return $this->template_data;
    }

    public function getTemplate(): string {
        return $this->body_template;
    }

}