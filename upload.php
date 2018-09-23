 <?php   
include 'codigo.php'; 
 $output = '';  
 if(isset($_FILES['file']['name'][0]))  
 {  
      //echo 'OK';  
 	  $values = $_FILES['file']['name'];

           if(move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $values))  
           {  
                $output .= '<div class=col-md-3"><img src="upload/'.$values.'" class="img-responsive" /></div>';  
           }  
    
 }  
 echo $output;  
 ?>  