# ResellerClub PHP Api - Framework Integration
In this documents, you can see what framework can use this package natively

## Laravel

Laravel is framework for web artisan. For you who love using this framework, i already provided some Facades and Service Provider. After you run installation phase, you should run this step.

### Modify Service Provider collections

Add this line on your service provider collection located at *app/config/app.php*.

```php
  <?php

  return array(
      'providers'=>array(
        ....
        'Gufy\ResellerClub\ResellerClubServiceProvider', // add this line only
        ....
      ),
  )
```

### Configure ResellerClub API Config

Then, run this command to publish some configuration
```bash
php artisan config:publish gufy/reseller-club
```

It will publish a config file and will be located at *app/config/packages/gufy/reseller-club/config.php*. Modify that file, and input your `auth-userid` and `api-key` from ResellerClub

### Simple usage using facades

For call some Api functionality, try something like this :

```php
  <?php
  $domains = ResellerClub::where('no-of-records', 50)
  ->where('status','Active')
  ->get('domains/search.json');
```


## Yii2

Coming Soon


## Symfony
Coming Soon

## Silex
Coming Soon

## Panada
Coming Soon
