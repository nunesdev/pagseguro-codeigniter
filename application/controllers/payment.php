<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );


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
		$id_reference = $this->newsletter_course($course);
		
		$reference = $id_reference;

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
		
		redirect ( base_url('payment/tanks') );
		
		$transaction = false;

		// Verifica se existe a transação
		if ($this->input->get ( 'transaction_id' )) {
			$transaction = self::TransactionNotification ( $this->input->get ( 'transaction_id' ) );
		}

		// Se a transação for um objeto
		if (is_object ( $transaction )) {
			self::setTransacaoPagseguro($transaction);
		}

		
	}
	
	public function tanks(){
		echo 'obrigado!';
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
	
	
	protected function newsletter_course($course){
		try{
			
			extract($_POST);
			
			
			if(!filter_var($email, FILTER_VALIDATE_EMAIL))
				throw new Exception('Email inválido',1);
			
			$this->load->model('courses/news_model','newsletter_course');
			
			
			$this->newsletter_course->setName($name);
			$this->newsletter_course->setPhone($phone);
			$this->newsletter_course->setEmail($email);
			$this->newsletter_course->setAge($age);
			$this->newsletter_course->setCompany($company);
			$this->newsletter_course->setPost($post);
			$this->newsletter_course->setCouponCode(null);
			$this->newsletter_course->setLocationDate($local_date);
			$this->newsletter_course->setDocument($document);
			$this->newsletter_course->setKnowAs(null);
			$this->newsletter_course->setKnowText(null);
			$this->newsletter_course->setType('subscriber');
			$this->newsletter_course->setCourseId($course->id);
			$this->newsletter_course->setDateCreated(returnNowDB());
			
			
			
			if(!$id = $this->newsletter_course->create())
				throw new Exception('Erro ao cadastrar email, tente novamente!',1);
			
			$course_title = $course->title;	
			
			$data = $_POST;
			$data['course_title'] = $course_title;
			$data['date_send'] = returnNowDB();
			$data['logo'] = base_assets('img/header_logo.png');
			
			$msg = $this->load->view('frontend/emails/inscricao',$data,TRUE);
			
			$NAME_TO  = EMAIL_NAME_TO;
			$EMAIL_TO = EMAIL_TO;
			
			$EMAIL_FROM = EMAIL_FROM;
			
			_coreTool::sendEmailNative($EMAIL_TO,$NAME_TO,$EMAIL_FROM,'Nova inscrição ['.$course_title.']',$msg);
				
			
			$status = 'ok';
			$code   = 0;
			$msg    = 'Dados coletados.';
			$result = true;
			
		}
		
		catch(Exception $e){
			$status = 'fail';
			$code   = $e->getCode();
			$msg    = $e->getMessage();
			$result = false;
		}
		
		if($status == 'ok'){
			return $id;
		}else{
			return false;
		}
	}	
}
