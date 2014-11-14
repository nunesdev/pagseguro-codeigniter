<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );

/**
   * Payment
   * 
   * @package    MY_Controller
   * @subpackage Payment
   * @author     Bruno Nunes <newjob@brunodev.com.br>
   */
	class Payment extends MY_Controller 
	{
		private $urlCallback;
			
		public function __construct()
		{
			parent::__construct();
			
			$this->urlCallback = base_url('payment/callback');
			
			$this->load->config('pagseguro');
			$this->load->library('pagsegurolibrary/pagseguro', 'pagseguro');
			
		}
		
		public function index()
		{
			/* Página de Retorno */
			extract($_POST);
			
			$urlCallback = $this->urlCallback;
			
			/* Dados Compra */
			$items = array();
			
			$course = getCourse($course_id);
			
			$items[] = array(
					'description' => $course->title,
					'amount' => '1400.00',
					'quantity' => 1
					);
				
			
			$customerTest = pagseguro::getPurchaserTest();
					
			/* Dados Cliente */
			$customer = array();
			$customer['client_name']  =  $customerTest['name'];
			$customer['client_email'] =  $customerTest['email'];
			$customer['client_ddd']   =  $customerTest['ddd'];
			$customer['client_phone'] =  $customerTest['phone']; 
	
			/* Dados Frete */
			$shipping = array();
			
			$shipping['frete']  	  = 3;
			$shipping['cep']    	  = '78280-000';
			$shipping['rua']    	  = 'Av. Getúlio Vargas';
			$shipping['numero'] 	  = '123';
			$shipping['complemento']  = '';
			$shipping['bairro'] 	  = 'Centro';
			$shipping['cidade'] 	  = 'Cuiabá';
			$shipping['estado'] 	  = 'Mato Grosso';
			$shipping['pais'] 		  = 'Brasil';
	
			/* Referência (ID da Compra)*/
			$reference = 1;
	
			/* Gera URL da Pagamento */
			$paymentURL = $this->pagseguro->requestPayment($items, false, $reference, false, $urlCallback);
			//pre($paymentURL,1);
			/* Redireciona para o PagSeguro */
			
			if($paymentURL){
				redirect($paymentURL);
			}
			
		}
		
		public function callback()
		{
			$transaction = false;
	
			// Verifica se existe a transação
			if ($this->input->get ( 'transaction_id' )) {
				$transaction = self::TransactionNotification ( $this->input->get ( 'transaction_id' ) );
			}
	
			// Se a transação for um objeto
			if (is_object ( $transaction )) {
				self::setTransacaoPagseguro($transaction);
			}
			
			
			redirect ( base_url('payment/thanks') );
			
		}
		
		public function thanks(){
			$this->load->view('payment/thanks');
		}
		
		/**
		 * getTransaction
		 *
		 * Método para buscar a transação no pag reguto
		 * @access public
		 * @param PagSeguroTransaction $transaction
		 * @return array
		 */
		public static function getTransaction(PagSeguroTransaction $transaction)
		{
			return array ('reference' => $transaction->getReference (), 'status' => $transaction->getStatus ()->getValue () );
		}
		
		/**
		 * TransactionNotification
		 *
		 * Recupera a transação através de uma notificação
		 * @access private
		 * @param unknown_type $notificationCode
		 * @return Ambigous <a, NULL, PagSeguroTransaction>
		 */
	
		private static function TransactionNotification($notificationCode)
		{
			try
			{
				$transaction = $this->pagseguro->transactionNotification ($notificationCode );	
				
			} catch ( PagSeguroServiceException $e ) {
				die ( $e->getMessage () );
			}
	
			return $transaction;
		} 
		
		
		
	}
?>