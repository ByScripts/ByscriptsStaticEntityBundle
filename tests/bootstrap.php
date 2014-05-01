<?php

$autoload = __DIR__ . '/../vendor/autoload.php';

if (!file_exists($autoload)) {
    throw new \Exception('Autoload not found. Be sure to run composer install');
}

require $autoload;
