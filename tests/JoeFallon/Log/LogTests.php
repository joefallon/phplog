<?php
namespace tests\JoeFallon\Log;

use JoeFallon\KissTest\UnitTest;
use JoeFallon\Log\Log;

class LogTests extends UnitTest
{
    /** @var  string */
    private $_logPath;


    protected function setUp()
    {
        $this->_logPath = BASE_PATH . '/tests/logs/' . date('Y-m-d') . '.log';
    }

    public function test_debug_level()
    {
        $logger = new Log($this->_logPath, Log::DEBUG);
        $logger->debug('Test debug.', array('contextKey' => 'contextVal'));
    }

    public function test_info_level()
    {
        $logger = new Log($this->_logPath, Log::DEBUG);
        $logger->info('Test info.', array('contextKey' => 'contextVal'));
    }

    public function test_notice_level()
    {
        $logger = new Log($this->_logPath, Log::DEBUG);
        $logger->notice('Test notice.', array('contextKey' => 'contextVal'));
    }

    public function test_warning_level()
    {
        $logger = new Log($this->_logPath, Log::DEBUG);
        $logger->warning('Test warning.', array('contextKey' => 'contextVal'));
    }

    public function test_error_level()
    {
        $logger = new Log($this->_logPath, Log::DEBUG);
        $logger->error('Test error.', array('contextKey' => 'contextVal'));
    }

    public function test_critical_level()
    {
        $logger = new Log($this->_logPath, Log::DEBUG);
        $logger->critical('Test critical.', array('contextKey' => 'contextVal'));
    }

    public function test_alert_level()
    {
        $logger = new Log($this->_logPath, Log::DEBUG);
        $logger->alert('Test alert.', array('contextKey' => 'contextVal'));
    }

    public function test_emergency_level()
    {
        $logger = new Log($this->_logPath, Log::DEBUG);
        $logger->emergency('Test emergency.');
    }

    public function test_off_level()
    {
        $logger = new Log($this->_logPath, Log::DEBUG);
        $logger->alert('Test off message.', array('contextKey' => 'contextVal'));
    }
}