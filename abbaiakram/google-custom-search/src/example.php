<?php require_once("searchEngine.php");

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


?>