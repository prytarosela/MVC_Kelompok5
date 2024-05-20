<?php
	//include class model
	include ('osghs_mvc\model\model.php');
	
	class controller{
		//variabel public
		public $model;
		
		//inisialisasi awal untuk class
		function __construct(){
			$this->model = new model(); //variabel model merupakan objek baru yang dibuat dari class model
		}
		
		function index(){
			$data = $this->model->selectAll(); //pada class ini (controller), akses variabel model, akses fungsi selectAll (kalo bingung lihat di class model ada fungsi selectAll)
			include ('osghs_mvc\view\view.php'); //memamnggil view.php pada folder view
		}
		
		function view_search(){
			$data = $this->model->selectAll(); 
			include ('osghs_mvc\view\view_search.php');
		}
		
		function __destruct(){
		}
	}
?>

