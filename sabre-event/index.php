<?php
require dirname(__DIR__) . '/utils.php';

use Sabre\Event\EventEmitter;

$eventEmitter = new EventEmitter();

$eventEmitter->on('create', function() {
    echo "Something got created, apparently\n";
});

$eventEmitter->emit('create');