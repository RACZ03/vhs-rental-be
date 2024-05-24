<?php

namespace Controllers;

class HomeController
{
    public function index()
    {
        return ['message' => 'Welcome to the VHS Rental Application', 'version' => getenv('APP_VERSION'), 'mode' => getenv('APP_ENV')];
    }
}
