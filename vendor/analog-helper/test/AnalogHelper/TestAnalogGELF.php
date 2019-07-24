<?php
/*
 * handler=GELF
 * args="'localhost'"
 */
// 1. Install the GELF classes from https://github.com/Graylog2/gelf-php
require 'GELFMessage.php';
require 'GELFMessagePublisher.php';
Analog::log('Error message');
Analog::log(array('Debug info', __FILE__, __LINE__), Analog::DEBUG);
