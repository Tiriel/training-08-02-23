<?php


namespace Tests\Training\Member;

use PHPUnit\Framework\TestCase;
use Training\Member\Member;

class MemberTest extends TestCase
{
    protected static array $instances = [];
    protected static int $count = 0;

    public function testMemberClassCountIsIncrementedOnNewInstance()
    {
        static::$instances[] = Member::create([
            'name' => 'Ben',
            'login' => 'Ben',
            'password' => 'pass',
            'age'=> 35,
        ]);
        static::$count++;

        $this->assertSame(1, Member::count());
    }

    public function testCreateMethodThrowsOnEmptyArray()
    {
        $this->expectException(\InvalidArgumentException::class);

        $member = Member::create([]);
    }

    public function testCreateMethodThrowsOnIncompleteArray()
    {
        $this->expectException(\InvalidArgumentException::class);

        $member = Member::create(['name' => 'Ben']);
    }

    public function testMemberClassCountIIsDecrementedOnUnsetInstance()
    {
        unset(static::$instances[0]);

        $this->assertSame(--static::$count, Member::count());
    }

    public function testAuthMethodFailsWithBadLoginOrPassword()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Auth failed!");

        $member = Member::create([
            'name' => 'Ben',
            'login' => 'Ben',
            'password' => 'pass',
            'age'=> 35,
        ]);

        $bool = $member->auth('Tom', 'pass');
    }

    public static function tearDownAfterClass(): void
    {
        static::$instances = [];
    }
}
