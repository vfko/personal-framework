<?php


class Router {


    protected array $list_of_apps;
    protected array $_get_vars;
    protected array $_post_vars;
    protected array $url_parameters;
    protected array $controller_parameters;

    public function __construct($uri) {

        $this->list_of_apps = $this->getListOfApps();
        $this->_get_vars = $this->get_GetVariables();
        $this->_post_vars = $this->get_PostVaribles();
        $this->url_parameters = $this->parseUri($uri);
        $this->controller_parameters = $this->getControllerParameters($this->url_parameters);
    }
    
    private function parseUri($uri): array {
        $uri = trim($uri, '/');
        $uri = rtrim($uri, '/');
        return $this->filterLastUrlParameter(explode('/', $uri));
    }

    private function filterLastUrlParameter(array $parsed_uri): array {
        $last_parameter = array_pop($parsed_uri);
        $last_parameter = explode('?', $last_parameter);
        array_push($parsed_uri, $last_parameter[0]);
        return $parsed_uri;
    }

    private function filterClassName(string $url_parameter) {
        if (str_contains($url_parameter, '-')) {
            $url_parameter = explode('-', $url_parameter);
            foreach ($url_parameter as $word) {
                $result[] = ucfirst($word);
            }
            return implode('', $result);
        } else {
            return ucfirst($url_parameter);
        }
    }

    protected function createControllerName(array $url_parameters) {
        return $this->filterClassName($url_parameters[0]).'Controller';
    }

    private function createTemplateName(array $url_parameters) {
        $last_index = (count($url_parameters)-1);
        $last_parameter = $url_parameters[$last_index];
        return $this->filterClassName($last_parameter).'Template.php';
    }

    private function createTemplatePath(array $url_parameters) {
        $template_name = $this->createTemplateName($url_parameters);
        $app_name = array_shift($url_parameters);
        $path = 'app/'.$app_name.'/templates';
        foreach ($url_parameters as $parameter) {
            $path = $path.'/'.$parameter;
        }
        return $path.'/'.$template_name;
    }

    protected function getBodyTemplate(array $url_parameters) {
        $path = '';
        if ($url_parameters[0] === '/' || $url_parameters[0] === '' || $url_parameters[0] === 'index.php') {
            $path = 'app/'.HOME_PAGE.'/templates/'.HOME_PAGE_TEMPLATE.'.php';
        } elseif ($this->checkIfTemplateExist($url_parameters)) {
            $path = $this->createTemplatePath($url_parameters);
        } else {
            $path = 'app/'.ERROR_PAGE.'/templates/'.ERROR_PAGE_TEMPLATE.'.php';
        }
        return $path;
    }

    private function checkIfTemplateExist(array $url_parameters) {
        return file_exists($this->createTemplatePath($url_parameters));
    }

    private function getListOfApps() {
        $d = dir("app/");
        $apps = array();
        while (false !== ($app = $d->read())) {
            $apps[] = $app;
        }
        return $apps;
    }

    private function get_GetVariables() {
        return array_map('htmlspecialchars', $_GET);
    }

    private function get_PostVaribles(): array {
        $keys = array_keys($_POST);
        $result = array();
        foreach ($keys as $key) {
            if (is_array($_POST[$key])) {
                $result[$key] = array_map('htmlspecialchars', $_POST[$key]);
            } else {
                $result[$key] = htmlspecialchars($_POST[$key]);
            }
        }
        return $result;
    }

    private function getControllerParameters(array $parsed_uri): array {
        if (count($parsed_uri) > 1) {
            array_shift($parsed_uri);
            return $parsed_uri;
        }
        return array();
    }

}