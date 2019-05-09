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
		$app_id = $this::APP_ID;
		$this->client->request('GET', "/api/quote/random/$app_id");

		$response = $this->client->getResponse();

		$this->assertResponse($response, 'single_quote_generic_response');
	}

}
