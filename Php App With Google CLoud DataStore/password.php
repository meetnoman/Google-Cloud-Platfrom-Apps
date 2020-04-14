<html>
  <body>
      <?php
	  session_start();
	  ?>
	
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
 	 
	<label for="uname"><b>Old Password</b></label>
    <input type="password" placeholder="Enter old Password" name="old" required>
<br>
    <label for="psw"><b>New Password</b></label>
    <input type="password" placeholder="Enter New Password" name="new" required>
	  
      <div><input type="submit" value="Submit" name="submit"></div>
    </form>
	
	<form action="main.php" method="post">
		<div><input type="submit" value="Back" name="submit"></div>
	</form>
	
	
	
	
	
	
	<?php
    
    require __DIR__ . '/vendor/autoload.php';

  
 use Google\Cloud\Datastore\DatastoreClient;
 
 


 putenv('Google_APPLICATION_CREDENTIALS=s3394026-02cf27ff197e.json');

 $datastore = new DatastoreClient(['projectId' => 's3394026']);
   
   
  
  
	
	 
	  
		
if(isset($_POST["submit"])){
	 
	  if($_POST["old"]!="" && $_POST["new"]!=""){
		
		 
		$key = $datastore->Key('user',   $_SESSION["userId"]) ;
		$entity = $datastore->lookup($key);
 

	if (!is_null($entity)) {
 		if($_POST['old']==$entity["Password"]){
		echo "old Password Matches with stored Password";
		
		 
			$transaction = $datastore->transaction();
			$key = $datastore->key('user',   $_SESSION["userId"]);
			$task = $transaction->lookup($key);
			$task['Password'] = $_POST['new'];
			$transaction->update($task);
			$transaction->commit();

			
		 
		}
	 
		 
	  }
	
 	  }
 	   }
	
    ?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
     
	
	
	
	
  </body>
</html>