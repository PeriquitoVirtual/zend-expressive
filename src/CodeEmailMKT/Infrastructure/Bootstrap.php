<?php

namespace CodeEmailMKT\Infastructure;

use CodeEmailMKT\Service\BootstrapInterface;

class Bootstrap implements BootstrapInterface{

    public function create()
    {
        require __DIR__ . '/config/doctrine.php';
    }
}