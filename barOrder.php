<?php

include "php/database.php";
$con = connectToDB();
if (!$con) {
	return;
}

mysql_select_db("bar_db", $con);
$result = mysql_query("select * from Items");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta charset="utf-8">
		<title>预定</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<link rel="stylesheet" type="text/css" href="css/style.css" />
<!-- 		<link rel="stylesheet" type="text/css" href="css/buttons.css" /> -->
		
        <script src="js/jquery-1.8.3.min.js" ></script>
        <script src="js/scripts.js" ></script>
		<script type="text/javascript">
			
			$(document).ready(function(){
				
// 				document.getElementById("2").style.color = "red";
				$('div .bar_type').click(function(){
					$(this).css('color','red');
					$('.bar_type').not(this).css('color','black');
					
					var id = $(this).attr('id');
					var block = "block_" + id;
					
					$('.blk_items').css('display', 'none');
					document.getElementById(block).style.display = 'block';
				});
				
				$('div .bar_thing').click(function(){
					
					var itemId = $(this).attr('id');
// 					alert(itemId);
					var cnt = parseInt(document.getElementById("cnt").innerHTML);
					cnt += 1;				
					document.getElementById("cnt").innerHTML = cnt;	
					
					var items = document.getElementById("items").value;
					if (items.length <= 0) {
						items = itemId;
					}
					else {
						items = items + "-" + itemId;
					}
					document.getElementById("items").value = items;
				});
			})
			
			function go()
			{
				var cnt = parseInt(document.getElementById("cnt").innerHTML);
				if (cnt <= 0) {
					alert("购物车里还没有物品！");
					return;
				}
				
				var items = document.getElementById("items").value;
				location.href = "cart.php?items=" + items;
			}
		</script>
	</head>
	
	<body style="height: 100%;">
		<div class="full" style="width: 30%; height: 100%; float: left; border-right: solid 2px green; padding: 0 1% 0 0;" >
			<a class="bar_type" id="1">魅力套餐</a>
			<a class="bar_type" id="2">软饮</a>
			<a class="bar_type" id="3">列饮</a>
			<a class="bar_type" id="4">饮料</a>
			<a class="bar_type" id="5">小吃</a>
		</div>
		<div class="full" style="width: 68%; float: left;" >
			<div class="blk_items" id="block_1" style="display: none;">
				<?php
					if ($result) {
						mysql_data_seek($result, 0);
						while ($row = mysql_fetch_array($result)) {
							if ($row["Type"] == 0) {
				?>
								<div class="bar_thing" id="<?php echo $row["ItemId"]; ?>">
									<div class="blk_img" >
										<img class="item_img" src="pic/icon/<?php echo $row["Pic"]; ?>"></img>
									</div>
									<div class="blk_info">
										<p><?php echo $row["Name"]; ?></p>
										<p>¥<?php echo $row["Price"]; ?></p>
									</div>
								</div>
				<?php
							}
						}
					}
				?>
			</div>
			<div class="blk_items" id="block_2" style="display: block;">
				<?php
					if ($result) {
						mysql_data_seek($result, 0);
						while ($row = mysql_fetch_array($result)) {
							if ($row["Type"] == 1) {
				?>
								<div class="bar_thing" id="<?php echo $row["ItemId"]; ?>">
									<div class="blk_img" >
										<img class="item_img" src="pic/icon/<?php echo $row["Pic"]; ?>"></img>
									</div>
									<div class="blk_info">
										<p><?php echo $row["Name"]; ?></p>
										<p>¥<?php echo $row["Price"]; ?></p>
									</div>
								</div>
				<?php
							}
						}
					}
				?>
			</div>
			<div class="blk_items" id="block_3" style="display: none;">
				<?php
					if ($result) {
						mysql_data_seek($result, 0);
						while ($row = mysql_fetch_array($result)) {
							if ($row["Type"] == "2") {
				?>
								<div class="bar_thing" id="<?php echo $row["ItemId"]; ?>">
									<div class="blk_img" >
										<img class="item_img" src="pic/icon/<?php echo $row["Pic"]; ?>"></img>
									</div>
									<div class="blk_info">
										<p><?php echo $row["Name"]; ?></p>
										<p>¥<?php echo $row["Price"]; ?></p>
									</div>
								</div>
				<?php
							}
						}
					}
				?>
			</div>
			<div class="blk_items" id="block_4" style="display: none;">
				<?php
					if ($result) {
						mysql_data_seek($result, 0);
						while ($row = mysql_fetch_array($result)) {
							if ($row["Type"] == "3") {
				?>
								<div class="bar_thing" id="<?php echo $row["ItemId"]; ?>">
									<div class="blk_img" >
										<img class="item_img" src="pic/icon/<?php echo $row["Pic"]; ?>"></img>
									</div>
									<div class="blk_info">
										<p><?php echo $row["Name"]; ?></p>
										<p>¥<?php echo $row["Price"]; ?></p>
									</div>
								</div>
				<?php
							}
						}
					}
				?>
			</div>
			<div class="blk_items" id="block_5" style="display: none;">
				<?php
					if ($result) {
						mysql_data_seek($result, 0);
						while ($row = mysql_fetch_array($result)) {
							if ($row["Type"] == "4") {
				?>
								<div class="bar_thing" id="<?php echo $row["ItemId"]; ?>">
									<div class="blk_img" >
										<img class="item_img" src="pic/icon/<?php echo $row["Pic"]; ?>"></img>
									</div>
									<div class="blk_info">
										<p><?php echo $row["Name"]; ?></p>
										<p>¥<?php echo $row["Price"]; ?></p>
									</div>
								</div>
				<?php
							}
						}
					}
				?>
			</div>
		</div>
		<div id="footer1">
			<p>已选择： <b id='cnt'>0</b></p>
			<input type="hidden" id="items" />
			<input type="button" value="购物车" style="width: 100px;" onclick="go()" />
		</div>
    </body>
</html>