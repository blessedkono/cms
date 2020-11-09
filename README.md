# laravel website cms
this for encrypt laravel project 



Installation

## Step 1
Require the package with composer using the following command:
```bash
composer require nextbytetz/website-cms
```
## Step 2
The service provider will automatically get registered. Or you may manually add the service provider in your config/app.php file:

```bash
'providers' => [
    // ...
    Nextbyte\Cms\CmsServiceProvider::class,
];

```

## Step 3
You can publish the config file with this following command:

```bash
php artisan vendor:publish --provider="Nextbyte\Cms\CmsServiceProvider"
```
You can get package updates by simply use composer update

```bash
composer update nextbytetz/website-cms
```


