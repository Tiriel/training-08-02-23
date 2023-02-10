<?php

namespace Services\Controller;

use Services\Http\Response;

class MainController extends BaseController
{
    public function index(): Response
    {
        return $this->render('main/index.html.twig');
    }

    public function contact(): Response
    {
        return $this->render('main/contact.html.twig');
    }
}
