<?php

if (!class_exists('Controller')) {
    require_once dirname(dirname(__FILE__)) . '/Controller.php';
}

class Controllers_GetTarifs extends Controller {

    //http://zahod5277.beget.tech/index.php?&q=GetTarifs&group=%D0%92%D0%BE%D0%B4%D0%B0
    public function run($data = array()) {
        if (!class_exists('JSON_parser')) {
            require $this->core->config['corePath'] . '/Json_parser.php';
        }
        $JSON = new JSON_parser();
        $tarifs = $JSON->getData('https://www.sknt.ru/job/frontend/data.json');
        if ($tarifs['status'] != 'ERROR') {
            $trfs = $this->getTarifsByGroup($tarifs['data']['tarifs'],$data['group']);
        } else {
            $trfs = [];
        }
        if ($fenom = $this->core->getFenom()) {
            return $fenom->fetch('get.tarifs.tpl', [
                        'pagetitle' => 'Tarifs Page',
                        'title' => 'Hello SKYNET!',
                        'JSON' => '<pre>'.print_r($trfs,1).'</pre>'
            ]);
        } else {
            return '';
        }
    }

    public function getTarifsByGroup($data, $filter) {
        //return $data;
        if (empty($data)) {
            return $this->core->log('JSON DATA IS EMPTY!');
        }
        $tarifs = [];
        $i = 0;
        //return '<pre>'.print_r($data,1).'</pre>';
        foreach ($data as $group) {
            //die(var_dump($group));
            if ($group['title'] == $filter) {
                foreach ($group['tarifs'] as $g) {
                    $tarifs[] = [
                        'id' => $g['ID'],
                        'title' => $g['title'],
                        'period' => $g['pay_period'],
                        'price' => $g['price'],
                        'payment' => $g['price'],
                        'discount' => 0
                    ];
                    if ($g['pay_period'] == 1) {
                        $baseprice = $g['price'];
                    }
                }
            }

            //перебираем еще раз, чтобы высчитать все скидки и цены
            //да, лучше не придумал :( 
            $i = 0;
            $trfs = [];
            foreach ($tarifs as $t) {
                $price = $t['price'];
                $trfs[$i]['id'] = $t['id'];
                $trfs[$i]['price'] = $price / $t['period'];
                $trfs[$i]['payment'] = $price;
                $trfs[$i]['discount'] = $baseprice * $t['period'] - $price;
                $trfs[$i]['period'] = $t['period'];
                
                $i++;
            }
        }
        return $trfs;
    }

}
