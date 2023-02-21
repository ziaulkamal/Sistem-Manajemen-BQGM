<?php defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view ('partials/header');
$this->load->view ('partials/navbar');
$this->load->view ($page);
$this->load->view ('partials/footer'); 
?>