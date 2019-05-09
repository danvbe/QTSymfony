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
			["/api/quote/random/$app_id"],    //random quote
			["/api/quote/$app_id/authors"],   //all authors
		];
	}

	public function testPostUpdateDeleteRoutes(){
		$client = self::createClient();
		$app_id = static::APP_ID;
		$url = "/api/quote/$app_id";
		$data = array(
			'author' => 'Anonymous',
			'text' => 'This is a dummy quote',
			'appId' => $app_id,
		);

		$client->request(
			'POST',
			$url,
			$data,
			[],
			[
				'CONTENT_TYPE' => 'application/json',
			]
		);

		//we have it working
		$this->assertTrue($client->getResponse()->isSuccessful());
		//we get 201 code - HTTP CREATED
		$this->assertEquals(201, $client->getResponse()->getStatusCode());

		$response_data = json_decode($client->getResponse()->getContent(),true);

		//we get the saved data
		$this->assertTrue(($data['author'] == $response_data['author'])
		                  && ($data['appId'] == $response_data['appId']) &&
		                  ($data['text'] == $response_data['text']));

		$id = $response_data['id'];

		//LET's UPDATE the entity
		$data = array(
			'author' => 'Anonymous',
			'text' => 'This is a dummy quote - updated',
			'appId' => $app_id,
		);
		$url = "/api/quote/$app_id/$id";
		$client->request(
			'PUT',
			$url,
			$data,
			[],
			[
				'CONTENT_TYPE' => 'application/json',
			]
		);

		//we have it working
		$this->assertTrue($client->getResponse()->isSuccessful());
		//we get 200 code - HTTP OK
		$this->assertEquals(200, $client->getResponse()->getStatusCode());

		$response_data = json_decode($client->getResponse()->getContent(),true);

		//we get the saved data
		$this->assertTrue(($data['author'] == $response_data['author'])
		                  && ($data['appId'] == $response_data['appId']) &&
		                  ($data['text'] == $response_data['text']));

		//LET's DELETE the entity
		$url = "/api/quote/$app_id/$id";
		$client->request(
			'DELETE',
			$url,
			[],
			[],
			[
				'CONTENT_TYPE' => 'application/json',
			]
		);

		//we have it working
		$this->assertTrue($client->getResponse()->isSuccessful());
		//we get 204 code - HTTP NO CONTENT
		$this->assertEquals(204, $client->getResponse()->getStatusCode());
	}
}