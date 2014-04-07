<?php
	class Database
	{
		private $m_sHost =  "mysql1.000webhost.com";
		private $m_sUser = "a8154344_php";
		private $m_sPassword = "Imd123)";
		private $m_sDatabase = "a8154344_imd";
		
		public $conn;

		public function __construct()
		{
			$this->conn = new mysqli($this->m_sHost, $this->m_sUser, $this->m_sPassword, $this->m_sDatabase);
		}
	}
?>