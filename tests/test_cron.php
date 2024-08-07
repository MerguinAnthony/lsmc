<?php

// Chemin vers votre projet Symfony
require '/Users/anthonymerguin/Documents/Clients/OverLife/applsmc/vendor/autoload.php';

use Symfony\Component\Console\Application;
use App\Command\WeeklyTssResetCommand;

$application = new Application();
$application->add(new WeeklyTssResetCommand());
$application->run();
