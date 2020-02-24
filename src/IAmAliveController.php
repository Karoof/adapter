<?php

namespace App;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class IAmAliveController
 *
 * @package App
 */
class IAmAliveController
{
    public function handle(Request $request): Response
    {
        return new Response('');
    }
}
