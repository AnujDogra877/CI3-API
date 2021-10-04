<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User');
        // $var1 =  generateToken();
        // print_rr([ $var1, strlen($var1)]);
    }
	public function index()
	{
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        // $allUsers = $this->User->getList();

        //exitWithJson(EXIT_SUCCESS, 'Data Retreived Successfully');
        print_rr([$username, $password], 1);
		// $this->load->view('welcome_message');
	}
	public function test()
	{
        $this->load->library('encrypt');

        $pass = 'Admin$123';
        $encryptedPass = encryptor('encode',$pass);
        print_rr($encryptedPass);
        $encryptedPass = encryptor('decode','RWF4Q2hid29JOThrSDNuSnRsVytKUT091');
        print_rr($encryptedPass, 1);

		// $this->load->view('welcome_message');
	}
}
