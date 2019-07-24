<?php
namespace Analog;
/*
 * instead of including Analog\Analog.php -- require_once dirname(__DIR__).'\analog\Analog.php';
* used following code because in magento class not loaded.
*/
spl_autoload_register(

function($analogLibraryClassName) {
    $analogLibraryFile=dirname(__DIR__).DIRECTORY_SEPARATOR.'analog'.DIRECTORY_SEPARATOR.str_replace('\\', DIRECTORY_SEPARATOR, ltrim($analogLibraryClassName, '\\')).'.php';
    if (file_exists($analogLibraryFile)) {
        require_once $analogLibraryFile;
        return true;
    }
    return false;
});
if (file_exists(dirname(__DIR__).DIRECTORY_SEPARATOR.'analog/Analog/vendor/autoload.php')) {
    require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'analog/Analog/vendor/autoload.php';
}

class AnalogHelper extends Analog {
    const HANDLER_PREFIX='\\Analog\\Handler\\';
    const LOG_FORMAT="%s - %d:%s - %s - %s\%s%s%s-%d \n";
    const CONFIG_FILE_PATH='config/analog-config.ini';
    const NULL_HANDLER='Null';
    const FIREPHP_HANDLER='FirePHP';
    const STDERR_HANDLER='Stderr';
    const CROME_LOGGER_HANDLER='ChromeLogger';
    const VARIABLE_HANDLER='Variable';
    const FILE__HANDLER='File';
    const MULTI_HANDLER='Multi';
    const BUFFER_HANDLER='Buffer';
    const POST_HANDLER='Post';
    const THRESHOLD_HANDLER='Threshold';
    const LEVEL_BUFFER_HANDLER='LevelBuffer';
    const SYSLOG_HANDLER='Syslog';
    const MAIL_HANDLER='Mail';
    const MAIL_HANDLER_NO_REPLY_EMAIL='noreply@sohyper.com';
    const CALLING_FILE_ELEMENT_INDEX=0;
    const CALLING_CLASS_ELEMENT_INDEX=1;
    const BACKTRACE_LOG_DATE_FORMAT='m-d-Y H:i:s';
    const BACKTRACE_LOG_MESSAGE_FORMAT='%s [%s] %s(%s) \t %s %s %s \t ';
    const EMPTY_STRING='';
    const COMMA_SEPARATOR=',';
    const ANALOG_GET_STRUCT_DATE_FORMAT='Y-m-d H:i:s';
    const BACKTRACE_CALLING_FILE_LOG_MESSAGE_FORMAT='%s (%s)';
    const DEFAULT_ERROR_LOG_LEVEL='DEBUG';
    const DEBUG_STACKS_PARAMETER_INDEX=2;
    const FUNCTION_SIGN='()';
    const PSR_DEFAULT_LOG_LEVEL='debug';

    private static $logHandlerName;

    private static $logLevels=array('URGENT', 'ALERT', 'CRITICAL', 'ERROR', 'WARNING', 'NOTICE', 'INFO', 'DEBUG');

    private $logHandler;

    private $logFilePath;

    private $postFilePath;

    private $logVariable;

    private $subHandlerInstance;

    private $logType;

    private $toEmail;

    private $fromEmail;

    private $emailSubject;

    private $analogConfiguration;

    private $handlerResponse;

    private $debugStacks;

    private function __construct() {
        $this->setConfig();
        $this->setSubHandler();
        $this->setHandler();
    }

    private function setConfig() {
        $analogConfiguration=parse_ini_file(self::CONFIG_FILE_PATH, true);
        self::$logHandlerName=$analogConfiguration['handler'];
        $this->logHandler=self::HANDLER_PREFIX.$analogConfiguration['handler'];
        $this->subHandler=isset($analogConfiguration['subHandler'])?self::HANDLER_PREFIX.$analogConfiguration['subHandler']:self::EMPTY_STRING;
        $this->logFilePath=isset($analogConfiguration['logFilePath'])?$analogConfiguration['logFilePath']:self::EMPTY_STRING;
        $this->fromEmail=isset($analogConfiguration['fromEmail'])?$analogConfiguration['fromEmail']:self::EMPTY_STRING;
        $this->toEmail=isset($analogConfiguration['toEmail'])?$analogConfiguration['toEmail']:self::EMPTY_STRING;
        $this->emailSubject=isset($analogConfiguration['emailSubject'])?$analogConfiguration['emailSubject']:self::EMPTY_STRING;
        $this->logType=isset($analogConfiguration['logType'])?array_search($analogConfiguration['logType'], self::$logLevels):self::DEFAULT_ERROR_LOG_LEVEL;
        $this->logVariable=isset($analogConfiguration['logVariable'])?$analogConfiguration['logVariable']:self::EMPTY_STRING;
        $this->postFilePath=isset($analogConfiguration['postFilePath'])?$analogConfiguration['postFilePath']:self::EMPTY_STRING;
    }

