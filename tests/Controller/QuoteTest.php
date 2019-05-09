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

	/**
	 * @dataProvider provideGetUrls
	 */
	public function testGenericGetRoutes($url){
		$client = self::createClient();
		$client->request('GET', $url);

		//we have it working
		$this->assertTrue($client->getResponse()->isSuccessful());

		//we get 200 code
		$this->assertEquals(200, $client->getResponse()->getStatusCode());

		// asserts that the "Content-Type" header is "application/json"
		$this->assertTrue(
			$client->getResponse()->headers->contains(
				'Content-Type',
				'application/json'
			)
		);
	}

	public function provideGetUrls()
	{
		$app_id = static::APP_ID;
		return [
			["http://127.0.0.1:8000/api/quote/random/$app_id"],    //random quote
			["http://127.0.0.1:8000/api/quote/$app_id/authors"],   //all authors
		];
	}
}