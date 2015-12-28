<?php 

//tipe data nya json yah, klo mau xml silahkan ubah sendiri
header('Content-Type: application/json');

require_once "kon.php";
require_once "kry.php"; //load Class KryWebService

$hasil  = array();

$s_name = $_GET['name'];
$s_nip = $_GET['nip'];
$s_API  = $_GET['API'];

$kry = new KryWebService();

if($kry->validateAPI($s_API)){
    
    //kirim params" nya
    $kry->setName($s_name);
    $kry->setNip($s_nip);
    
    $data = $kry->getKry();
    //print_r($data);
    reset($data);
    $i=0;
    //saya pake while, klo mau foreach silahkan :D
    while(list(,$r) =  each($data)){
	
        $hasil[$i]['nama'] = $r->nama;
        $hasil[$i]['nip'] = $r->NIP;
        $hasil[$i]['username'] = $r->username;
        
        ++$i;
    }
   
   //hanya utk flag saja
   //$hasil['status'] = TRUE;
    
}else{
    
    $hasil['status'] = FALSE;
}

echo json_encode($hasil);

?>