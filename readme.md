# minimalism service

**apiCaller** is a service for *minimalism* that implements API calls to [{json:api}](https://jsonapi.org) services.

# Requirements

apiCaller requires the following minimalism services:

* minimalism-sercurity (included in *minimalism*)

# Usage

To retrieve the apiCaller service, just load it from the list of minimalism services:

```
$apiCaller = $this->services->service(\carlonicora\minimalism\services\apiCaller\apiCaller::class);
```

To use it, just use the `call` function, which returns a `dataResponse`

```
$apiResponse = $apiCaller->call(
            'PUT', //verb
            'https://api.domain.com', //url
            '/v1.0/endpoint', //endpoint
            ['name' => $name, 'value' => $value] //body
);
```