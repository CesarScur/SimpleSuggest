# SimpleSuggest
A very small suggestion tool that crawls Google search results for a certain query and retrieves the "Did you mean" suggestion, if available.

SimpleSuggest was created after desperately searching in the Google API for a piece of their spellchecking algorithms. It is hackish, crawling using DOMDocument and grabbing a result, but it works until Google decides to provide an API for their crazy "Did You Mean" feature.

## Authors and contributors
* [Klaus Silveira](http://www.klaussilveira.com) (Creator, developer, support)

## License
[New BSD license](http://www.opensource.org/licenses/bsd-license.php)

## Todo
* hope that, one day, Google releases an API for their spellchecker (yes, this lib is some kind of protest)
* error handling can, and should, be improved
* test, test, test

## Using SimpleSuggest
SimpleSuggest couldn't be easier to use. Check it out:

```php
<?php 

/**
 * Simple suggestion
 */
$query = new SimpleSuggest;
echo $query->suggest('cannoon');
echo $query->suggest('simpones');

/**
 * Language-specific
 */
$query = new SimpleSuggest;
$query->tld = 'com.br';
echo $query->suggest('fuxca');

```
