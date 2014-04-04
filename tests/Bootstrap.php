<?php

if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    $loader = include __DIR__ . '/../vendor/autoload.php';
} elseif (file_exists(__DIR__ . '/../../../autoload.php')) {
    $loader = include __DIR__ . '/../../../autoload.php';
} elseif (file_exists(__DIR__ . '/../../autoload.php')) {
    $loader = include __DIR__ . '/../../autoload.php';
} else {
    throw new RuntimeException('vendor/autoload.php could not be found. Did you run `php composer.phar install`?');
}

/* var $loader \Composer\Autoload\ClassLoader */
$loader->add('HtImgModuleTest\\', __DIR__);
$loader->addPsr4('HtImgModule\\', __DIR__ . '/../src/');
define('TEST_DIR', __DIR__);
define('RESOURCES_DIR', TEST_DIR . '/resources');
