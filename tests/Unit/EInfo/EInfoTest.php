<?php
declare(strict_types=1);

namespace LarsNieuwenhuizen\EUtilities\Tests\Unit\EInfo;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use LarsNieuwenhuizen\EUtilities\EInfo\EInfo;
use PHPUnit\Framework\TestCase;

class EInfoTest extends TestCase
{

    /**
     * @var EInfo
     */
    protected $subject;

    /**
     * @throws \Exception
     * @return void
     */
    protected function setUp()
    {
        $this->subject = new EInfo();
        parent::setUp();
    }

    /**
     * @test
     */
    public function getDbReturnsSetDb()
    {
        $this->subject->setDb('testDb');
        $this->assertEquals('testDb', $this->subject->getDb());
    }

    /**
     * @test
     */
    public function getReturnTypeReturnsSetReturnType()
    {
        $this->subject->setReturnType('xml');
        $this->assertEquals('xml', $this->subject->getReturnType());
    }

    /**
     * @test
     */
    public function getVersionReturnsSetVersion()
    {
        $this->subject->setVersion('1.0');
        $this->assertEquals('1.0', $this->subject->getVersion());
    }

    /**
     * @test
     */
    public function executeReturnsTheHttpResult()
    {
        $responseMock = $this->createMock(Response::class);
        $messageMock = $this->createMock(Stream::class);
        $httpClientMock = $this->getMockBuilder(Client::class)
            ->setMethods(['get'])
            ->getMock();

        $this->subject->setHttpClient($httpClientMock);

        $httpClientMock->expects($this->once())->method('get')->willReturn($responseMock);
        $responseMock->expects($this->once())->method('getBody')->willReturn($messageMock);
        $messageMock->expects($this->once())->method('getContents')->willReturn('{}');

        $this->subject->execute();
    }
}
