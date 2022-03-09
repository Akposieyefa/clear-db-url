<?php
    header("Content-Type: application/json");
    // Require composer autoloader
    require __DIR__ . '/vendor/autoload.php';

    // Create Router instance
    $router = new \Bramus\Router\Router();

    use Akposieyefa\ClearDbUrl\DotEnv;

    (new DotEnv(__DIR__ . '/.env'))->load();

    // Define routes

    $router->get('/', function() {

        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $host = $url["host"] ?? null;
        $username = $url["user"] ?? null;
        $password = $url["pass"] ?? null;
        $database = substr($url["path"], 1);
        echo json_encode([
            "DB_HOST" => $host,
            "DB_USERNAME" => $username,
            "DB_PASSWORD" => $password,
            "DB_DATABASE" => $database
        ]);
    });

    // Run it!
    $router->run();