    private function setHandler() {
        $handlerClass=$this->logHandler;
        switch (self::$logHandlerName) {
            case self::NULL_HANDLER:
            case self::FIREPHP_HANDLER:
            case self::STDERR_HANDLER:
            case self::CROME_LOGGER_HANDLER:
            $this->handlerResponse=parent::handler($handlerClass::init());
            break;

            case self::VARIABLE_HANDLER:
            $this->handlerResponse=parent::handler($handlerClass::init($GLOBALS[$this->logVariable]));
            break;

            case self::FILE__HANDLER:
            $this->handlerResponse=parent::handler($handlerClass::init($this->logFilePath));
            break;

            case self::MULTI_HANDLER:
            $logPrefix=($this->subHandler==self::FILE__HANDLER)?$this->logFilePath:$this->logVariable;
            foreach (self::$logLevels as $logLevelIndex=>$logLevel) {($this->subHandler==self::FILE__HANDLER)?$this->logFilePath=$logPrefix.$logLevel:$this->logVariable=$logPrefix.$logLevel;
                $this->setSubHandler();
                $multiParameter[$logLevelIndex]=$this->subHandlerInstance;
            }
            $this->handlerResponse=parent::handler($handlerClass::init($multiParameter));
            break;

            case self::BUFFER_HANDLER:
            $this->handlerResponse=parent::handler($handlerClass::init($this->subHandlerInstance));
            break;

            case self::POST_HANDLER:
            $this->handlerResponse=parent::handler($handlerClass::init($this->postFilePath));
            break;

            case self::THRESHOLD_HANDLER:
            case self::LEVEL_BUFFER_HANDLER:
            $this->handlerResponse=parent::handler($handlerClass::init($this->subHandlerInstance, $this->logType));
            break;

            case self::SYSLOG_HANDLER:
            $syslogSubHandler=explode(self::COMMA_SEPARATOR, $this->logVariable);
            $this->handlerResponse=parent::handler($handlerClass::init(current($syslogSubHandler), end($syslogSubHandler)));
            break;

            case self::MAIL_HANDLER:
            $this->handlerResponse=parent::handler($handlerClass::init($this->fromEmail, $this->emailSubject, self::MAIL_HANDLER_NO_REPLY_EMAIL));
            break;

            default:
            $this->handlerResponse=parent::handler();
            break;
        }
    }

    private function setSubHandler() {
        $subHandlerClass=$this->subHandler;
        switch ($this->subHandler) {
            case self::HANDLER_PREFIX.self::VARIABLE_HANDLER:
            $this->subHandlerInstance=$subHandlerClass::init($GLOBALS[$this->logVariable]);
            break;

            case self::HANDLER_PREFIX.self::MAIL_HANDLER:
            $this->subHandlerInstance=$subHandlerClass::init($this->toEmail, $this->emailSubject, $this->fromEmail);
            break;

            case self::HANDLER_PREFIX.self::FILE__HANDLER:
            $this->subHandlerInstance=$subHandlerClass::init($this->logFilePath);
            break;
        }
        return $this->subHandlerInstance;
    }

    public static function getLoggerInstance() {
        static $loggerInstance=null;
        if (null===$loggerInstance) {
            $loggerInstance=new Logger();
        }
        return $loggerInstance;
    }

    public static function psrLog($logMessage, $logLevel=self::PSR_DEFAULT_LOG_LEVEL, $logContext=array()) {
        self::getLoggerInstance()->log($logLevel, $logMessage, $logContext);
    }

