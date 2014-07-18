<?php
namespace JoeFallon\Log;

use Exception;
use Psr\Log\LoggerInterface;

/**
 * @author    Joseph Fallon <joseph.t.fallon@gmail.com>
 * @copyright Copyright 2014 Joseph Fallon (All rights reserved)
 * @license   MIT
 * @package   JoeFallon\Log
 */
class Log implements LoggerInterface
{
    const DEBUG     = 1; // Most Verbose
    const INFO      = 2; // ...
    const NOTICE    = 3; // ...
    const WARN      = 4; // ...
    const ERROR     = 5; // ...
    const CRITICAL  = 6; // ...
    const ALERT     = 7; // ...
    const EMERGENCY = 8; // Least Verbose
    const OFF       = 9; // Nothing at all.

    const LOG_OPEN    = 10;
    const OPEN_FAILED = 20;
    const LOG_CLOSED  = 30;

    /** @var int */
    protected $_status;
    /** @var string */
    protected $_dateForm;
    /** @var int */
    protected $_level;
    /** @var resource */
    protected $_fileHandle;


    /**
     * @param string $filePath  File path to log
     * @param int    $level     Priority
     *
     * @throws Exception
     */
    public function __construct($filePath, $level)
    {
        $this->_status     = self::LOG_CLOSED;
        $this->_dateForm   = 'Y-m-d H:i:s';
        $this->_level      = $level;
        $this->_fileHandle = null;

        if($level == self::OFF)
        {
            return;
        }

        $this->_fileHandle = fopen($filePath, 'a');

        if($this->_fileHandle == true)
        {
            $this->_status = self::LOG_OPEN;
        }
        else
        {
            $this->_status = self::OPEN_FAILED;
            $msg           = "The file could not be opened. Check permissions.";
            throw new Exception($msg);
        }
    }


    /**
     * __destruct
     */
    public function __destruct()
    {
        if($this->_fileHandle == true)
        {
            fclose($this->_fileHandle);

            $this->_status = self::LOG_CLOSED;
        }
    }


    /**
     * System is unusable.
     *
     * @param string $message
     * @param array  $context
     *
     * @return null
     */
    public function emergency($message, array $context = array())
    {
        $this->log(self::EMERGENCY, $message, $context);
    }


    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array  $context
     *
     * @return null
     */
    public function alert($message, array $context = array())
    {
        $this->log(self::ALERT, $message, $context);
    }


    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array  $context
     *
     * @return null
     */
    public function critical($message, array $context = array())
    {
        $this->log(self::CRITICAL, $message, $context);
    }


    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array  $context
     *
     * @return null
     */
    public function error($message, array $context = array())
    {
        $this->log(self::ERROR, $message, $context);
    }


    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array  $context
     *
     * @return null
     */
    public function warning($message, array $context = array())
    {
        $this->log(self::WARN, $message, $context);
    }


    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array  $context
     *
     * @return null
     */
    public function notice($message, array $context = array())
    {
        $this->log(self::NOTICE, $message, $context);
    }


    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array  $context
     *
     * @return null
     */
    public function info($message, array $context = array())
    {
        $this->log(self::INFO, $message, $context);
    }


    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array  $context
     *
     * @return null
     */
    public function debug($message, array $context = array())
    {
        $this->log(self::DEBUG, $message, $context);
    }


    /**
     * Logs with an arbitrary level.
     *
     * @param mixed  $level
     * @param string $message
     * @param array  $context
     *
     * @return null|void
     */
    public function log($level, $message, array $context = array())
    {
        if($this->_level <= $level)
        {
            $linePrefix = $this->getLinePrefix($level);
            $message    = strval($message);
            $strContext = json_encode($context);
            $this->writeLine($linePrefix . $message . ' ' . $strContext . "\n");
        }
    }


    /**
     * writeLine
     *
     * @param string $line
     *
     * @throws Exception
     */
    private function writeLine($line)
    {
        if($this->_level == self::OFF)
        {
            return;
        }

        if($this->_status != self::LOG_OPEN)
        {
            $msg = 'The log file is not open. '
                   . 'Please check that appropriate permissions have been set.';
            throw new Exception($msg);
        }

        if(fwrite($this->_fileHandle, $line) === false)
        {
            $msg = 'The log file could not be written to. '
                   . 'Please check that appropriate permissions have been set.';
            throw new Exception($msg);
        }
    }


    /**
     * getLinePrefix
     *
     * @param int $level
     *
     * @return string
     */
    private function getLinePrefix($level)
    {
        $time = date($this->_dateForm);

        switch($level)
        {
            case self::DEBUG:
                return $time . ' [DEBUG] ';
                break;
            case self::INFO:
                return $time . ' [INFO] ';
                break;
            case self::WARN:
                return $time . ' [WARN] ';
                break;
            case self::ERROR:
                return $time . ' [ERROR] ';
                break;
            case self::CRITICAL:
                return $time . ' [CRITICAL] ';
                break;
            case self::ALERT:
                return $time . ' [ALERT] ';
                break;
            case self::EMERGENCY:
                return $time . ' [EMERGENCY] ';
                break;
            default:
                return $time . ' [LOG] ';
                break;
        }
    }
}
