<?php

namespace Ejercicios\act41\core\middleware;
use Ejercicios\act41\core\Request;

interface Middleware{
    public function handle(Request $request);
}