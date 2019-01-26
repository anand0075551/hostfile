<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quick_view extends CI_Controller
{

	function __construct(){
		parent:: __construct();
	}
	
	public function quick_view()
	{
		theme('user_dashboard');
	}
}