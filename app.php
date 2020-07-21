<?php
require_once "vendor/sofadesign/limonade/lib/limonade.php";
require_once "vendor/predis/predis/autoload.php";
require_once 'vendor/catfan/medoo/src/Medoo.php';

use Medoo\Medoo;

Predis\Autoloader::register();

dispatch_get("/items", "list_items");
    function list_items() {
        header('Content-Type: application/json');
        $database = new Medoo([
            'database_type' => 'pgsql',
            'database_name' =>  getenv("POSTGRES_DB"),
            'server' => 'db_sample001',
            'username' => getenv("POSTGRES_USER"),
            'password' => getenv("POSTGRES_PASSWORD")
        ]);
        $redis = new Predis\Client(array(
            "scheme" => "tcp",
            "host" => "redis_sample001",
            "port" => getenv("REDIS_PORT"),
            "database" => getenv("REDIS_DB")
        ));
        if ($redis->exists('items')) {
            return $redis->get('items');
        }
        $items = $database->select('items', ['item_id', 'description', 'value', 'orbicular'], []);
        if (count($items) === 0) {
            header("HTTP/1.0 404 Not Found");
            exit;
        }
        $redis->set('items', json_encode($items));
        $redis->expire('items', getenv("DEFAULT_TTL"));
        return $redis->get('items');
    }

dispatch_get("/items/:item_id", "get_item");
    function get_item() {
        header('Content-Type: application/json');
        $database = new Medoo([
            'database_type' => 'pgsql',
            'database_name' =>  getenv("POSTGRES_DB"),
            'server' => 'db_sample001',
            'username' => getenv("POSTGRES_USER"),
            'password' => getenv("POSTGRES_PASSWORD")
        ]);
        $redis = new Predis\Client(array(
            "scheme" => "tcp",
            "host" => "redis_sample001",
            "port" => getenv("REDIS_PORT"),
            "database" => getenv("REDIS_DB")
        ));
        if ($redis->exists(params('item_id'))) {
            return $redis->get(params('item_id'));
        }
        $items = $database->select('items', ['item_id', 'description', 'value', 'orbicular'], ['item_id' => params('item_id')]);
        if (count($items) === 0) {
            header("HTTP/1.0 404 Not Found");
            exit;
        }
        $redis->set(params('item_id'), json_encode($items[0]));
        $redis->expire(params('item_id'), getenv("DEFAULT_TTL"));
        return $redis->get(params('item_id'));
    }

run();
?>
