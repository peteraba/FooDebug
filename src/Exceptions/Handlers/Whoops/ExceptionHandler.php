<?php

namespace Foo\Debug\Exceptions\Handlers\Whoops;

use Psr\Log\LoggerInterface;
use Opulence\Debug\Exceptions\Handlers;
use Throwable;

class ExceptionHandler extends Handlers\ExceptionHandler
{
    /** @var LoggerInterface */
    protected $logger;

    /** @var ExceptionRenderer */
    protected $exceptionRenderer;

    /**
     * Handles an exception
     *
     * @param Throwable $ex The exception to handle
     */
    public function handle($ex)
    {
        $this->exceptionRenderer->render($ex);
    }

    /**
     * Registers the handler with PHP
     */
    public function register()
    {
        $renderer = $this->exceptionRenderer->getRun();

        if (php_sapi_name() === 'cli') {
            $renderer->pushHandler(new \Whoops\Handler\PlainTextHandler($this->logger));
        } else {
            $renderer->pushHandler(new \Whoops\Handler\PrettyPageHandler());
        }

        $renderer->register();
    }
}
