PublicMe
========

PublicMe is a class that gathers all the public user information that comes bundled with a single HTTP request.

To start using the class, just clone it from the includes folder and add it to your PHP file.
```
require 'class.publicme.php';
```

And then initialize it
```
$user = new PublicMe();
```

After that, you simply echo everything you need like this:
```
echo "User's Operating System: $user->os";
```

Available properties of the class
---

IP
```
public $ip
```


Operating system
```
public $os
```


City
```
public $city
```


If it's using a proxy or not
```
public $proxy
```


Location coordinates
```
public $latlng
```


Region
```
public $region
```


Cookies
```
public $cookies
```


Browser Name
```
public $browser
```


Page referer
```
public $referer
```


Country
```
public $country
```


Internet Service Provider
```
public $provider
```


Timezone
```
public $timezone
```


User agent
```
public $user_agent
```


Country code
```
public $countryCode
```


Remote port from the `$_SERVER['REMOTE_PORT']` variable
```
public $remote_port
```


Request URI from the `$_SERVER['REQUEST_URI']` variable
```
public $request_uri
```


Accepted languages from the `$_SERVER['HTTP_ACCEPT_LANGUAGE']` variable
```
public $accept_lang
```


Query string from the `$_SERVER['QUERY_STRING']` variable
```
public $query_string
```


Page request method from the `$_SERVER['REQUEST_METHOD']` variable
```
public $page_req_type
```


Page request time from the `$_SERVER['REQUEST_TIME']` variable
```
public $page_req_time;
```
