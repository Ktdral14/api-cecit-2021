<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;

use App\Services\Author\RegisterFirstAuthor;
use App\Services\Author\Login;

class AuthorController extends BaseController
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }
    
    public function create(Request $request, Response $response, array $args): Response
    {
        $params = (array)$request->getParsedBody();

        $registerFirstAuthor = new RegisterFirstAuthor($params);

        $response->getBody()->write(json_encode($registerFirstAuthor($this->container->get('db'))));
        return $response;
    }

    public function login(Request $request, Response $response, array $args): Response
    {
        $params = (array)$request->getParsedBody();

        $login = new Login($params);

        $response->getBody()->write(json_encode($login($this->container->get('db'))));
        return $response;
    }
}
