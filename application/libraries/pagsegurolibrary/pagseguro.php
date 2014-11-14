<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'pagsegurolibrary.php';

class Pagseguro
{
	protected $ci;
	private static $email;
	private static $token;
	private static $environment;
	private static $config;
	

	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->config('pagseguro');

		PagSeguroLibrary::init();

		self::$config = $this->ci->config->item('pagseguro');
		
		self::$environment =  self::$config['environment'];
		self::$email       =  self::$config[self::$environment]['pagseguroAccount'];
		self::$token       =  self::$config[self::$environment]['pagseguroToken'];
	}

	private static function getCredentials()
	{
		return new PagSeguroAccountCredentials(self::$email, self::$token);
	}
	
	public static function getPurchaserTest()
	{
		return self::$config[self::$environment]['purchaserTest'];
	}

	private function formatNumber($number,$n = 4) {
		return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
	}

	private function getNotificationType($type)
	{
		$notificationType = new PagSeguroNotificationType($type);
		$strType = $notificationType->getTypeFromValue();

		return $strType;
	}

	private static function transactionNotification($notificationCode)
	{
		try {
			return PagSeguroNotificationService::checkTransaction(self::getCredentials(), $notificationCode);
		} catch (PagSeguroServiceException $e) {
			die($e->getMessage());
		}

	}

	public static function getRetorno($code, $type)
	{
		$this->ci->log_message('error', $code.'|'.$type);
		if($code && $type)
		{
			$notificationType = new PagSeguroNotificationType($type);
			$strType = $notificationType->getTypeFromValue();

			switch ($strType) {
				case 'TRANSACTION':
				return self::transactionNotification($code);
				break;

				default:
				LogPagSeguro::error("Unknown notification type [" . $notificationType->getValue() . "]");
				show_error('PagSeguroLibrary: Unknown notification type [' . $notificationType->getValue() . ']');
				break;
			}
		}
		else
		{
			LogPagSeguro::error("Invalid notification parameters.");
			show_error('PagSeguroLibrary: Invalid notification parameters.');
		}
	}

	public function requestPayment($items, $client, $reference = null, $shipping = null, $redirect = '/', $currency = 'BRL')
	{
		$requestPayment = new PagSeguroPaymentRequest();

		$requestPayment->setCurrency($currency);

		$itemId = 1;
		foreach($items as $item)
		{
			$item['id'] = $this->formatNumber($itemId++);
			$requestPayment->addItem($item);
		}
		
		
		$requestPayment->setReference($reference);

		$requestPayment->setSenderName($client['client_name']);
		$requestPayment->setSenderEmail($client['client_email']);
		$requestPayment->setSenderPhone($client['client_ddd'], $client['client_phone']);

		$requestPayment->setShippingType($shipping['frete']);
		$requestPayment->setShippingCost(0);
		$requestPayment->setShippingAddress(
			$shipping['cep'],
			$shipping['rua'],
			$shipping['numero'],
			$shipping['complemento'],
			$shipping['bairro'],
			$shipping['cidade'],
			$shipping['estado'],
			$shipping['pais']
			);

		$requestPayment->setRedirectURL($redirect);
		$requestPayment->setMaxAge(86400 * 3);

		try
		{
			return $requestPayment->register($this->getCredentials());
		}
		
		catch (PagSeguroServiceException $e)
		{
	   		foreach ($e->getErrors() as $key => $error)
	   		{  
	       			echo $error->getCode();
	       			echo $error->getMessage();
			}	
		}
	}
}


/* End of file pagseguro.php */
/* Location: ./application/libraries/pagseguro.php */
