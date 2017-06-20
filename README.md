# Laravel Respond Format
In the teamwork always have some different api response, laravel-respond-format integrate some common response to laravel helper, make this to be more simpler and clear.

## Installation
```
$ composer require maras0830/laravel-respond-format ^v2.0
```
or 
```php
"require": {
  "maras0830/laravel-respond-format": "^v2.0" // Add this line
}
```

## Using
```php
return not_found();
```

Example:
Data not fount response
```json
{
  "error": {
    "message": "Data not found.",
    "code": 404,
    "type": "not_found"
  }
}
```

## Document (Not Finish)
