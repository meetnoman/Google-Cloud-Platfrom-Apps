<html>
  <body>
      <?php
	  session_start();
	    
	
   
# Includes the autoloader for libraries installed with composer
require __DIR__ . '/vendor/autoload.php';
  
use Google\Cloud\Datastore\DatastoreClient;
 
  

 putenv('Google_APPLICATION_CREDENTIALS=C:\Users\M Noman\Downloads\s3394026-02cf27ff197e.json');
       
 $datastore = new DatastoreClient(['projectId' => 's3394026']);

# $datastore = new DatastoreClient();
 
	 
	   
  if(isset($_POST["submit"])){
    
	$key = $datastore->Key('user', $_POST["userId"]) ;
	$entity = $datastore->lookup($key);
	
 
	$_SESSION["userId"]=$_POST["userId"];
 
	
 	if (!is_null($entity)) {
      
    
	if($_POST["password"]==$entity["Password"]){
	
    echo("<script> window.location.href = 'main.php';</script>");
	
	 }
	else{
        echo "Password mis Match";
    }
	
    } 	
	else{
	echo "Please provide valid ID Or Password";
	}

    }
    else{
        echo "No button Submit";
    }
    
  
	?>
	
	
    <form  action="login.php" method="post">
 	 
	<label for="uname"><b>User ID</b></label>
    <input type="text" placeholder="Enter Username" name="userId" required>
<br>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
	  
      <div><input type="submit" value="Submit" name="submit"></div>
    </form>
	
	
	
	
	
	
	
	
	
	
  </body>
</html>