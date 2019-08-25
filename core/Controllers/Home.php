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
    public function run() {
        if (!class_exists('JSON_parser')) {
            require $this->core->config['corePath'].'/Json_parser.php';
        }
        $JSON = new JSON_parser();
        if ($fenom = $this->core->getFenom()) {
            $tarifs = $JSON->getData('https://www.sknt.ru/job/frontend/data.json');
            if ($tarifs['status'] != 'ERROR'){
                $groups = $this->getTarifsGroup($tarifs['data']['tarifs']);
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
    
    public function getTarifsGroup($data){
        if (empty($data)){
            return $this->core->log('JSON DATA IS EMPTY!');
        }
        $groups = [];
        $i = 0;
        //return '<pre>'.print_r($data,1).'</pre>';
        foreach ($data as $group){
            $groups[$i] = [
                'title' => $group['title'],
                'data' => $group['tarifs'],
                'speed' => $group['speed'],
                'link' => $group['link'],
            ];
            
            if (!empty($group['free_options'])){
                $groups[$i]['options'] = $group['free_options'];
            }
            
            $prices = [];
            foreach ($groups[$i]['data'] as $g){
                $prices[] = $g['price'];
            }
            $groups[$i]['min_price'] = min($prices);
            $groups[$i]['max_price'] = max($prices);
            $i++;
        }
        return $groups;
    }

}
