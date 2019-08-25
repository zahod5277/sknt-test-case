<?php

class JSON_parser {

    function __construct(array $config = array()) {
        
    }

    public function initialize() {
        return 'JSON PARSER IS ACTIVE';
    }

    public function getData($uri) {
        $JSON = $this->getJSON($uri);
        $data = json_decode($JSON,1);
        if ($data['result'] != 'ok'){
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

}
