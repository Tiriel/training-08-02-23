<?php

use App\Blog;
use Services\Http\Request;

require_once __DIR__ . '/../vendor/autoload.php';

$request = Request::create();

$blog = new Blog();
$response = $blog->handle($request);

$response->send();
