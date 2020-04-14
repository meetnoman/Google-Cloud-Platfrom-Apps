<html>
  <body>
      <?php
	  session_start();
	  ?>
	
	
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	 
    <label for=" "><b>Change Name</b></label>
    <input type="text" placeholder="Your Name.." name="name" required>
	  
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
  $key = $datastore->key('user', 's3394026');
  
	
 

	
	  if(isset($_POST["submit"])){
	  
		if($_POST["name"]!=""){
			$transaction = $datastore->transaction();
			$key = $datastore->key('user',   $_SESSION["userId"]);
			$task = $transaction->lookup($key);
			$task['Name'] = $_POST["name"];
			$transaction->update($task);
			$transaction->commit();

			
		}
		else{
			echo "User name cannot be empty ";
		}
	  }
	
	
	
    ?>
	
	
	
	
  </body>
</html>