<?php

use Training\Member\Member;
use Training\Patterns\Iterator\StepIterator;
use Training\Patterns\Observer\PenObserver;
use Training\Patterns\Observer\Subject;
use Training\Patterns\Proxy\{ProxyConnection};
use Training\Patterns\Proxy\Connection;

require_once __DIR__ . '/vendor/autoload.php';

$member = Member::create([
    'name' => 'Ben',
    'login' => 'Ben',
    'password' => 'pass',
    'age' => 35
]);
$proxy = new ProxyConnection(new Connection(), $member);

$user1 = $proxy->selectFromDb('user');
$user2 = $proxy->selectFromDb('user');
// var_dump($user1, $user2);
// var_dump($proxy->insertInDb(['foo' => 'bar']));
$data = range(1, 20);
$iterator = new StepIterator($data, 2);

//foreach ($iterator->asGenerator() as $key => $value) {
//    echo "key : $key - value : $value <br>";
//}

echo $member;
echo "<br>";

$subject = new Subject();
$subject->addObserver(new PenObserver());
echo $subject->doStuff();
