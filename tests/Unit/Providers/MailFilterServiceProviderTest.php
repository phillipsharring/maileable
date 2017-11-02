<?php

namespace Maileable\Tests\Unit\Providers;

use Maileable\Providers\MailFilterServiceProvider;
use Maileable\Tests\MaileableTestCase;

use Illuminate\Foundation\Application;

class MailFilterServiceProviderTest extends MaileableTestCase
{
    protected $provider;

    public function setUp()
    {
        parent::setUp();

        $this->provider = new MailFilterServiceProvider(new Application(__DIR__));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_boot()
    {
        $this->provider->boot();
        $this->assertTrue(true);
    }

    public function test_register()
    {
        $this->provider->register();
        $this->assertTrue(true);
    }

    public function test_provides()
    {
        $provides = $this->provider->provides();
        $this->assertEquals('Maileable\Mail\Filters\Filter', $provides[0]);
    }
}
