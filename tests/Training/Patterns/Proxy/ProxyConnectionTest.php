<?php


namespace Tests\Training\Patterns\Proxy;

use PHPUnit\Framework\TestCase;
use Training\Member\Member;
use Training\Patterns\Proxy\Connection;
use Training\Patterns\Proxy\ProxyConnection;

class ProxyConnectionTest extends TestCase
{
    public function testSelectFromDbCallsConnectionOnFirstCall()
    {
        $connection = $this->createMock(Connection::class);
        $connection->expects($this->once())->method('selectFromDb');

        $user = $this->createMock(Member::class);

        $proxy = new ProxyConnection($connection, $user);
        $proxy->selectFromDb('user');
    }
}
