# Byscripts Static Entity Bundle

This bundle brings ParamConverter and FormType supports to Symfony 2 for the [StaticEntity library](https://github.com/ByScripts/ByscriptsStaticEntity).

If you just need to use StaticEntity, and don't need the FormType and ParamConverter support, then this bundle is NOT required.

You can use StaticEntity in your project like any other library.

**This 1.x branch supports SensioFrameworkBundle 2.x (Used by Symfony 2.3 Standard Edition)**

For support of SensioFrameworkBundle 3.x (Used by Symfony 2.4+ Standard Edition), use the 2.x branch

## Installation

### Add the package in your composer.json

At command line, run `composer require byscripts/static-entity-bundle:~1.0`

### Enable the Bundle

Add `Byscripts\Bundle\StaticEntityBundle\ByscriptsStaticEntityBundle` to the `app/AppKernel.php` file.

## Usage

### Create a static entity

First, create a static entity on your project (for example, in `src/YourVendorName/YourBundle/StaticEntity`)

```php
<?php

namespace YourVendorName\YourBundle\StaticEntity;

use Byscripts\StaticEntity\StaticEntity;

class Civility extends StaticEntity
{
    private $name;
    private $shortName;

    public static function getDataSet()
    {
        return array(
            'mr' => array('name' => 'Mister', 'shortName' => 'Mr'),
            'mrs' => array('name' => 'Misses', 'shortName' => 'Mrs'),
        );
    }
}
```

For more details on usage of Static Entities, look at [StaticEntity README.md](https://github.com/ByScripts/ByscriptsStaticEntity/blob/master/README.md)

### Use the FormType

```php
$builder->add('civility', 'static_entity', $parameters);
```

#### List of parameters

| class    | required | FQCN of the static entity                       | null      |
| function | optional | The function to use to get SE instances         | getAll    |
| property | optional | The instance property to use as label           | name      |
| group_by | optional | The instance property to use to group labels    | null      |

`static_entity` type extends the native `choice` type and can use any of its options.

### Use the ParamConverter

```php
class MyController
{
    public function myAction(Civility $civility)
    {
        $name = $civility->getName();
    }
}
```

Nothing else to do.
