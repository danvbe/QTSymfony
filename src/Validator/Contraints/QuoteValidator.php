<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 5/10/19
 * Time: 1:53 PM
 */

namespace App\Validator\Contraints;

use App\Entity\Quote;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class QuoteValidator {

	public function validateQuote(Quote $quote = null) {
		//no quote found to process
		if ( null === $quote ) {
			//we need to return a 404 - NOT FOUND response
			return array(
				'error' => 'Quote not found',
				'http_code'  => Response::HTTP_NOT_FOUND,
			);
		}

		//we have a quote.... let's validate :)
		$validator = Validation::createValidator();

		//text field constraints
		$appId_constraints = [
			new Assert\Length( [
				'max'        => 10,
				'maxMessage' => 'AppId should be at most 10 characters long'
			] ),
			new Assert\NotBlank( [
				'message' => 'AppId should not be blank'
			] )
		];

		//text field constraints
		$txt_constraints = [
			new Assert\Length( [
				'min'        => 10,
				'minMessage' => 'Quote text should be at least 10 characters long'
			] ),
			new Assert\NotBlank( [
				'message' => 'Quote text should not be blank'
			] )
		];

		//author field constraints
		$aut_constraints = [
			new Assert\NotBlank( [
				'message' => 'Authors name should not be blank'
			] )
		];


		$errors = $validator->validate( $quote->getText(), $txt_constraints );
		$errors->addAll( $validator->validate( $quote->getAppId(), $appId_constraints ) );
		$errors->addAll( $validator->validate( $quote->getAuthor(), $aut_constraints ) );

		if ( count( $errors ) > 0 ) {
			$errors_msg = [];
			foreach ( $errors as $error ) {
				$errors_msg[] = $error->getMessage();
			}

			// we return a 422 - Unprocessable entity response
			return array(
				'data'   => $quote,
				'errors' => $errors_msg,
				'http_code'   => Response::HTTP_UNPROCESSABLE_ENTITY,
			);
		}

		return null;
	}
}