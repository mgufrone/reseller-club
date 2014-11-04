# ResellerClub PHP Api - Usage
Before you go further, please read [ResellerClub Api Documentation](http://manage.resellerclub.com/kb/answer/744). Make sure you follow all of stuff you need to do before make any api call requests.

## Load ResellerClub Class

To run properly of this class, you can do something like this

```php
<?php

$auth_userid = 'your-rc-auth-userid';
$api_key = 'your-rc-api-key';

$rc_api = new \Gufy\ResellerClub\ResellerClub($auth_userid, $api_key);
```

## Get data from ResellerClub

Then, you can do something like this. For example, if you want to get all of domains under your management, you can call API like this :

```php
// first method
$response = $rc_api->from('domains/search')
->where('no-of-records', 50)
->where('page-no', 1)
->where('status', 'Active')
->get();

// second method
$response = $rc_api
->where('no-of-records', 50)
->where('page-no', 1)
->where('status', 'Active')
->get('domains/search')
```


## Post data to ResellerClub

It's almost the same with the code above. The main difference is only the last code you have to call. When you retrieve data, you have to use `get()`, but when you modify something, you will use `post()`. For Example, if you want to modify nameservers on some domain, you should write a code like this :

```php
<?php

$response = $rc_api
->where('order-id', 'order-id-of-domainname')
->where('ns', ['ns1.helloworld.com', 'ns2.helloworld.com'])
->post('domain/modify-ns');
```
