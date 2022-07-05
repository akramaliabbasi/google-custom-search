<?php

/**
 * SearchEngine performs a search using the Google Custom Search API
 *
 * @author Akram Abbasi <mohdakramabbasi@gmail.com>
 * @link https://code.google.com/apis/customsearch/v1/reference.html
 * @link https://developers.google.com/custom-search/v1/reference/rest/v1/cse/list?apix=true
 */
 
namespace Abbaiakram\GoogleCustomSearch;

class searchEngine 
{
	
	// ------------------------------------------------------
    // Constants
    // ------------------------------------------------------

    const API_URL = 'https://www.googleapis.com/customsearch/v1';

    const api_Key  = 'AIzaSyDsF-Ekf2mwvm7KZu7b9aKB8ievDDPkndM';
    const API_CUSTOM_SEARCH_ENGINE_ID = 'cx';
    const API_CUSTOM_SEARCH_ENGINE_SPEC_URL = 'cref';
    const API_LANGUAGE_RESTRICTION = 'lr';
    const API_NUMBER_OF_RESULTS = 'num';
    const API_PRETTYPRINT = 'prettyprint';
    const API_QUERY = 'q';
    const API_SAFE_MODE = 'safe';
    const API_START_INDEX = 'start';
    
    const SAFE_MODE_ACTIVE = 'active';
    const SAFE_MODE_MODERATE = 'moderate';
    const SAFE_MODE_OFF = 'off';
	
	
	/**
     * @var string
     */
    private $apiKey;
	
	/**
     * @var string
     */
    public $engineType;
	
	/**
     * @var string
     */
    public $query;
	
	/**
     * @var string
     */
    protected $safeMode;
		
	/**
     * @var integer
     */
    protected $numberOfResults;
	
	

    // ------------------------------------------------------
    // Constructor
    // ------------------------------------------------------

    /**
     * Creates a new SearchEngine
     *
     * @param string $api
     */
    public function __construct( $api = '' ) 
    {
        if (!empty($api) ) {
            $this->apiKey = $api;
        } else {
            $this->apiKey = self::api_Key ;
		}

    }
	
	
	// ------------------------------------------------------
    // Methods
    // ------------------------------------------------------


    /**
     * Get API Key.
     * 
     * @return string
     */
    private function getAPIKey() 
    {
        if (empty($this->apiKey)) {
            throw new Exception('API Key is required.');
        }

        return $this->apiKey;
        
    }

    /**
     * Set search engine type.
     *
     * @param $name to get engine name.
     * 
     * @return void
     */
    public function setEngine( $name ) 
    {

        if ('google.ae' === $name) {
            $this->engineType = 'ae';
        }
        
        if ('google.com' === $name) {
            $this->engineType = 'us';
        }
    }

    /**
     * Get search engine type.
     * 
     * @return string
     */
    private function getEngine() 
    {
        if (empty($this->engineType)) {
            throw new Exception('Please set search engine. ex: google.ae or google.com');
        }

        return $this->engineType;
        
    }

    /**
     * Validate search query.
     * 
     * @param $query to validate.
     * 
     * @return array
     */
    private function validateQuery( $query ) 
    {
        if (! is_array($query) ) {
            throw new Exception('Pass query as an array.');
        }

        if (is_array($query) && count($query) <= 0 ) {
            throw new Exception('Please pass atleast one query to perform search.');
        }

        return $query;
    }

    /**
     * Start searching.
     *
     * @param $query pass multiple query to search on.
     * 
     * @return $results array.
     */
    public function search($query = array() ) 
    {

        try {
            $data = array();
            $query = $this->validateQuery($query);
            $apiKey  = $this->getAPIKey();
            $engine = $this->getEngine();
            foreach ( $query as $searchTerms ) {                
                array_push( $data, self::curl($apiKey , $searchTerms, $engine) );                
            }

            return $data;
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    /**
     * Connection for API Call.
     *
     * @param $apiKey  string 
     * @param $searchTerms string 
     * @param $search_country string 
     * @param $lang string 
     * 
     * @return $results array.
     */
    private static function curl( $apiKey , $searchTerms, $search_country, $lang = 'en' ) 
    {
		
        $curl = curl_init();
		$url = self::API_URL.'?key='.$apiKey.'&cx=017576662512468239146:omuauf_lfve&q='.$searchTerms.'';
	
        $data = array(            
            'hl' => $lang,
            'q'  => $searchTerms,
            'gl' => $search_country,            
        );

        $request = $url . '?' . http_build_query($data); 

        curl_setopt_array(
            $curl, 
            array(
                CURLOPT_URL => $request,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "X-RapidAPI-Key: " . $apiKey 
                ),
            )
        );

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        if ($error) {
            return $error;
        } else {
            return json_decode($response);
        }
    }
}
