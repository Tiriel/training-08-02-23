<?php

namespace Tests\Training\Patterns\Observer;

use PHPUnit\Framework\MockObject\MockObject;
use Training\Patterns\Observer\ObserverInterface;
use Training\Patterns\Observer\Subject;
use PHPUnit\Framework\TestCase;

class SubjectTest extends TestCase
{
    protected static Subject $subject;
    protected static ObserverInterface|MockObject $observer;

    public static function setUpBeforeClass(): void
    {
        static::$subject = new Subject();
    }

    public function testAddObserverAddsObserverWithProperKey()
    {
        static::$observer = $mock = $this->createMock(ObserverInterface::class);
        $id = spl_object_id($mock);

        static::$subject->addObserver($mock);

        $this->assertCount(1, static::$subject->getObservers());
        $this->assertArrayHasKey($id, static::$subject->getObservers());
    }

    public function testRemoveObserverRemovesExistingObserver()
    {
        $this->assertCount(1, static::$subject->getObservers());

        $mock = $this->createMock(ObserverInterface::class);
        static::$subject->addObserver($mock);
        $this->assertCount(2, static::$subject->getObservers());

        static::$subject->removeObserver($mock);
        $this->assertCount(1, static::$subject->getObservers());
    }

    public function testRemoveObserverDoesNotRemoveOutsideObserver()
    {
        $this->assertCount(1, static::$subject->getObservers());

        $mock = $this->createMock(ObserverInterface::class);

        static::$subject->removeObserver($mock);
        $this->assertCount(1, static::$subject->getObservers());
    }

    public function testNotifyNotifiesEveryObserverRegistered()
    {
        static::$observer->expects($this->atLeast(1))->method('getNotified');
        $mock = $this->createMock(ObserverInterface::class);
        $mock->expects($this->once())->method('getNotified');
        static::$subject->addObserver($mock);

        $data = ['data'];
        static::$subject->notifyObservers($data);
        static::$subject->removeObserver($mock);
    }

    public function testDoStuffNotifiesObservers()
    {
        $result = static::$subject->doStuff();

        $this->assertSame("I've done stuff!", $result);
    }
}