    public static function getInstance() {
        static $analogInstance=null;
        if (null===$analogInstance) {
            $analogInstance=new \ Analog\ AnalogHelper();
        }
        return $analogInstance;
    }
    /*
     * log() method is overriding here from parent class (3p class)
    */
    public static function log($logMessage, $logType=Analog::DEBUG) {
        $debugStacks=debug_backtrace(false);
        if (self::$logHandlerName==self::FIREPHP_HANDLER) 
            parent::log(array($logMessage, $debugStacks[self::CALLING_FILE_ELEMENT_INDEX]['file'], $debugStacks[self::CALLING_FILE_ELEMENT_INDEX]['line']), $logType);
        else {
            $logMessage=(is_array($logMessage)||is_object($logMessage))?var_export($logMessage, true):$logMessage;
            $debugStacksInfo=array('file'=>$debugStacks[self::CALLING_FILE_ELEMENT_INDEX]['file'], 'class'=>(isset($debugStacks[self::CALLING_CLASS_ELEMENT_INDEX]['class']))?$debugStacks[self::CALLING_CLASS_ELEMENT_INDEX]['class']:self::EMPTY_STRING, 'type'=>(isset($debugStacks[self::CALLING_CLASS_ELEMENT_INDEX]['type']))?$debugStacks[self::CALLING_CLASS_ELEMENT_INDEX]['type']:self::EMPTY_STRING, 'function'=>(isset($debugStacks[self::CALLING_CLASS_ELEMENT_INDEX]['function']))?$debugStacks[self::CALLING_CLASS_ELEMENT_INDEX]['function']:self::EMPTY_STRING, 'line'=>$debugStacks[self::CALLING_FILE_ELEMENT_INDEX]['line']);
            $debugStacksInfo['function'].=self::FUNCTION_SIGN;
            $parentDefaultFormat=parent::$format;
            parent::$format=self::LOG_FORMAT;
            self::write(self::get_struct($logMessage, $logType, $debugStacksInfo));
            parent::$format=$parentDefaultFormat;
        }
        unset($debugStacks);
    }
    /*
     * write() method is overriding here from parent class (3p class)
    */
    private static function write($struct) {
        $handler=parent::handler();
        return $handler($struct);
    }
    /*
     * get_struct() method is overriding here from parent class (3p class)
    */
    private static function get_struct($message, $levelIndex) {
        $debugStacksInfo=func_get_arg(self::DEBUG_STACKS_PARAMETER_INDEX);
        return array('date'=>gmdate(self::ANALOG_GET_STRUCT_DATE_FORMAT), 'level'=>$levelIndex, 'debugType'=>self::$logLevels[$levelIndex], 'message'=>$message, 'file'=>$debugStacksInfo['file'], 'class'=>$debugStacksInfo['class'], 'type'=>$debugStacksInfo['type'], 'function'=>$debugStacksInfo['function'], 'line'=>$debugStacksInfo['line']);
    }

    private static function handleStackKeys($fileStack, $stackKey) {(!isset($fileStack[$stackKey]))?$fileStack[$stackKey]=self::EMPTY_STRING:null;
        return $fileStack[$stackKey];
    }

    public static function getBacktrace() {
        $logLevelIndex=self::CALLING_FILE_ELEMENT_INDEX;
        $backTraceLog=array();
        $debugStacks=debug_backtrace();
        $backTraceLog[$logLevelIndex]=sprintf(self::BACKTRACE_LOG_MESSAGE_FORMAT, $debugStacks[self::CALLING_FILE_ELEMENT_INDEX]['file'], $debugStacks[self::CALLING_FILE_ELEMENT_INDEX]['line']);
        unset($debugStacks[self::CALLING_FILE_ELEMENT_INDEX]);
        foreach ($debugStacks as $debugStack) {
            $logLevelIndex++;
            foreach ($debugStack as $stackKey=>$stackValue) 
                $debugStack[$stackKey]=self::handleStackKeys($debugStack, $stackKey);
            $backTraceLog[$logLevelIndex]=sprintf(self::BACKTRACE_LOG_MESSAGE_FORMAT, date(self::BACKTRACE_LOG_DATE_FORMAT), $logLevelIndex, $debugStack['file'], $debugStack['line'], $debugStack['class'], $debugStack['type'], $debugStack['function']);
        }
        self::log($backTraceLog);
    }
}
use Analog\ AnalogHelper as Debug;
class_alias('\Analog\AnalogHelper', 'Debug');
$analogHelper=Debug::getInstance();
