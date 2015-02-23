<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Laasti\Middleware;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use League\Container\ContainerInterface;

/**
 * Description of Environment
 *
 * @author Sonia
 */
class Routing implements HttpKernelInterface
{

    private $app;
    private $container;

    public function __construct(HttpKernelInterface $app, ContainerInterface $container)
    {
        $this->app = $app;
        $this->container = $container;
    }

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {

        //TODO maybe better to get router directly, but would have to make it a singleton, maybe use an alias
        $dispatcher = $this->container->getRouter()->getDispatcher();

        $response = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());

        return $response;
    }

}