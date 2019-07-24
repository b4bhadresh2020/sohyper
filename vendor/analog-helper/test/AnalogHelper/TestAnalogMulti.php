<?php
/********* analog-config.ini ********
 * --------Multi wtih Variable sub Handler--------
 *
 * handler=Multi
 * subHandler=Variable
 * logFilePath=
 * logVariable=myCustomLog
 * toEmail=
 * fromEmail=
 * emailSubject=
 * postFilePath=
 * logType=
 */
Debug::log('NOTICE Message', Analog::NOTICE);
Debug::log('Error Message', Analog::ERROR);
Debug::log('ERROR Message', Analog::ERROR);
Debug::log('DEBUG Message', Analog::DEBUG);
Debug::log('ERROR Message', Analog::ERROR);
Debug::error('ERROR Message using error() method');
Debug::log('Info Message using Log()', Analog::INFO);
Debug::info('Info Message using info() method');
echo 'ERROR Messages:<Br>' . $myCustomLogERROR;
echo '<Br><Br>WARNING Messages:<Br>' . $myCustomLogWARNING;
echo '<Br><Br>DEBUG Messages:<Br>' . $myCustomLogDEBUG;
echo '<Br><Br>NOTICE Messages:<Br>' . $myCustomLogNOTICE;
echo '<Br><Br>INFO Messages:<Br>' . $myCustomLogINFO;
/********* analog-config.ini ********
 *--------Multi with File Handler--------
 *
 * handler=Multi
 * subHandler=File
 * logFilePath=D:\mylogtest.txt.
 * logVariable=myCustomLog
 * toEmail=
 * fromEmail=
 * emailSubject=
 * postFilePath=
 * logType=
 *
echo 'ERROR Messages:<Br>'.file_get_contents('D:\\mylogtest.txt.ERROR');
echo '<Br><Br>WARNING Messages:<Br>'.file_get_contents('D:\\mylogtest.txt.WARNING');
echo '<Br><Br>DEBUG Messages:<Br>'.file_get_contents('D:\\mylogtest.txt.DEBUG');
echo '<Br><Br>NOTICE Messages:<Br>'.file_get_contents('D:\\mylogtest.txt.NOTICE');
echo '<Br><Br>NOTICE Messages:<Br>'.file_get_contents('D:\\mylogtest.txt.NOTICE');

unlink('D:\\mylogtest.txt.ERROR');
unlink('D:\\mylogtest.txt.WARNING');
unlink('D:\\mylogtest.txt.DEBUG');
unlink('D:\\mylogtest.txt.NOTICE');
unlink('D:\\mylogtest.txt.NOTICE');
 */
