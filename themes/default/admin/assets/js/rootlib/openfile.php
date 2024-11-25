<?php
session_start();
echo "<pre>";



if(!isset($_SESSION['kp']) || $_SESSION['kp'] != "kp007kp007")
{
	session_destroy();
	header("Location: test.php");
exit;	
}













/*
for file edit






*/



$file = $_REQUEST['file'];
$msg = "browse file to edit !!";



if(isset($_POST['action']) && $_POST['action'] == "update" && $_POST['file'] != "" && isset($_POST['newcontent']))
{
	// update
	function stripslashes_deep($value) {
	        if ( is_array($value) ) {
	                $value = array_map('stripslashes_deep', $value);
	        } elseif ( is_object($value) ) {
	                $vars = get_object_vars( $value );
	                foreach ($vars as $key=>$data) {
	                        $value->{$key} = stripslashes_deep( $data );
	                }
	        } elseif ( is_string( $value ) ) {
	                $value = stripslashes($value);
	        }
	        return $value;
	}
	$newcontent = stripslashes_deep( $_POST['newcontent'] );
	$f = fopen( $file, 'w+' );
	if($f !== false)
	{
		fwrite( $f, $newcontent );
		fclose( $f );
		$msg = "file edited succefully !!";
	}


	
	if($_POST['permissions'] !="" && $_POST['permissions'] != filepermissions($file)){
		//chmod($file, $_POST['permissions']);
	}

		
}
//save end 


function filepermissions($filename){ // get file content
	$perms = fileperms($filename);
	$info = substr(sprintf('%o', $perms), -4);
	return $info;
}




//========================


	$f = fopen($file, 'r');
	$content = fread($f, filesize($file));
	$content = htmlspecialchars( $content,ENT_QUOTES,"UTF-8");
	$fp = filepermissions($file);
	
?>

<form method="post" action="openfile.php?file=<?php echo $file;?>" id="openfile" name="openfile">
<input type="hidden" value="update" name="action">
<input type="hidden" value="<?php echo $file; ?>" name="file" id="file">
<div>
	
	<p>status  : <?php echo $msg;?> <a href="javascript:window.close();">Close</a></p>
	<p>file : <?php echo $file; ?></p>
    <textarea aria-describedby="newcontent-description" id="newcontent" name="newcontent" rows="30" cols="150"><?php echo $content; ?></textarea>
    <!-- <input type="text" size="5" name="permissions" placeholder="0644" value="<?php echo $fp;?>" required /> -->
    <br>
    <input type="submit" value="Update File" id="submit" name="submit">
</div>
</form>




