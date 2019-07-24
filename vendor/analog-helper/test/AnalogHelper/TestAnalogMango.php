<?php
/*
 * handler=Mongo
 * args="array('localhost','mangodb','log')"
 */
Analog::log('Error message');
Analog::log('Debug info', Analog::DEBUG);
$m   = new Mongo('localhost');
$cur = $m->testing->log->find();
foreach ($cur as $doc) {
    print_r($doc);
}
$m->testing->log->remove();
