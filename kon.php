<?php
class Koneksi {
    
    //DB name : test
    protected $dns 	= "mysql:host=localhost;dbname=gajikaryawan";     protected $db_user 	= "root";
    protected $db_pass 	= "";
    protected $konek 	= "";
	
    public function getKon() {
		
	try{
			
	  $db = new PDO($this->dns,$this->db_user,$this->db_pass);
	  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  if($db===FALSE){
			
	     throw new Exception("Koneksi Gagal");
				
	  }else{
			
	    $this->konek = $db;
	  }
			
	}catch(Exception $e){
		
	   echo "Error : ".$e->getMessage();
	}

	return $this->konek;
   }
	
    public function closeKon(){
		
	$this->konek = NULL; //diskonek Koneksi
    }
}

/*
Kita sekalian buat Class active record simple
untuk fetch data ke DB */

class ActiveRecord extends Koneksi{
	
    public function fetchObject($sql){
	
	$clone = array();
		
	try{

	   $data =  $this->getKon()->prepare($sql);
	   $data->setFetchMode(PDO::FETCH_INTO,$this);
	   $data->execute(); 

           /* krena fetch ingin sbg Object, 
            maka kita hrus clone hasilnya */
	   while($result = $data->fetch()){
				
		$clone[] = clone $result;
	   }

	   $this->closeKon();
			
	}catch(PDOException $e){
		    
	    echo $e->getMessage();
	}
	
       return $clone;

   }
}