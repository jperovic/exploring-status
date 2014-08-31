exploring-status
================

This bundle aims to help with setting controller's operation status by elimination cumbersome checking of session flash bag.

Installation (via composer)
---

To install StatusBundle with Composer just add the following to your composer.json file:

    {
        // ...
        require: {
            "exploring/status": "dev-master"
        }
    }

Please replace the `dev-master` with some concrete release tag, for example, 1.*

Then run:

    php composer.phar update

And register the bundle within `AppKernel.php`

```php
$bundles = array(
    ....
    new \Exploring\StatusBundle\ExploringStatusBundle(),
);
```

You are ready to roll.

Configuration
---

The bundle configuration is minimalistic. In order for it to work you just need:

```YAML
exploring_status: ~
```

Operation status can be stored either in `session` (default) or `apc`. In order to use `apc` mode, depending of your php version, you might need to install it first.

This can be configured by specifying `engine` config entry:

```YAML
exploring_status:
    engine: apc
```

Setting the operation status:
---

```php
$manager = $this->get('exploring_status.manager');

$fileManager->success('Yey, you did it!');

$fileManager->warning('Ok, everything went ok, but there is something fishy going on here.');

$fileManager->error('Couldn't do it :(');
```

Retrieving the operation status:
---

You can do it from within controller or from `Twig` directly.

<b>PHP:</b>

```php
$manager = $this->get('exploring_status.manager');

// Get first status, if exists
// This returns object of `StatusObject` type
$status = $manager->first();

// Get all status messages
// This returns `array` of `StatusObject` objects
$all = $manager->all();
```

<b>Twig:</b>

```TWIG
{# This prints first status message directly #}
{{ ExploringStatus_First() }}

{# This prints all status messages directly #}
{{ ExploringStatus_All() }}
```

Twig templates can be overridden easily. Please see [the official documentation](http://symfony.com/doc/current/cookbook/bundles/inheritance.html#overriding-resources-templates-routing-etc) for how-to.

Message groups:
---

Status messages can be grouped. In fact, when you set the status message goes to `Default` group by default.

```php
$manager = $this->get('exploring_status.manager');

// This message will go into `happiness` group
$fileManager->success('Yey, you did it!', 'happiness');

// This one goes into `Default`
$fileManager->warning('Ok, everything went ok, but there is something fishy going on here.');

// This one goes into `Fatal`
$fileManager->error('Couldn\'t do it :(', 'Fatal');
```

As for retrieving same rule applies as defined above - you only need to pass group name as argument.

<b>PHP:</b>

```php
// Get first status from group `happiness`
// This returns object of `StatusObject` type
$status = $manager->first('happiness');

// Get all status messages from group `Fatal`
// This returns `array` of `StatusObject` objects
$all = $manager->all('Fatal');
```

<b>Twig:</b>

```TWIG
{# This prints first status message directly #}
{{ ExploringStatus_First('happiness') }}

{# This prints all status messages directly #}
{{ ExploringStatus_All('Fatal') }}
```
