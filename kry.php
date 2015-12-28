<?php
require_once "kon.php";

class KryWebService{
    
    protected $name;
    protected $nip;
    
    //misal API yg dikasih utk client
    protected $API = 'khss8363621';
    
    public function setName($name){
        
        $this->name = $name;
    }
    public function getName(){
        
        return $this->name;
    }
    
    public function setNip($nip){
        
        $this->nip = $nip;
    }
    public function getnip(){
        
        return $this->nip;
    }
    
    public function validateAPI($api){
        
        if($this->API !== $api)
            return false;
            
        return true;
    }
    
    
    public function getKry(){
					
       $objAr= new ActiveRecord();
       
       /*Query blm pake bind params, silahkan edit sendiri*/
       $sql = "SELECT * FROM karyawan WHERE   ";
          if($this->getName()){
                    
              $sql .=" nama LIKE '%{$this->getName()}%' ";
          }
          if($this->getNip()){

            $sql .=" AND NIP LIKE '%{$this->getNip()}%' ";
          }
		
      return $objAr->fetchObject($sql);
       
    }	
}