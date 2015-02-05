# phplog

By [Joe Fallon](http://blog.joefallon.net)

A simple logging library. It has the following features:

*   Full suite of unit tests.
*   It can be integrated into any existing project.
*   Can be fully understood in just a few moments.
*   Each line of log text contains minimal prefix cruft.
*   Fully [psr/log](https://github.com/php-fig/log) compliant.

## Installation

The easiest way to install PhpDatabase is with
[Composer](https://getcomposer.org/). Create the following `composer.json` file
and run the `php composer.phar install` command to install it.

```json
{
    "require": {
        "joefallon/phplog": "*"
    }
}
```

## Usage

There is one class contained in this library called `Log`. It contains the following methods:

```php
__construct($filePath, $level)
emergency($message, array $context = array())
alert($message, array $context = array())
critical($message, array $context = array())
error($message, array $context = array())
warning($message, array $context = array())
notice($message, array $context = array())
info($message, array $context = array())
debug($message, array $context = array())
log($level, $message, array $context = array())
```

Example log entrys with contexts looks like this:

```
2015-02-05 10:35:20 [DEBUG] Test debug. {"contextKey":"contextVal"}
2015-02-05 10:35:20 [INFO] Test info. {"contextKey":"contextVal"}
2015-02-05 10:35:20 [LOG] Test notice. {"contextKey":"contextVal"}
2015-02-05 10:35:20 [WARN] Test warning. {"contextKey":"contextVal"}
2015-02-05 10:35:20 [ERROR] Test error. {"contextKey":"contextVal"}
2015-02-05 10:35:20 [CRITICAL] Test critical. {"contextKey":"contextVal"}
2015-02-05 10:35:20 [ALERT] Test alert. {"contextKey":"contextVal"}
2015-02-05 10:35:20 [EMERGENCY] Test emergency. {"contextKey":"contextVal"}
2015-02-05 10:35:20 [ALERT] Test off message. {"contextKey":"contextVal"}
```

Example log entrys without contexts looks like this:

```
2015-02-05 10:35:20 [DEBUG] Test debug.
2015-02-05 10:35:20 [INFO] Test info.
2015-02-05 10:35:20 [LOG] Test notice.
2015-02-05 10:35:20 [WARN] Test warning.
2015-02-05 10:35:20 [ERROR] Test error.
2015-02-05 10:35:20 [CRITICAL] Test critical.
2015-02-05 10:35:20 [ALERT] Test alert.
2015-02-05 10:35:20 [EMERGENCY] Test emergency.
2015-02-05 10:35:20 [ALERT] Test off message.
```

### Open Log and Write a Debug Message

```php
$logger = new Log('/tests/logs/' . date('Y-m-d') . '.log', Log::DEBUG);
$logger->debug('Test debug.', array('contextKey' => 'contextVal'));
```
