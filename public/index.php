<?php

use App\Blog;
use Services\Http\Request;

require_once __DIR__ . '/../vendor/autoload.php';

$request = Request::createFromGlobals();

$blog = new Blog();
$response = $blog->handle($request);

$response->send();
