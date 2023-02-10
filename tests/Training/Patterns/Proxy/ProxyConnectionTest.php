<?php


namespace Tests\Training\Patterns\Proxy;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Training\Member\Member;
use Training\Patterns\Proxy\Connection;
use Training\Patterns\Proxy\ProxyConnection;

class ProxyConnectionTest extends TestCase
{
    private static null|Connection|MockObject $connection;
    private static null|Member|MockObject $user;
    private static ?ProxyConnection $proxy;

    protected function setUp(): void
    {
        static::$connection ??= $this->createMock(Connection::class);
        static::$user ??= $this->createMock(Member::class);
        static::$proxy ??= new ProxyConnection(static::$connection, static::$user);
    }

    public function testSelectFromDbCallsConnectionOnFirstCall()
    {
        static::$connection->expects($this->once())->method('selectFromDb');
        static::$proxy->selectFromDb('user');
    }
}
