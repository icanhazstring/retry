# icanhazstring/retry
Small dependency-less library to retry failing operations

## Installation
```bash
$ composer require icanhazstring/retry
```

## Usage
```php
// retry(callable, retries = 1, sleep = 10);

// call failingMethod, maximum 3 retries, wait 100ms between retires
retry(fn() => failingMethod(), 3, 100);
retry(function() use ($dependency) {
    failingMethod();
}, 3, 100)
```
