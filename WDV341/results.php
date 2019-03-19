<?php

$customer_name = $_SESSION['name'];
$customer_phone = $_SESSION['phone'];
$customer_email = $_SESSION['email'];
$customer_badge = $_SESSION['badge'];
$customer_meals = $_SESSION['meals'];
$customer_role = $_SESSION['role'];
$customer_requests = $_SESSION['requests'];

?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Results Page</title>
</head>
<body>

<h1>Customer Registered</h1>

<table>
<tr>
	<th>Name</th>
	<th>Phone</th>
	<th>Email</th>
	<th>Badge</th>
	<th>Meals</th>
	<th>Role</th>
	<th>Requests</th>
</tr>
<tr>
	<td><?php echo $customer_name ?></td>
	<td><?php echo $customer_phone ?></td>
	<td><?php echo $customer_email ?></td>
	<td><?php echo $customer_badge ?></td>
	<td><?php echo $customer_meals ?></td>
	<td><?php echo $customer_role ?></td>
	<td><?php echo $customer_requests ?></td>

</tr>

</table>

</body>
</html>