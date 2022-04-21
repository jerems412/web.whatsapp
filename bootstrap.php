<?php
// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;


require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for Annotations
$isDevMode = true;
$proxyDir = null;
$cache = null;//\Doctrine\Common\Cache\Psr6\DoctrineProvider::wrap($anyPsr6Implementation);
$useSimpleAnnotationReader = false;
$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

// database configuration parameters
$conn = array(
    'driver' => 'pdo_mysql',
    'host' => '127.0.0.1',
    'user' => 'root',
    'password' => '',
    'dbname' => 'whatsapp'
);

// obtaining the entity manager
$EntityManager = EntityManager::create($conn, $config);