## Access Log

### URL ENDPOINT

```
http://localhost:8080/project/novaardiansyah/point-of-sale/logging/read_log?path=your_path&date=2023-08-10&token=your_token#end
```

### REQUEST

```
GET
```

### PARAMETER

| Name | Type | Mandatory | Description |
| --- | --- | --- | --- |
| path [trace/lasq/default] | String | Yes | Path file log |
| token | String | Yes | Token |
| date | String | Yes | Date log |

### RESPONSE

```
file_path : C:/point-of-sale/logs/your_path/2023-08-10.log
base_url : http://localhost:8080/project/novaardiansyah/point-of-sale/

2023-08-10 06:54:20 -- Auth::signin() - 1 : {"username":"admin", "token":"random_token"}

2023-08-10 06:54:20 -- Auth::signin() - 2 : {"username":"admin", "token":"random_token"}
```

### RESPONSE FAIL

```
{
  "status": false,
  "message": "You are not allowed to access this page.",
  "error": "invalid-token",
  "csrf": "5e97d2de6f2a74d3b66c6b99a311a465"
}
```

```
{
  "status": false,
  "message": "Log not found, please try again.",
  "error": "file-not-found",
  "csrf": "5e97d2de6f2a74d3b66c6b99a311a465"
}
```