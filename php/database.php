<?php 
	
function connectToDB()
{
	$con = mysql_connect("127.0.0.1:3306", "root", "123456789");
	if (!$con)
	{
		echo "Could not connect: " . mysql_error();
	}
	
	$result = mysql_select_db("bar_db", $con);
	if (!$result) {
		echo "Could not find db: " . mysql_error();
		$con = false;
	}
	return $con;
}

function createItemsTable()
{
	$sql = "create table if not exists Items
	(
		ItemId int NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(ItemId),
		Name varchar(32) NOT NULL,
		Type int NOT NULL,
		Descp varchar(128) DEFAULT '',
		Price decimal(6,2) DEFAULT 0.0,
		Pic varchar(32) DEFAULT ''
	)";
	$result = mysql_query($sql);
	if (!$result) {
		echo "create Items table error: " . mysql_error() . "<br>";
	}
	return $result;
}

function createOrderTable()
{
	$sql = "create table if not exists Transaction
	(
		IdxId int NOT NULL AUTO_INCREMENT,
		PRIMARY KEY(IdxId),
		Combis varchar(128) default '',
		Items varchar(128) default '',
		Price decimal(6,2) NOT NULL,
		TableIdx int default 0
	)";
	$result = mysql_query($sql);
	if (!$result) {
		echo "create Items Transaction error: " . mysql_error() . "<br>";
	}
	return $result;
}


?>