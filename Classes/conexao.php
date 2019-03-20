<?php
header('Content-Type: text/html; charset=utf-8');
class Banco
{
    
    
	private $host;
	private $user;
	private $password;
	private $database;
	private $status;
	public $con;
	
	public function __construct()
	{
		$this->Conectar();
	}
	
	private function Conectar()
	{

            
                $this->host = "localhost";
		$this->user = "root";
		$this->password = "";
		$this->database = "bancohoras";
            
                
		$this->con = mysqli_connect($this->host, $this->user, $this->password, $this->database) or die(mysqli_error());
		
                 mysqli_query($this->con,"SET NAMES 'utf8'");
                 mysqli_query($this->con,'SET character_set_connection=utf8');
                 mysqli_query($this->con,'SET character_set_client=utf8');
                 mysqli_query($this->con,'SET character_set_results=utf8');
               
                
		if($this->con)
		{		
               
			$this->status = true;
		}
		else
		{
                  
			$this->status = false;
		}
	}
	
	public function StatusConexao()
	{
       
		return $this->status;
	}
}




?>