<?php

declare(strict_types=1);

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

    /** @var bool */
    protected $isCli = false;

    /**
     * @return bool
     */
    public function getIsCli(): bool
    {
        if (null === $this->isCli) {
            $this->isCli = (php_sapi_name() === 'cli');
        }

        return $this->isCli;
    }

    /**
     * @param bool $isCli
     */
    public function setIsCli(bool $isCli)
    {
        $this->isCli = $isCli;
    }

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

        if ($this->getIsCli()) {
            $renderer->pushHandler(new \Whoops\Handler\PlainTextHandler($this->logger));
        } else {
            $renderer->pushHandler(new \Whoops\Handler\PrettyPageHandler());
        }

        $renderer->register();
    }
}
