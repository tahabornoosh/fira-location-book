<?php


namespace Fira\App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

abstract class BaseMiddleware
{
    /**
     * Example middleware invokable class
     *
     * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param  callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */


        /**
         * Example middleware invokable class
         *
         * @param  ServerRequest  $request PSR-7 request
         * @param  RequestHandler $handler PSR-15 request handler
         *
         * @return Response
         */
        public function __invoke(Request $request, RequestHandler $handler): Response
        {
            $response = $handler->handle($request);
            $existingContent = (string) $response->getBody();
        
            $response = new Response();
            $this->handleBefore($request, $response);
        
            return $response;
        }

    abstract protected function handleBefore(ServerRequestInterface $request, ResponseInterface $response): void;

    abstract protected function handleAfter(ServerRequestInterface $request, ResponseInterface $response): void;
}