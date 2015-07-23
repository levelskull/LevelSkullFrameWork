<?php
	include_once("MySQLi.01.php");
	include_once("Feed.01.php");
	$cx = array("host"=>"localhost","user"=>"root","pass"=>"","db"=>"lsblog");
	$sql = new MySQLiDL($cx);
	$sql->Open();
	if ($sql->Error->HasErr)
		die($sql->Error->ShowError());
	
	echo $sql->NonQuery("insert into articles (title) values ('Test');");
	if ($sql->Error->HasErr)
		die($sql->Error->ShowError());
	
	echo "<br>";
	$rs = $sql->Query("select * from articles order by nbr desc;");
	$row = $sql->NextRecord();
	print_r($row);
	
	$feed = new Feed($sql,'MySQL');
	echo $feed->Json("select * from articles order by nbr desc;");
?>