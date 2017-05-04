<?php

$item = $_GET["items"];
$price = $_GET["price"];
$table = $_GET['table'];
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
			
			function placeOrder()
			{
				var method = $("input[name='method']:checked").val();
				var items = document.getElementById("list").value;
				var price = document.getElementById("price").value;
				var table = document.getElementById("table").value;
				if (method == 1) {
					alert("微信支付还没有做好呢！");
				}
				else if (method == 2) {
					alert("支付宝当然也没有做好！");
				}
				else if (method == 3) {
					$.post("../php/item.php", {"func":"buyItems","list":items,"price":price,"table":table}, function(data){
					
						if (data.error == "false") {
							alert("下单成功！");	
							location.href = "barOrder.php";
						}
						else {
							alert("下单失败: " + data.error_msg);
						}
					}, "json");

				}
			}
		</script>
	</head>
	
	<body style="height: 100%;">
		<p>总计消费： <b>¥ <?php echo $price; ?></b></p>
		<p>桌号： <b><?php echo $table; ?></b></p>
		<input type="hidden" id="list" value="<?php echo $item; ?>" />
		<input type="hidden" id="price" value="<?php echo $price; ?>" />
		<input type="hidden" id="table" value="<?php echo $table; ?>" />
		<input type="radio" id="1" name="method" value="1" /> 微信支付
		<br>
		<input type="radio" id="2" name="method" value="2" /> 支付宝支付
		<br>
		<input type="radio" id="3" name="method" value="3" checked />	付毛线，老板快上酒，货到付款
		<br>
		<hr>
		<input type="button" value="下单" onclick="placeOrder()" />
    </body>
</html>