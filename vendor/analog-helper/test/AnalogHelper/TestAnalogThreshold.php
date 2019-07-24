<?php
/********* analog-config.ini ********
 * handler=Threshold
 * subHandler=Variable
 * logFilePath=
 * logVariable=myCustomLog
 * toEmail=
 * fromEmail=
 * emailSubject=
 * postFilePath='http://localhost/eventbot'
 * logType=ERROR
 */
// these will be ignored
Analog::log('Debugging...', Analog::DEBUG);
Analog::log('Minor warning...', Analog::WARNING);
echo "Log is still empty:<br>" . $mylog . "<br>";
// but these will be logged
Analog::log('An error...', Analog::ERROR);
Analog::log('Oh noes!', Analog::URGENT);
echo "Log now has everything:<br>" . $mylog;
