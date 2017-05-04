<?php 
	
include 'database.php';

if ("addItem" == $_POST['func']) {
	addItem();
}
else if ("buyItems" == $_POST['func']) {
	purchase();
}

function addItem()
{
	$name = trim(htmlspecialchars($_POST["name"]));
	$price = trim(htmlspecialchars($_POST["price"]));
	$type = trim(htmlspecialchars($_POST["type"]));
	$desc = trim(htmlspecialchars($_POST["desc"]));
	$pic = trim(htmlspecialchars($_POST["pic"]));
	
	$con = connectToDB();
	if (!$con)
	{
		echo json_encode(array('error'=>'true','error_code'=>'30','error_msg'=>'设置失败，请稍后重试！'));
		return;
	}
	
	createItemsTable();
	$res = mysql_query("insert into Items (Name, Price, Type, Descp, Pic) 
							values('$name', '$price', '$type', '$desc', '$pic')");
	if (!$res) {
		echo json_encode(array('error'=>'true','error_code'=>'31','error_msg'=>'添加物品失败，请稍后重试！',"sql_error"=>mysql_error()));
		return;
	}
	
	echo json_encode(array('error'=>'false'));
	return;
}

function purchase()
{
	$items = trim(htmlspecialchars($_POST["items"]));
	$price = trim(htmlspecialchars($_POST["price"]));
	$table = trim(htmlspecialchars($_POST["table"]));
	
	$con = connectToDB();
	if (!$con)
	{
		echo json_encode(array('error'=>'true','error_code'=>'30','error_msg'=>'设置失败，请稍后重试！'));
		return;
	}
	
	createOrderTable();
	$res = mysql_query("insert into Transaction (Items, Price, TableIdx)
						VALUES('$items', '$price', '$table')");
	if (!$res) {
		echo json_encode(array('error'=>'true','error_code'=>'1','error_msg'=>'订单插入失败，请稍后重试！'));
		return;
	}
	
	echo json_encode(array('error'=>'false'));
}

?>