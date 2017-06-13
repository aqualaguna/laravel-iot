---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)
<!-- END_INFO -->

#general
<!-- START_4e779c96c0f768a6b9f37b353cfa1596 -->
## get All Device from current user
login or Personal Access Key or Access Token required

> Example request:

```bash
curl -X GET "http://localhost/passport/public/api/device" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/passport/public/api/device",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/device`

`HEAD api/device`


<!-- END_4e779c96c0f768a6b9f37b353cfa1596 -->

<!-- START_a815cdd6f24022c016224199e8f63426 -->
## add Device to Device Table
login or Personal Access Key or Access Token required

> Example request:

```bash
curl -X POST "http://localhost/passport/public/api/device" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/passport/public/api/device",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/device`


<!-- END_a815cdd6f24022c016224199e8f63426 -->

<!-- START_da604d1653f6f15b0e75e4c991d6130e -->
## Save Current Last Value seen to The device table
login or Personal Access Key or Access Token required

> Example request:

```bash
curl -X PUT "http://localhost/passport/public/api/device" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/passport/public/api/device",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT api/device`


<!-- END_da604d1653f6f15b0e75e4c991d6130e -->

<!-- START_1154e54320407948d4c6c117f8705ff7 -->
## send command to MQTT Device
login or Personal Access Key or Access Token required

> Example request:

```bash
curl -X POST "http://localhost/passport/public/api/sendcmd" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/passport/public/api/sendcmd",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/sendcmd`


<!-- END_1154e54320407948d4c6c117f8705ff7 -->

