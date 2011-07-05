<?php
/**
* SimpleSuggest
*
* A very small suggestion tool that crawls Google search results for a 
* certain query and retrieves the "Did you mean" suggestion, if available.
* 
* SimpleSuggest was created after desperately searching in the 
* Google API for a piece of their spellchecking algorithms. It is hackish,
* crawling using DOMDocument and grabbing a result, but it works until
* Google decides to provide an API for their crazy "Did You Mean" feature.
*
* @author Klaus Silveira <contact@klaussilveira.com>
* @package simplesuggest
* @license http://www.opensource.org/licenses/bsd-license.php BSD License
* @version 0.1
*/
class SimpleSuggest {
	
	/**
	 * Top-level domain name of the preferred Google search
	 * 
	 * @var string
	 */
	public $tld = 'com';
	
	/**
	 * Suggests a new query, if the current one has spelling errors
	 * 
	 * Checks queries against common spellings of each word and 
	 * suggests a new query, using Google's "Did you mean" algorithm
	 * 
	 * @access public
	 * @param string $query Query to be checked
	 * @return mixed Returns the suggestion or false if no suggestion
	 */
	public function suggest($query) {
		$query = str_replace(' ', '+', $query);
		$url = "http://www.google.{$this->tld}/search?q={$query}";
		
		return $this->crawl($url);
	}
	
	/**
	 * Crawl Google results and get the "Did You Mean?" suggestion
	 * 
	 * @access private
	 * @param string $url Address of the page to crawl
	 * @return mixed Returns the suggestion or false if no suggestion
	 */
	private function crawl($url) {
		/**
		 * We need to get rid of all those warnings sent by DOMDocument 
		 * when reading pages with invalid markup
		 */
		libxml_use_internal_errors(true);
		libxml_clear_errors();
		
		/**
		 * Instantiate DOMDocument object and load the page
		 */
		$page = new DOMDocument;
		$page->loadHtmlFile($url);
		
		/**
		 * Find all hyperlinks with spell class and return it's value
		 */
		foreach($page->getElementsByTagName('a') as $link) {
			if($link->getAttribute('class') == 'spell') {
				return $link->nodeValue;
			}
		}
		
		return false;
	}
}
