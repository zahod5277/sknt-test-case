<?php

if (!class_exists('Controller')) {
    require_once dirname(dirname(__FILE__)) . '/Controller.php';
}

class Controllers_GetTarif extends Controller {

    //http://zahod5277.beget.tech/index.php?&q=GetTarifs&group=%D0%92%D0%BE%D0%B4%D0%B0
    public function run($data = array()) {
        if (!class_exists('JSON_parser')) {
            require $this->core->config['corePath'] . '/Json_parser.php';
        }
        $JSON = new JSON_parser();
        $tarifs = $JSON->getData('https://www.sknt.ru/job/frontend/data.json');
        if ($tarifs['status'] != 'ERROR') {
            $tarif = $JSON->getTarif($tarifs['data']['tarifs'], $data['id'],$data['group']);
        } else {
            $tarif = [];
        }
        if ($fenom = $this->core->getFenom()) {
            return $fenom->fetch('get.tarif.tpl', [
                        'JSON' => $tarif
            ]);
        } else {
            return '';
        }
    }

}
