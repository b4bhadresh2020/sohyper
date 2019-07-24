<?php
/*
 * handler=Buffer
 * subHandler=File
 * logFilePath=D:\mylogtest.txt
 * logVariable=mylog
 * toEmail=
 * fromEmail=
 * emailSubject=
 * postFilePath=
 * logType=ERROR
 */
// will all be sent as one email instead of three
Debug::log('Message one');
Debug::log('Message two');
Debug::log('Message three');
