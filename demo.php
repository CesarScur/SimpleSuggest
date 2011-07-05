<?php

require('SimpleSuggest.class.php');

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
