<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;

use App\Services\Campus\GetAllCampus;

class CampusController extends BaseController
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }
    
    public function getAll(Request $request, Response $response, array $args): Response
    {
        $getAllCampus = new GetAllCampus();
        $response->getBody()->write(json_encode($getAllCampus($this->container->get('db'))));
        return $response;
    }
}
