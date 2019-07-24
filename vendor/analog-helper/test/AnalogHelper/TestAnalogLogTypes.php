<?php
Debug::log('URGENT - It\'s an emergency', Analog::URGENT);
Debug::log('CRITICAL - Critical conditions', Analog::CRITICAL);
Debug::log('ALERT - Immediate action required', Analog::ALERT);
Debug::log('ERROR - An error occurred', Analog::ERROR);
Debug::log('WARNING - Something unexpected happening', Analog::WARNING);
Debug::log('NOTICE - Something worth noting', Analog::NOTICE);
Debug::log('INFO - Information, not an error', Analog::INFO);
Debug::log('DEBUG - Debugging messages', Analog::DEBUG);
