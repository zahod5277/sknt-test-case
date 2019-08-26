<?php

if (!class_exists('Controller')) {
    require_once dirname(dirname(__FILE__)) . '/Controller.php';
}

class Controllers_Home extends Controller {

    /**
     * @param array $params
     *
     * @return bool
     */
    public function initialize(array $params = array()) {
        if (!empty($_REQUEST['q'])) {
            $this->redirect('/');
        }
        return true;
    }

    /**
     * @return string
     */
    public function run($data = array()) {
        if (!class_exists('JSON_parser')) {
            require $this->core->config['corePath'].'/Json_parser.php';
        }
        $JSON = new JSON_parser();
        if ($fenom = $this->core->getFenom()) {
            $tarifs = $JSON->getData('https://www.sknt.ru/job/frontend/data.json');
            if ($tarifs['status'] != 'ERROR'){
                $groups = $JSON->getTarifsGroup($tarifs['data']['tarifs']);
            } else {
                $groups = [];
            }
            return $fenom->fetch('home.tpl', [
                'pagetitle' => 'MAIN Page',
                'title' => 'Hello SKYNET!',
                'JSON' => $groups
            ]);
        } else {
            return '';
        }
    }

}
