# google-custom-search
Search request metadata

The search metadata includes:

    url property, which has information about the OpenSearch template used for the results returned in this request.
    queries property, which is an array of objects describing the characteristics of possible searches. The name of each object in the array is either the name of an OpenSearch query role or one of the two custom roles defined by this API: previousPage and nextPage . Possible query role objects include:
        request: Metadata describing the query for the current set of results.
            This role is always present in the response.
            It is always an array with just one element.
            nextPage: Metadata describing the query to use for the next page of results.
                This role is not present if the current results are the last page. Note: This API returns up to the first 100 results only.
                When present, it is always a array with just one element.
        previousPage: Metadata describing the query to use for the previous page of results.
            Not present if the current results are the first page.
            When present, it is always a array with just one element.



## Requirements

 * PHP version 7.2 or higher

 ## Easy Installation

### Install with composer

To install with [Composer](https://getcomposer.org/), simply require the
latest version of this package.

```bash
composer require abbaiakram/google-custom-search
```


require_once("searchEngine.php");

// instantiate the class
$client = new SearchEngine(); // Pass api key as a parameter or leave empty to use default API.
$client->setEngine('google.ae');
$results = $client->search(['dubai']);


//To iterate over the results, you can do the following,

 if ($results[0]->items) {
        foreach($results[0]->items as $result) {
			
			print $result->title. '<br />';
			print $result->htmlTitle. '<br />';
			print $result->link. '<br />';
			echo $result->htmlSnippet. '<br />';
			print $result->formattedUrl."<br><br>";
            
        }
 }
 
 
 	
// Output Results pagination and rest full data
print '<pre>';
print_r($results[0]->items);
print '</pre>';


