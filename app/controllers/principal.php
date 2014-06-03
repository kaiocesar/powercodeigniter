<?php


class Principal extends CI_Controller {

	public $layout = 'default';

    public $title = 'Code igniter modificado';

	public function index(){
		return $this->load->view('default/home');
	}

}