<?php

namespace Maileable\Tests\Unit\Config;

use Maileable\Tests\MaileableTestCase;

class ConfigTest extends MaileableTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_config_is_an_array()
    {
        $config = include('./src/config/maileable.php');
        $this->assertInternalType('array', $config);
    }
}
