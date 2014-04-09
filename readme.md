ScubaClick Meta
===============

Trait and model to attach meta data to Eloquent models.
Still being developed for [ScubaClick](http://scubaclick.com), so handle with care for now!

Stable Version
--------------
v1.0

General Installation
--------------------

Install by adding the following to the require block in composer.json:
```
"scubaclick/meta": "1.*"
```

Then run `composer update`.

Run Migrations
--------------

```
php artisan migrate --package="scubaclick/meta"

```

Usage
-----

Add the trait to all models that you want to attach meta data to:

```php
use Illuminate\Database\Eloquent\Model;

class SomeModel extends Model
{
    use \ScubaClick\Meta\MetaTrait;

    // model methods
}
```

Then use like this:

```php
$model = SomeModel::find(1);
$model->getAllMeta();
$model->getMeta('some_key');
$model->updateMeta('some_key', 'New Value');
$model->deleteMeta('some_key');
$model->deleteAllMeta();
$model->addMeta('new_key', ['First Value']);
$model->appendMeta('new_key', 'Second Value');
```

License
-------

ScubaClick Meta is licenced under the MIT license.
