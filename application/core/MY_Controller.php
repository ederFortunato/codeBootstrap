<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MY_Controller extends CI_Controller {

	protected $linkBase = '';
	protected $idRecordSet = '';

	/**
	 * Armazena os valores que serão passados para o template
	 * @var array
	 */
	protected $data = array();
	

	protected $layoutFile = 'templates/site_template';

	/**
	 * Construtor
	 */
	public function __construct($layoutFile = null){
		parent::__construct();

		if(!is_null($layoutFile)){
			$this->layoutFile = $layoutFile;
		}

		$this->assign('BASE_URL', base_url() );

		$this->load->library('session');
 


	}
 
 
	/**
	 * Adiciona um valor para ser exibido no template
	 * 
	 * @param string $name
	 * @param mixed $value
	 */
	protected function assign($name, $value){
		$this->data[$name] = $value;
	}
	
	/**
	 * Exibe o resultado de processamento de um template
	 * 
	 * @param string $tpl Indica qual arquivo será usado para o conteudo
	 * @param boolean $return Flag para indicar se o retorno será o conteudo gerado (true) ou sera exibido na tela (false)
	 * @return string
	 */
	protected function display($tpl = null, $return = false){
		if(is_null($tpl)){
			$tpl = $this->layoutFile;
		}
		// so para garantir que a extensao sempre existirá
		$tpl = preg_replace('@\.php$@i', '', $tpl) . '.php';
		$tpl = (empty($this->pastaTpl) ? '' : trim($this->pastaTpl, '/') . '/') . $tpl;

		$this->assign('linkBase', 	 $this->linkBase);
		$this->assign('idRecordSet', $this->idRecordSet);

		$this->data['content'] = $tpl;
		return $this->load->view($this->layoutFile, $this->data, $return);
	}


	protected function echo2($data){
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		exit();	
	}


	
	public function setFeedBack() {

		$msg  = $this->session->flashdata('feedbackMsg');
		$type = $this->session->flashdata('feedbackType');
		
		$this->session->set_flashdata('feedbackMsg', '');
		$this->session->set_flashdata('feedbackType', '');

		$this->assign('feedback', $type);
		$this->assign('msg', $msg);
	}

	public function redirectAndShowMsg($msg, $type, $redirectUrl = '') {

		$this->session->set_flashdata('feedbackMsg', $msg);
		$this->session->set_flashdata('feedbackType', $type);
		redirect($redirectUrl==''?$this->linkBase:$redirectUrl);
	}

	
}