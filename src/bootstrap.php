<?php
declare(strict_types=1);
declare(ticks=1);

//error_reporting(E_ALL);
//ini_set('display_errors', 'true');
date_default_timezone_set('America/Mexico_City');

require_once __DIR__ . '/../vendor/autoload.php';

use Ding\Container\Impl\ContainerImpl;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Tonic\Application;
use Tonic\Exception;
use Tonic\NotFoundException;
use Tonic\Request;
use Tonic\Response;

AnnotationRegistry::registerLoader('class_exists');

define('ROOT_APPLICATION_PATH', dirname(__DIR__));

$properties = [
    'ding' => [
        'log4php.properties' => __DIR__ . DIRECTORY_SEPARATOR . 'log4php.php',
        'factory' => [
            'bdef' => [
                'annotation' => [
                    'scanDir' => [__DIR__]
                ],
            ],
            'properties' => [
                "database.config" => [
                    'driver'    => 'mysql',
                    'host'      => 'localhost',
                    'database'  => 'examen',
                    'username'  => 'root',
                    'password'  => 'admin',
                    'charset'   => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix'    => ''
                ]
            ],
        ],
    ],
];

$container = ContainerImpl::getInstance($properties);
$logger = Logger::getLogger('bootstrap');
$logger->info('Starting app');

$app = new Application([
    'load'  => __DIR__.'/Iaejean/*/*Controller.php',
    'cache' => new Tonic\MetadataCacheFile(ROOT_APPLICATION_PATH . '/tmp/tonic.cache')
]);

try {
    $request = new Request([
        'mimetypes' => [
            'json' => 'application/json'
        ]
    ]);
    $resource = $app->getResource($request);
    $response = $resource->exec();
    $response->contentType = 'application/json';
    header('Content-Type: application/json');
} catch (NotFoundException $e) {
    $logger->error($e->getMessage());
    $response = new Response(404, json_encode(['error' => 'Entity not found']));
} catch (Exception $e) {
    $logger->error($e->getMessage());
    $response = new Response(500, json_encode(['error' => 'Server error. Try again.']));
} catch (InvalidArgumentException $e) {
    $logger->error($e->getMessage());
    $response = new Response($e->getCode(), $e->getMessage());
} catch (\Exception $e) {
    $logger->error($e->getMessage());
    $response = new Response(500, json_encode(['error' => 'Server error. Try again.']));
}
ob_clean();
$response->contentType = 'application/json';
$response->output();
