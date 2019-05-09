<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 5/9/19
 * Time: 3:05 PM
 */

namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class QuoteTest extends WebTestCase {

	CONST APP_ID = 'app1';

	public function testGetRandomQuote()
	{

		$app_id = static::APP_ID;

		$client = static::createClient();

		$client->request('GET', "/api/quote/random/".$app_id);

		$this->assertEquals(200, $client->getResponse()->getStatusCode());
	}
}