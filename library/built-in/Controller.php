<?php


class Controller {

    protected array $page_data = array();
    protected array $controller_parameters;
    protected string $template_path = '';
    protected array $template_data = array('test_data'=>'test_data');
    protected array $data;

    public function __construct(array $_get_data, array $_post_data, array $controller_parameters) {
        $this->filldataArray($_get_data, $_post_data);
        $this->fillControllerParameters($controller_parameters);
    }

    /**
     * @param $custom_data  Custom page data: array('data_key' => 'data_value')
     */
    protected function addPageData(string $title, string $description, string $key_words, string $lang, array $custom_data = array()): void {
        $this->page_data['title'] = $title;
        $this->page_data['description'] = $description;
        $this->page_data['key_words'] = $key_words;
        $this->page_data['lang'] = $lang;

        if ($custom_data) {
            foreach ($custom_data as $key => $value) {
                $this->page_data[$key] = $value;
            }
        }
    }

    private function filldataArray (array $_get_data, array $_post_data) {
        foreach ($_get_data as $key => $value) {
            $this->data[$key] = $value;
        }

        foreach ($_post_data as $key => $value) {
            $this->data[$key] = $value;
        }
    }

    private function fillControllerParameters(array $controller_parameters): void {
        foreach ($controller_parameters as $parameter) {
            $this->controller_parameters[$parameter] = true;
        }
    }

    protected function addTemplateData(string $variable, string $value): void {
        $this->template_data[$variable] = $value;
    }

    protected function getControllerParam(string $param) {
        return (isset($this->controller_parameters[$param])) ? $this->controller_parameters[$param] : null;
    }

    public function getTemplateData(): array {
        return $this->template_data;
    }

    public function getPageData(): array {
        return $this->page_data;
    }

}