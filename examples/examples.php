<?php

include_once __DIR__ . '/../vendor/autoload.php';


use edwrodrig\logger\Logger;

//YOU MUST IMPLEMENT A CONTEXT
$logger = new Logger(STDOUT);

//Nesting
$logger
    ->begin("BEGIN")
        ->log("some content line 1")
        ->log("some content")
    ->end("COMMIT");

//Multilevel nesting
$logger
    ->begin("LEVEL1")
        ->log("some content line 1")
        ->begin("LEVEL2")
            ->log("some content")
        ->end("COMMIT2")
    ->end("COMMIT1");

//Different line for end
$logger
    ->begin("LEVEL1")
        ->log("COMMIT1")
    ->end();


//Same line for end if no inside logging
$logger
    ->begin("LEVEL1...")
    ->end("COMMIT1");

//some logging
$logger
    ->begin("LEVEL1...")
        ->log("Some logging")
    ->end("COMMIT1");


