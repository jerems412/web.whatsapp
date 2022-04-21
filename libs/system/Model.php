<?php
namespace libs\system;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Query\QueryBuilder;
require_once "vendor/autoload.php";

class Model     
{
    protected $entityManager;
    public function __construct()
    {
        require_once "vendor/doctrine/cache/lib/Doctrine/Common/Cache/Psr6/DoctrineProvider.php";
        require_once "vendor/doctrine/cache/lib/Doctrine/Common/Cache/Cache.php";
        // Create a simple "default" Doctrine ORM configuration for Annotations
        $isDevMode = true;
        $proxyDir = null;
        $cache = null;
        $useSimpleAnnotationReader = false;
        $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

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
        $this->entityManager= $EntityManager;
    }
    
}

?>