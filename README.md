# Maileable

#### This code is in active development with no releases. Please do not use this library yet. This is mainly on github so Paul can read it. Hi Paul!

## About Maileable

Maileable is a library for adding filters to Laravel Mailable messages that can you modify Mailable or Swift_Message objects before they are sent. Think of it as response middleware for email.

The name "Maileable" is a play on on the word "malleable," which, in English, among other things, means "easily influenced; pliable." The goal of this library is to make it easy to change messages before they are sent.

## Why

The examples directory has a couple of few cases, such as making sure the from address has a name and is tidy, prepending branding to the mail subject, or adding or modifying content in the mail body. This last one is better handled with Blade templates, but the concept is demonstrated here. You can modify the email headers. Logging. There's probably more ideas, I'm sure.

Why not just use the event? Flesh this out...

## How

### Installation

Install with [Composer](https://getcomposer.org/).

Add the repository to your `composer.json` file.

```json
{
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/philsown/maileable"
        }
    ]
}
```

Set your `minimum-stability` to `dev`.

```json
{
    "minimum-stability": "dev",
}
```

Install with the require command.

```bash
$ composer require philsown/mailable
```

Add the service provider to your `config/app.php` provider's array.

```php
<?php

return [
    // ...
    'providers' => [
        // ...

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,

        // add Maileable anywhere in here, really
        Maileable\Providers\MailFilterServiceProvider::class,
    ],
    // ...
];
```

Publish the vendor config.

```bash
$ php artisan vendor:publish --provider=Maileable\Providers\MailFilterServiceProvider --tag=config
```

This will create `config/maileable.php`. Edit this file to wire filters to your Mailables. This is explained below.

### Use

The short version steps:

1. Update the Mailable `use` statement to use Maileable's class, sorry :(
1. Make a mail filter using the `make:mailfilter` generator.
1. Flesh out the filter method.
1. Wire the filter in your published vendor config

The less short version:

#### Step 1: Update the Mailable `use` statement in your existing Mailable class

```php
<?php
# app/Mail/YourEmail.php

namespace App\Mail;

// Change this line in your Mailable class
use Maileable\Mail\Mailable;

// everything else is the same
class YourEmail extends Mailable
{
    public function build()
    {
        // the rest of this class is unchanged
    }
}
```

#### Step 2: Use the generator to make a mail Filter

There is a generator for this using this artisan command:

```bash
$ php artisan make:mailfilter YourFilterName
```

This command has no other arguments besides name. This will create a mail filter from a stub in the `app\Mail\Filters` directory, and create that directory if it doesn't already exist.

#### Step 3: Update your Filter class

Choose if you want to filter the `\Swift_Message` class or `Illuminate\Mail\Mailable` class.

If you would like to filter the `\Swift_Message` class, set `$modifies` to 'swift' (or take it out and let it default from the `FilterAbstract`). This is the default and let's you easily tinker with the nuts and bolts of the email message. This filtering happens when the mailer calls `Mailable::runCallbacks`, basically at the very last possible point.

If you want to filter `Illuminate\Mail\Mailable`, set `$modifies` to `'mailable'`. This is useful if you want to use any information contained in the Mailable class, like grabbing the mailable class name or the view. This filtering happens when the when the `Mailable::send` method is called. It's a slightly different method, but I think it's nice to have a choice.

Use the `@param` phpdoc to let your IDE know what the message variable is. 

to flesh out the filter method.

```php
<?php

namespace App\Mail\Filters;

use Maileable\Mail\Filters\FilterAbstract;
use Illuminate\Mail\Mailable;

class CleanUpFromAddress extends FilterAbstract
{
    public $modifies = 'mailable';

    /**
     * Filter
     *
     * @param Mailable $message
     *
     * @return void
     */
    public function filter($message)
    {
        $froms = $message->from;

        foreach ($froms as &$from) {
            if ('contact@mycompany.com' != $from['address'] || !empty($from['name'])) {
                continue;
            }

            $from['name'] = 'My Company';
        }

        $message->from = $froms;
    }
}
```

#### Step. 4 Wire the filter in your published vendor config

Wire the filters to various Mailable classes in the `config/maileable.php` config file. This works by using patterns to select classes, then assigning one or more filters to Mailables that match the pattern.

```php
<?php

return [
    'filters' => [
        'App\Mail\*' => [
            \App\Mail\Filters\ThinkBeforeYouPrint::class,
            \App\Mail\Filters\AddSubjectBranding::class,
        ],
        'App\Mail\Orders\*' => [
            \App\Mail\Filters\ShippingDisclaimer::class,
        ],
        'App\Mail\Newsletter\*' => [
            \App\Mail\Filters\AddUnsubscribeHeaders::class,
        ],
    ],
];
```

## Support and Issues

There's probably tons of problems with this and I've never used it on a Queued message, so... YMMV. But hey, give it a whirl and let me know how it goes or if you need help with anything!

## Contributing

Thank you for your interest! To contribute, please fork this repository and submit a pull request.

## License

Maileable is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
