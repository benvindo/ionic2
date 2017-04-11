<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagSeguroController extends Controller
{
    public function getSessionId(){

    	$sessionCode = \PagSeguro\Services\Session::create(
	        \PagSeguro\Configuration\Configure::getAccountCredentials()
	    );

    	return[
    		'session_id' =>  $sessionCode->getResult()
    	];

    }

    public function order(Request $request){

    	$itens = $request->get('itens');
    	$hash  = $request->get('hash');
    	$total = $request->get('total');
    	$token = $request->get('token');

    	$creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();
    	$creditCard->setMode('DEFAULT');
    	$creditCard->setCurrency("BRL");


	   foreach ($itens as $key => $item) {
	       $creditCard->addItems()->withParameters("00$key", $item['name'], 1, $item['value']);
	    }

  		//   	$creditCard->addItems()->withParameters(
		//     '0002',
		//     'Notebook preto',
		//     1,
		//     206.63
		// );

    	$creditCard->setSender()->setName('João Comprador');
		$creditCard->setSender()->setEmail('joao@sandbox.pagseguro.com.br');

		$creditCard->setSender()->setPhone()->withParameters(
		    11,
		    56273440
		);

		$creditCard->setSender()->setDocument()->withParameters(
		    'CPF',
		    '047.075.711-66'
		);

		$creditCard->setSender()->setHash($hash);



		// Set shipping information for this payment request
		$creditCard->setShipping()->setAddress()->withParameters(
		    'Av. Brig. Faria Lima',
		    '1384',
		    'Jardim Paulistano',
		    '01452002',
		    'São Paulo',
		    'SP',
		    'BRA',
		    'apto. 114'
		);

		//Set billing information for credit card
		$creditCard->setBilling()->setAddress()->withParameters(
		    'Av. Brig. Faria Lima',
		    '1384',
		    'Jardim Paulistano',
		    '01452002',
		    'São Paulo',
		    'SP',
		    'BRA',
		    'apto. 114'
		);


		$creditCard->setToken($token);

		$creditCard->setInstallment()->withParameters(1, $total);

		$creditCard->setHolder()->setBirthdate('01/10/1979');
		$creditCard->setHolder()->setName('João Comprador'); // Equals in Credit Card
		$creditCard->setHolder()->setPhone()->withParameters(
		    11,
		    56273440
		);
		$creditCard->setHolder()->setDocument()->withParameters(
		    'CPF',
		    '047.075.711-66'
		);

		try {

		    $result = $creditCard->register(
		        \PagSeguro\Configuration\Configure::getAccountCredentials()
		    );

    		dd($result);

		} catch (Exception $e) {

		    return[
		    	'message' => $e->getMessage(),
		    	'success' => false
		    ];
		    
		}

    }
}
