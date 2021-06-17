<?php

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/Config.php';

$app = new \Slim\App(['settings' => $config]);

require __DIR__ . '/Container.php';

require __DIR__ . '/Router.php';

require __DIR__ . '/../Middlewares/JsonResponse.php';

$app->run();
