<?php

/**
 * The frontcontroller.
 * This file:
 * 1. Initializes Symfony's engine(the Kernel)
 * 2. Instatiates the Symfony App Kernel object which is held in global $kernel.
 * $kernel is the first thing that is instantiated in index.php and kicks off
 * the execution of the Symfony based application. $kernel holds a reference
 * to the service container.
 */

use App\Kernel;

require_once dirname(__DIR__) . '/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
