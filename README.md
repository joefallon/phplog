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

There is one class contained in this library: `Log` 

```php
$logger = new Log('/tests/logs/' . date('Y-m-d') . '.log', Log::DEBUG);
$logger->debug('Test debug.', array('contextKey' => 'contextVal'));
```
