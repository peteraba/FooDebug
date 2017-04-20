<?php

declare(strict_types=1);

namespace Foo\Debug\Exceptions\Handlers\Whoops;

use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Whoops\RunInterface;

class ExceptionRendererTest extends TestCase
{
    /** @var ExceptionRenderer */
    protected $sut;

    /** @var RunInterface|MockObject */
    protected $runMock;

    public function setUp()
    {
        $inDevelopmentEnvironment = true;

        $this->runMock = $this->getMockForAbstractClass(RunInterface::class);

        $this->sut = new ExceptionRenderer($this->runMock, $inDevelopmentEnvironment);
    }

    public function testRenderCallsHandlExceptionOnRun()
    {
        $exception = new \Exception();

        $this->runMock->expects($this->once())->method('handleException')->with($exception);

        $this->sut->render($exception);
    }
}
