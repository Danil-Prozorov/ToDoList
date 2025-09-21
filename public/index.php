<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Kernel\Kernel;

$core = new Kernel();
$core->run();
