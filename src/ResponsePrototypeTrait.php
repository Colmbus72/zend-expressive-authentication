<?php
/**
 * @see       https://github.com/zendframework/zend-expressive-authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-expressive-authentication/blob/master/LICENSE.md New BSD License
 */
namespace Zend\Expressive\Authentication;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

trait ResponsePrototypeTrait
{
    /**
     * Return a ResponseInterface service if present or Zend\Diactoros\Response
     *
     * @param ContainerInterface $container
     * @throws Exception\InvalidConfigException
     * @return ResponseInterface
     */
    protected function getResponsePrototype(ContainerInterface $container): ResponseInterface
    {
        if (! $container->has(ResponseInterface::class)
            && ! class_exists(Response::class)
        ) {
            throw new Exception\InvalidConfigException(sprintf(
                'Cannot create %s service; dependency %s is missing. Either define the service, '
                . 'or install zendframework/zend-diactoros',
                static::class,
                ResponseInterface::class
            ));
        }
        return $container->has(ResponseInterface::class)
            ? $container->get(ResponseInterface::class)
            : new Response();
    }
}
