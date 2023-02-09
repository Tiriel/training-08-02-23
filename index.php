<?php

require_once __DIR__.'/vendor/autoload.php';

$member = new \Member\Member('Ben', 'Ben', 'pass', 35);
var_dump($member);
