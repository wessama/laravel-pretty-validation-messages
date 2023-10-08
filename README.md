# Laravel Pretty Validation Messages

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

Laravel Pretty Validation Messages is a Laravel package providing a trait for FormRequests to use translation strings for validation messages.

## Installation

You can install the package via composer:

```bash
composer require wessama/laravel-pretty-validation-messages
```

Or you can just add it to your `composer.json` file:

```json
{
    "require": {
        "wessama/laravel-pretty-validation-messages": "^1.0"
    }
}
```

Otherwise, you can clone the repo and include the trait in your FormRequests manually.

## Usage
After installation, use the `HasPrettyValidationMessages` trait in your FormRequest classes:

```php
// app/Http/Requests/YourFormRequest.php

use WessamA\LaravelPrettyValidationMessages\HasPrettyValidationMessages;

class YourFormRequest extends FormRequest
{
    use HasPrettyValidationMessages;

    // Your rules and other FormRequest logic here...
}
```

Set up your localization strings with keys that match the expected pattern.

The whole point is to not have to write `message()` methods over and over again for every `FormRequest` you have
in your project. Instead, you can plug this trait into any `FormRequest` and have it automatically use the
translation strings you've already defined. 

The trait will look for a translation string with the following pattern:

```
validation.{fqcn}.{field}.{rule}
```
Where `{fqcn}` is the fully qualified class name of the `FormRequest`, `{field}` is the name of the `FormRequest` being validated, and `{rule}` is the name of the validation rule.

For instance, take the following `FormRequest`:

```php
class StoreUserDetailsRequest extends FormRequest
{
    // ...
}
```

Your translation strings would look like this:

```php
// /lang/en/validation.php

return [
        \App\Http\Requests\Form\StoreUserDetails::class => [
            'email' => [
                'required' => 'Email address is required',
                'email'   => 'Email address looks weird, innit?',
                // add more rules here...
            ],
            'password' => [
                'required' => 'Password is required',
                // add more rules here...
            ],
        ],
];
```

## Testing
You can run the tests with:
    
```bash
    composer test
```

## Credits
- Wessam Ahmed

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/wessama/laravel-pretty-validation-messages.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/wessama/laravel-pretty-validation-messages.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/wessama/laravel-pretty-validation-messages
[link-downloads]: https://packagist.org/packages/wessama/laravel-pretty-validation-messages
[link-author]: https://github.com/wessama
