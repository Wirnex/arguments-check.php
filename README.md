# arguments-check.php
## Usage
Assume we have some function which takes an array as argument and then reads this array with some keys. In some situations the array may not contain specific keys. This class is to validate an input array passed into the function.
```php
require 'ArgumentsCheck.php';

function feedMeWithAnArray(array $data)
{
	$balance = 0;
	// Using ArgumentsCheck class we describe what array we expect
	ArgumentsCheck::CheckArguments(array('userId', 'sum', 'timestamp'),  $data);
	//
	// here we sure that all arguments were passed to function
	// and we don't need any extra validation code
	$userId  = $data['userId'];
	$balance += $data['sum'];
	$time	 = $data['timestamp'];
}

// calling this function with not exactly what is wants
feedMeWithAnArray(array(
  'userId'=>130,
  'sum'=>1000,
  'timestam'=>'2014-06-29 13:44' // we have mistake here in key "timestam" while the function expects "timestamp"
                                 // <- and here comes an exception
)); 
```

## Run tests
```shell
phpunit test.php
```

## Install
```shell
composer require wirnex/arguments-check
```
