<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 5/6/19
 * Time: 3:11 PM
 */

namespace App\Controller\Rest;

use App\Entity\Quote;
use App\Validator\Contraints\QuoteValidator;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as REST;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class QuoteController extends AbstractFOSRestController {

	/**
	 * Retrieves a random Quote resource
	 * @REST\Get("/quote/random/{appId}")
	 */
	public function getRandomQuote(string $appId)
	{
		$em = $this->getDoctrine()->getManager();
		$quotes = $em->getRepository('App:Quote')->findBy(array('app_id'=>$appId));
		$ret = null;
		//todo - move this to SQL for faster results
		if(count($quotes) > 0) {
			$i = rand( 0, count( $quotes ) - 1 );
			$ret = $quotes[$i];
		}

		// In case our GET was a success we need to return a 200 HTTP OK response with the collection of quote object
		return View::create($ret, Response::HTTP_OK);
	}

	/**
	 * Retrieves list of authors
	 * @REST\Get("/quote/{appId}/authors")
	 */
	public function getAuthors(string $appId)
	{
		$em = $this->getDoctrine()->getManager();
		$authors = $em->getRepository('App:Quote')->findAuthors();

		// In case our GET was a success we need to return a 200 HTTP OK response with the collection of quote object
		return View::create($authors, Response::HTTP_OK);
	}

	/**
	 * Creates a Quote resource
	 * @REST\Post("/quote/{appId}")
	 * @param Request $request
	 * @return View
	 */
	public function newQuote(Request $request, string $appId, QuoteValidator $validator)
	{
		$em = $this->getDoctrine()->getManager();
		$quote = new Quote();
		$quote->setText($request->get('text'));
		$quote->setAuthor($request->get('author'));
		$quote->setAppId($appId);

		if($return = $validator->validateQuote($quote)){
			return View::create($return, $return['http_code']);
		}

		$em->persist($quote);
		$em->flush();
		// In case our POST was a success we need to return a 201 HTTP CREATED response
		return View::create($quote, Response::HTTP_CREATED);

	}

	/**
	 * Removes the Quote resource
	 * @REST\Delete("/quote/{appId}/{quoteId}")
	 */
	public function deleteQuote($quoteId, string $appId, QuoteValidator $validator)
	{
		$em = $this->getDoctrine()->getManager();
		$quote = $em->getRepository('App:Quote')->findOneBy(array('id'=>$quoteId,'app_id'=>$appId));

		if($return = $validator->validateQuote($quote)){
			return View::create($return, $return['http_code']);
		}

		$em->remove($quote);
		$em->flush();

		// In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
		return View::create([], Response::HTTP_NO_CONTENT);
	}

	/**
	 * Retrieves a Quote resource
	 * @REST\Get("/quote/{appId}/{quoteId}")
	 */
	public function getQuote($quoteId, string $appId)
	{
		$em = $this->getDoctrine()->getManager();
		$quote = $em->getRepository('App:Quote')->findOneBy(array('id'=>$quoteId,'app_id'=>$appId));

		// In case our GET was a success we need to return a 200 HTTP OK response with the request object
		return View::create($quote, Response::HTTP_OK);
	}

	/**
	 * Retrieves Quotes for a given author
	 * @REST\Get("/quote/{appId}/author/{author}")
	 */
	public function getAuthorQuotes(string $appId, string $author)
	{
		$em = $this->getDoctrine()->getManager();
		$quotes = $em->getRepository('App:Quote')->findBy(array('app_id'=>$appId,'author'=>urldecode($author)));

		// In case our GET was a success we need to return a 200 HTTP OK response with the collection of quote object
		return View::create($quotes, Response::HTTP_OK);
	}

	/**
	 * Retrieves a collection of Quote resource
	 * @REST\Get("/quote/{appId}/")
	 */
	public function getQuotes(string $appId)
	{
		$em = $this->getDoctrine()->getManager();
		$quotes = $em->getRepository('App:Quote')->findBy(array('app_id'=>$appId));
		// In case our GET was a success we need to return a 200 HTTP OK response with the collection of quote object
		return View::create($quotes, Response::HTTP_OK);
	}

	/**
	 * Replaces Quote resource
	 * @REST\Put("/quote/{appId}/{quoteId}")
	 */
	public function putQuote(string $appId, $quoteId, Request $request, QuoteValidator $validator)
	{
		$em = $this->getDoctrine()->getManager();
		$quote = $em->getRepository('App:Quote')->findOneBy(array('id'=>$quoteId,'app_id'=>$appId));
		if ($quote) {
			$quote->setText($request->get('text'));
			$quote->setAuthor($request->get('author'));

			if($return = $validator->validateQuote($quote)){
				return View::create($return, $return['http_code']);
			}

			$em->persist($quote);
			$em->flush();
		}
		// In case our PUT was a success we need to return a 200 HTTP OK response with the object as a result of PUT
		return View::create($quote, Response::HTTP_OK);
	}
}