<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 5/9/19
 * Time: 2:36 PM
 */

namespace App\Tests\Controller;

use ApiTestCase\JsonApiTestCase;



class QuoteAPITest extends JsonApiTestCase{

	CONST APP_ID = 'app1';

	public function testGetRandomQuoteResponse()
	{
		$this->loadFixturesFromFile('quotes.yaml');

		$app_id = $this::APP_ID;
		$this->client->request('GET', "http://127.0.0.1:8000/api/quote/random/$app_id");

		$response = $this->client->getResponse();

		$this->assertResponse($response, 'single_quote_generic_response');
	}

	/*
	public function testGetQuotesResponse(){
		$this->loadFixturesFromFile('quotes.yaml');
	}
	*/

}
