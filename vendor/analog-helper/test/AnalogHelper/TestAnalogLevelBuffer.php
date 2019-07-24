<?php
/********* analog-config.ini ********
 * handler=LevelBuffer
 * subHandler=Variable
 * logFilePath=D:\TestLog.txt
 * logVariable=log
 * toEmail=
 * fromEmail=
 * emailSubject=
 * postFilePath=
 * logType=
 */
// none of these will trigger sending the log
Analog::log('Debugging...', Analog::DEBUG);
Analog::log('Minor warning...', Analog::WARNING);
Analog::log('An error...', Analog::ERROR);
echo "Log is still empty:\n" . $GLOBALS['log'] . "<br>";
// but this will, and will include all the others in the log
Analog::log('Oh noes!', Analog::URGENT);
echo "<br>";
echo "Log now has everything:\n" . $GLOBALS['log'];
