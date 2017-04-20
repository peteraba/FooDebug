<?php

declare(strict_types=1);

namespace Foo\Debug\Exceptions\Handlers\Whoops;

use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Whoops\RunInterface;

class ExceptionHandlerTest extends TestCase
{
    /** @var ExceptionHandler */
    protected $sut;

    /** @var LoggerInterface|MockObject */
    protected $loggerMock;

    /** @var RunInterface|MockObject */
    protected $runMock;

    /** @var ExceptionRenderer|MockObject */
    protected $exceptionRendererMock;

    public function setUp()
    {
        $this->loggerMock = $this->getMockBuilder(LoggerInterface::class)
            ->getMock();

        $this->runMock = $this->getMockForAbstractClass(RunInterface::class);

        $this->exceptionRendererMock = $this->getMockBuilder(ExceptionRenderer::class)
            ->setMethods(['getRun'])
            ->disableOriginalConstructor()
            ->getMock();
        $this->exceptionRendererMock->expects($this->any())->method('getRun')->willReturn($this->runMock);

        $this->sut = new ExceptionHandler($this->loggerMock, $this->exceptionRendererMock);
    }

    public function testRegisterAddsHandlerAndRegistersRendererForCliRequests()
    {
        $this->sut->setIsCli(true);

        $this->runMock
            ->expects($this->once())
            ->method('pushHandler');

        $this->runMock
            ->expects($this->once())
            ->method('register');

        $this->sut->register();
    }

    public function testRegisterAddsHandlerAndRegistersRendererForHttpRequests()
    {
        $this->sut->setIsCli(false);

        $this->runMock
            ->expects($this->once())
            ->method('pushHandler');

        $this->runMock
            ->expects($this->once())
            ->method('register');

        $this->sut->register();
    }
}

