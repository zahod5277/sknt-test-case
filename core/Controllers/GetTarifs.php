<?php

if (!class_exists('Controller')) {
    require_once dirname(dirname(__FILE__)) . '/Controller.php';
}

class Controllers_GetTarifs extends Controller {

    public function run() {
        if (!class_exists('JSON_parser')) {
            require $this->core->config['corePath'] . '/Json_parser.php';
        }
        $JSON = new JSON_parser();
        if ($fenom = $this->core->getFenom()) {
            return $fenom->fetch('get.tarifs.tpl', [
                'pagetitle' => 'Tarifs Page',
                'title' => 'Hello SKYNET!',
                'JSON' => ''
            ]);
        } else {
            return '';
        }
    }

}
