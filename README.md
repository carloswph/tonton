# TonTon PHP

[![PHP Composer](https://github.com/carloswph/tonton/actions/workflows/php.yml/badge.svg)](https://github.com/carloswph/tonton/actions/workflows/php.yml)

Singleton patterns are amongst the most used structures in PHP. Together with that, some similar constructions, such as the Multiton, appear in almost every new PHP project. However, singletons could be much more. Initially, they don't really need to be inserted in any class, several times. Some people use abstracts, but does it make sense, extending a class which is just a support, by definition?

Also, some patterns could be deriving from the Singleton, beyond the Multiton, so that is what we are proposing here:

* First, use Singletons and similar as traits, to avoid duplicates and repetition while coding
* Second, create new and different subpatterns that can elevate the initial purpose of a Singleton to something even more useful

# Installation

TonTon is available as PHP library, being installed through Composer. 

# Usage

Well, for the first two traits, "using" them is pretty much what you need to do. As traits, once they are required with Composer, they can easily be added to any class through the `use` keyword inside the class. The usage is quite simple - let's consider a class named `EasyPeasy`:

```php

require __DIR__ . '/vendor/autoload.php';

class EasyPeasy {

	use \TonTon\Singleton;

	protected function construct() {

		echo 'Easy Peasy!';
	}
}

/* So, if we want to instantiate this class, then we need to use a
   static method. Any new attempts of instantiating the class will
   result in nothing (if we try to use the static method again) or 
   a fatal error, if we try to create an instance through the "new"
   keyword.*/

$ep = EasyPeasy::instance(); // Valid instance
$rt = EasyPeasy::instance(); // Nothing happens, as an instance already exists

$er = new EasyPeasy(); // Fatal error


```
But the Singleton here is just the tip of the iceberg. If you want, by any reason, to have multiple instances of your class, but all of them need to be flagged (let's say one for dealing with queries, and other for logging processes), you'd prefer to use a Multiton instead. The approach will be basically the same:

```php

require __DIR__ . '/vendor/autoload.php';

class EasyPeasy {

	use \TonTon\Multiton;

	protected function construct() {

		echo 'Easy Peasy!';
	}
}

/* So, if we want to instantiate this class, then we need to use a
   static method. Any new attempts of instantiating the class will
   work if using the static method instance(), with a $key as argument
   or a fatal error, if we try to create an instance through the "new"
   keyword.*/

$ep = EasyPeasy::instance('normal'); // Instance 1
$rt = EasyPeasy::instance('log'); // Instance 2

$er = new EasyPeasy(); // Fatal error


```
But let's say, besides using many instances of that class, you want the number of instances to be limit, and you'd like to set this limit while creating your class. That can now be done using the Limiton:


```php

require __DIR__ . '/vendor/autoload.php';

class EasyPeasy {

	use \TonTon\Limiton;

	protected function construct() {

		$this->setLimit(1); // Limit set to 1, so it works like a Singleton,
							// but needs a $key for the new instance. Default
							// value is 2.
		echo 'Easy Peasy!';
	}
}

/* So, if we want to instantiate this class, then we need to use a
   static method. Any new attempts of instantiating the class will
   work if using the static method instance(), with a $key as argument
   or a fatal error, if we try to create an instance through the "new"
   keyword. However, in the Limiton, the number of instances is limited
   by the method setLimit(int).*/

$ep = EasyPeasy::instance('normal'); // Instance 1
$rt = EasyPeasy::instance('log'); // Nothing happens, as we limited the max number
								  // of instances in 1 for this class.

$er = new EasyPeasy(); // Fatal error


```
