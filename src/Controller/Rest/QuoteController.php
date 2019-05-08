<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 5/6/19
 * Time: 3:11 PM
 */

namespace App\Controller\Rest;

use App\Entity\Quote;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as REST;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class QuoteController extends AbstractFOSRestController {

	/**
	 * Creates a Quote resource
	 * @REST\Post("/quote")
	 * @param Request $request
	 * @return View
	 */
	public function newQuote(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$quote = new Quote();
		$quote->setText($request->get('text'));
		$quote->setAuthor($request->get('author'));
		$em->persist($quote);
		$em->flush();

		// In case our POST was a success we need to return a 201 HTTP CREATED response
		return View::create($quote, Response::HTTP_CREATED);
	}

	/**
	 * Removes the Quote resource
	 * @REST\Delete("/quote/{quoteId}")
	 */
	public function deleteQuote($quoteId)
	{
		$em = $this->getDoctrine()->getManager();
		$quote = $em->getRepository('App:Quote')->find($quoteId);
		if ($quote) {
			$em->remove($quote);
			$em->flush();
		}

		// In case our DELETE was a success we need to return a 204 HTTP NO CONTENT response. The object is deleted.
		return View::create([], Response::HTTP_NO_CONTENT);
	}

	/**
	 * Retrieves a Quote resource
	 * @REST\Get("/quote/{quoteId}")
	 */
	public function getQuote($quoteId)
	{
		$em = $this->getDoctrine()->getManager();
		$quote = $em->getRepository('App:Quote')->find($quoteId);
		// In case our GET was a success we need to return a 200 HTTP OK response with the request object
		return View::create($quote, Response::HTTP_OK);
	}

	/**
	 * Retrieves a random Quote resource
	 * @REST\Get("/randomquote/")
	 */
	public function getRandomQuote()
	{
		$em = $this->getDoctrine()->getManager();
		$quotes = $em->getRepository('App:Quote')->findAll();
		//todo - move this to SQL for faster results
		$i = rand(0,count($quotes)-1);

		// In case our GET was a success we need to return a 200 HTTP OK response with the collection of quote object
		return View::create($quotes[$i], Response::HTTP_OK);
	}

	/**
	 * Retrieves a collection of Quote resource
	 * @REST\Get("/quote")
	 */
	public function getQuotes()
	{
		$em = $this->getDoctrine()->getManager();
		$quotes = $em->getRepository('App:Quote')->findAll();
		// In case our GET was a success we need to return a 200 HTTP OK response with the collection of quote object
		return View::create($quotes, Response::HTTP_OK);
	}

	/**
	 * Replaces Quote resource
	 * @REST\Put("/quote/{quoteId}")
	 */
	public function putQuote(int $quoteId, Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$quote = $em->getRepository('App:Quote')->find($quoteId);
		if ($quote) {
			$quote->setText($request->get('text'));
			$quote->setAuthor($request->get('author'));
			$em->persist($quote);
			$em->flush();
		}
		// In case our PUT was a success we need to return a 200 HTTP OK response with the object as a result of PUT
		return View::create($quote, Response::HTTP_OK);
	}

}