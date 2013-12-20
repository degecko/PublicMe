PublicMe
========

PublicMe is a class that gathers all the public user information that comes bundled with a single HTTP request.

To start using the class, just clone it from the includes folder and add it to your PHP file.
`require 'class.publicme.php';`

And then initialize it
`$user = new PublicMe();`

After that, you simply echo everything you need like this:
`echo "User's Operating System: $user->os";`

Available properties of the class
---

IP
`echo $ip;`

Operating system
`echo $os;`

City
`echo $city;`

If it's using a proxy or not
`echo $proxy;`

Location coordinates
`echo $latlng;`

Region
`echo $region;`

Cookies
`echo $cookies;`

Browser Name
`echo $browser;`

Page referer
`echo $referer;`

Country
`echo $country;`

Internet Service Provider
`echo $provider;`

Timezone
`echo $timezone;`

User agent
`echo $user_agent;`

Country code
`echo $countryCode;`

Remote port from the $_SERVER['REMOTE_PORT'] variable
`echo $remote_port;`

Request URI from the $_SERVER['REQUEST_URI'] variable
`echo $request_uri;`

Accepted languages from the $_SERVER['HTTP_ACCEPT_LANGUAGE'] variable
`echo $accept_lang;`

Query string from the $_SERVER['QUERY_STRING'] variable
`echo $query_string;`

Page request method from the $_SERVER['REQUEST_METHOD'] variable
`echo $page_req_type;`

Page request time from the $_SERVER['REQUEST_TIME'] variable
`echo $page_req_time;`
