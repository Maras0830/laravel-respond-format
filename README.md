# Laravel Respond Format
[![CircleCI](https://circleci.com/gh/Maras0830/laravel-respond-format/tree/2.0.svg?style=shield)](https://circleci.com/gh/Maras0830/laravel-respond-format/tree/2.0)
[![Total Downloads](https://img.shields.io/packagist/dt/maras0830/laravel-respond-format.svg?style=flat-square)](https://packagist.org/packages/maras0830/laravel-respond-format)   
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
