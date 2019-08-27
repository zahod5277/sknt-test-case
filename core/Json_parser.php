<?php

class JSON_parser {

    function __construct(array $config = array()) {
        
    }

    public function initialize() {
        return 'JSON PARSER IS ACTIVE';
    }

    public function getData($uri) {
        $JSON = $this->getJSON($uri);
        $data = json_decode($JSON, 1);
        if ($data['result'] != 'ok') {
            $output['description'] = 'ERROR JSON PARSE';
            $output['status'] = 'ERROR';
        } else {
            $output['status'] = 'ok';
            $output['data'] = $data;
        }
        return $output;
    }

    protected function getJSON($uri) {
        $JSON = file_get_contents($uri);
        return $JSON;
    }

    public function getTarifsGroup($data) {
        if (empty($data)) {
            return $this->core->log('JSON DATA IS EMPTY!');
        }
        $groups = [];
        $i = 0;
        //return '<pre>'.print_r($data,1).'</pre>';
        foreach ($data as $group) {
            $groups[$i] = [
                'title' => $group['title'],
                'data' => $group['tarifs'],
                'speed' => $group['speed'],
                'link' => $group['link'],
                'class' => $this->findClass($group['title'])
            ];

            if (!empty($group['free_options'])) {
                $groups[$i]['options'] = $group['free_options'];
            }

            $prices = [];
            foreach ($groups[$i]['data'] as $g) {
                $prices[] = $g['price'];
            }
            $groups[$i]['min_price'] = min($prices);
            $groups[$i]['max_price'] = max($prices);
            $i++;
        }
        return $groups;
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
        $tarifs = [
            'title' => $filter,
            'tarifs' => $trfs
        ];
        return $tarifs;
    }

    public function getTarif($data, $id, $filter) {
        $result = [];
        foreach ($data as $group) {
            //die(var_dump($group));
            if ($group['title'] == $filter) {
                foreach ($group['tarifs'] as $g) {
                    if ($g['ID'] == $id) {
                        $result = [
                            'title' => $filter,
                            'period' => $g['pay_period'],
                            'payday' => strftime('%d.%m.%Y',$g['new_payday']),
                            'price' => $g['price'] / $g['pay_period'],
                            'payment' => $g['price']
                        ];
                    }
                }
            }
        }
        return $result;
    }

    public function findClass($title) {
        $lexicons = [
            'Земля' => 'earth',
            'Вода' => 'water',
            'Вода HD' => 'water',
            'Огонь' => 'fire',
            'Огонь HD' => 'fire',
        ];
        return $lexicons[$title];
    }

}
