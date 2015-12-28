<html>
    <head>
       <style>
          body{width:200px}
       </style>
    </head>
    <body>
        
        <h2>KRY Web Service</h2>
        <hr/>
        <form method="get" action="">
            Name  : <input type="text" name="name"/>
            <br>
            NIP  : <input type="text" name="nip"/>
            
            <button type="submit">Search</button>
        </form>
         <?php 
        
            if($_GET){
            
                $s_name= isset($_GET['name']) ? $_GET['name'] : '';
                $s_nip= isset($_GET['nip']) ? $_GET['nip'] : '';

                $url  = "http://".$_SERVER['HTTP_HOST']."/kamal/ss1/s1/web_service.php?API=khss8363621&name={$s_name}&nip={$s_nip}";
                
                $fields = array(
                    'name' => $s_name,
                    'nip' => $s_nip
                );
                
                $data = http_build_query($fields);

                $context = stream_context_create(array(
                    'http' =>  array(
                        'method'  => 'GET',
                        'header'  => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $data,
                    )
                ));

                $result = file_get_contents($url, false, $context);
                //decode json nya ke array
                $vr = json_decode($result,true);
                
                echo "<pre>";
                    print_r($vr);
                echo "</pre>";
				$thedata = new StdClass;
				foreach ($vr as $thedata->isi) {
					foreach ($thedata as $value) {
						echo $value['nama']."<br/>";
						echo $value['nip']."<br/>";
						echo $value['username']."<br/>";
						echo "<br/>";
					}
				}
            }
            
        
        ?>
    </body>
</html>