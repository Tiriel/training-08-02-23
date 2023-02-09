<?php

use Member\Member;
use Patterns\Proxy\{Connection, ProxyConnection};
use Patterns\Iterator\StepIterator;

require_once __DIR__.'/vendor/autoload.php';

$member = new Member('Ben', 'Ben', 'pass', 35);
$proxy = new ProxyConnection(new Connection(), $member);

$user1 = $proxy->selectFromDb('user');
$user2 = $proxy->selectFromDb('user');
// var_dump($user1, $user2);
// var_dump($proxy->insertInDb(['foo' => 'bar']));
$data = range(1,20);
$iterator = new StepIterator($data, 2);

foreach ($iterator->asGenerator() as $key => $value) {
    echo "key : $key - value : $value <br>";
}

echo $member;
