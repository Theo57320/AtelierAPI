<?php

return [
    'dbhost'=>function (\Slim\Container $c){
        $config = parse_ini_file($c->settings['dbfile']);
        return $config['host'];
    },
];