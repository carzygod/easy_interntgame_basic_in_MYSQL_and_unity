<?php
error_reporting(E_ALL ^ E_DEPRECATED);
 
	mysql_connect("localhost","username","password") or die('Could not connect: ' . mysql_error());
	mysql_select_db("gamedemo")or die('cao le dou:highscores ' . mysql_error());
	
	//增
	if($_REQUEST['action']=="upload")
	{
		$name = $_REQUEST['name'];
		$positionx = $_REQUEST['positionx'];
		$positiony = $_REQUEST['positiony'];
		$id = $_REQUEST['id'];
		$query = "INSERT INTO `demoa` (`name`,`positionx`,`positiony`,`id`) VALUES ('$name','$positionx','$positiony','id')";
		mysql_query($query);
		echo "Insert " . $positionx . " " . $positiony ;
		
	}
	
	//删，全部
	if($_REQUEST['action']=="delete_all_highscore")
	{
		$query = "DELETE FROM `demo`";
		mysql_query($query);
		echo "Delete All!";
	}
	
	//删，指定
	if($_REQUEST['action']=="delete_highscore")
	{
		$name = $_REQUEST['namea'];
		$query = "DELETE FROM `demo` WHERE `name` = '$name'";
		mysql_query($query)	or die(mysql_error());
		echo "Delete " . $name;
	}
	
	//改，指定
	if($_REQUEST['action']=="update_highscore")
	{
		$positionx = $_REQUEST['positionx'];
		$positiony = $_REQUEST['positiony'];
		$query = "UPDATE `demoa` SET `positionx` = '$positionx' WHERE `positiony` = '$positiony'";
		mysql_query($query)	or die(mysql_error());
		echo "Update " . $positionx . " " . $positiony;
	}
	
	//查
	if($_REQUEST['action']=="show_highscore")
	{
	$query = "SELECT * FROM `demo` ORDER BY `id` DESC";
		$result = mysql_query($query);
		while($array = mysql_fetch_array($result))
		{
			echo $array['id']."</next>";
			echo $array['score']."</next>";
		}
	}
	
	//-----------------------------------------------开始
		//查找最后的ID
	if($_REQUEST['action']=="selec_id")
	{
	$query = "SELECT * FROM `keyconnect` ORDER BY `id` DESC";
		$result = mysql_query($query);
		while($array = mysql_fetch_array($result))
		{
			echo $array['id'];//返回ID，便于增加
		}
	}
	//开房(初始化用户A)//写入所有基础内容
	if($_REQUEST['action']=="begin_the_game")
	{
		$id=$_REQUEST['id']
		$query = "INSERT INTO `keyconnect` (`id`,`active`,`fire_type`,`fire_way`,'set1','set2','set3','set4','set5','set6','set7','set8','set9') VALUES ('$id',0,0,0,0,0,0,0,0,0,0,0,0)";
		mysql_query($query);
		//echo "Insert " . $positionx . " " . $positiony ;
	}
	//加入房间（加载用户B)//修改Active内容
	if($_REQUEST['action']=="active_the_game")
	{
		$id=$_REQUEST['id']
		$query = "UPDATE `keyconnect` SET `active` = '1' WHERE `id` = '$id'";
		mysql_query($query)	or die(mysql_error());
	
	}
	//攻击(	B)
	if($_REQUEST['action']=="attack")
	{
		$id=$_REQUEST['id']
		$fire_type=$_REQUEST['fire_type']
		$fire_way=$_REQUEST['fire_way']
		$query = "UPDATE `keyconnect` SET `fire_type` = '$fire_type' , `fire_way` = '$fire_way' WHERE`id` = '$id'";
		mysql_query($query)	or die(mysql_error());
	
	}
	
	//防守（A）
if($_REQUEST['action']=="protect")
	{
		$id=$_REQUEST['id']
$the_protect_type=$_REQUEST['the_protect_type'];
$the_protect_locate=$_REQUEST['the_protect_locate'];
		$query = "UPDATE `keyconnect` SET `set+$the_protect_locate` = '$the_protect_type' WHERE `id` = '$id'";
		mysql_query($query)	or die(mysql_error());
		echo "Update " . $positionx . " " . $positiony;
	}
	

?>
