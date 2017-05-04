<?php

$item = $_GET["items"];
$items = explode("-", $item);

include "php/database.php";
$con = connectToDB();
if (!$con) {
	return;
}
mysql_select_db("bar_db", $con);

$itemArr = array();
$cntArr = array();
for ($i = 0; $i < count($items); ++$i) {
	$found = -1;
	for ($j = 0; $j < count($itemArr); ++$j) {
		if ($items[$i] == $itemArr[$j]) {
			$found = $j;
			break;
		}
	}
	if ($found == -1) {
		$found = count($itemArr);
		$itemArr[$found] = $items["$i"];
		$cntArr[$found] = 1;
	}
	else {
		$cntArr[$found] += 1;
	}
}
$price = 0;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<meta charset="utf-8">
		<title>购物车</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<link rel="stylesheet" type="text/css" href="css/style.css" />
<!-- 		<link rel="stylesheet" type="text/css" href="css/buttons.css" /> -->
		
        <script src="js/jquery-1.8.3.min.js" ></script>
        <script src="js/scripts.js" ></script>
		<script type="text/javascript">
			
			function reduce(btn)
			{
				var idx = parseInt(btn.id);
				var cntEle = document.getElementById("count_" + idx);
				var cnt = parseInt(cntEle.value);
				if (cnt > 0) {
					cnt -= 1;
					cntEle.value = cnt;
					
					var thisPrice = parseInt(document.getElementById("price_" + idx).value);
					var total = parseInt(document.getElementById("total").innerHTML);
					total -= thisPrice;
					document.getElementById("total").innerHTML = total;
				}
			}
			
			function increase(btn)
			{
				var idx = parseInt(btn.id);
				var cntEle = document.getElementById("count_" + idx);
				var cnt = parseInt(cntEle.value);
				cnt += 1;
				cntEle.value = cnt;
				
				var thisPrice = parseInt(document.getElementById("price_" + idx).value);
				var total = parseInt(document.getElementById("total").innerHTML);
				total += thisPrice;
				document.getElementById("total").innerHTML = total;
			}
			
			function goPay()
			{
				var price = parseInt(document.getElementById('total').innerHTML);
				var table = document.getElementById('table').value;
				if (!isValidNum(table)) {
					alert("输入了无效的桌号！");
					return;
				}
				var nTable = parseInt(table);
				if (nTable <= 0) {
					alert("输入了无效的桌号！");
					return;
				}
				
				var str = '';
				var cnt = <?php echo count($itemArr); ?>;
				for (var i = 0; i < cnt; ++i) {
					var item =document.getElementById("id_" + i);
					str += item.value;
					str += "-";
					str += document.getElementById("count_" + i).value;
					if (i != cnt - 1) {
						str += "a";
					}
				}
				location.href = "placeOrder.php?price=" + price + "&items=" + str + "&table=" + table;
			}
		</script>
	</head>
	
	<body style="height: 100%;">
		<?php
			for ($i = 0; $i < count($itemArr); ++$i) {
				$itemId = $itemArr[$i];
				$result = mysql_query("select * from Items where ItemId='$itemId'");
				if (!$result || mysql_num_rows($result) <= 0) {
					continue;
				}
				$row = mysql_fetch_assoc($result);
				$price += $cntArr[$i] * $row["Price"];
		?>
			<div>
				<p id="item_<?php echo $i; ?>" style="display: inline; width: 40%;"><?php echo $row["Name"]; ?></p>
				<input id="id_<?php echo $i; ?>" type="hidden" value="<?php echo $itemId; ?>" />
				<input id="price_<?php echo $i; ?>" type="hidden" value=<?php echo $row["Price"] ?> />
				<input id="<?php echo $i; ?>" type="button" value="-" onclick="reduce(this)" />
		        <input id="count_<?php echo $i; ?>" type="text" value="<?php echo $cntArr[$i]; ?>" />
		        <input id="<?php echo $i; ?>" type="button" value="+" onclick="increase(this)" />
			</div>
		<?php
			}
		?>
		
		<div id="footer1">
			<p>合计： ¥<b id='total'><?php echo $price;  ?></b></p>
			<input type="text" id="table" style="width: 200px;" placeholder="请输入您的桌号！" />
			<input type="button" value="确认订单" style="width: 100px;" onclick="goPay()" />
		</div>
    </body>
</html>