<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="modernizr-2.js"></script>
<title>WDV341 Intro PHP - Form Example</title>
<style>
	#test_email{
	display: none;
	}
</style>


</head>

<body>
	<h1>WDV341 Intro PHP</h1>
	<h2>WDV101 Intro HTML and CSS Chapter 9 - Creating Forms - Code Example</h2>
	<p>
		<strong>Basic Form Handler</strong> - This process will display the
		'name = value' pairs for all the elements of a form. This summary will
		on any number of form elements regardless of their name attribute
		value.
	</p>
	<p>
		Use <strong>basicFormExample.php</strong> in the action attribute of
		your form.
	</p>
	<p>
		Field '<strong>name</strong>' - The value of the name attribute from
		the HTML form element.
	</p>
	<p>
		Field <strong>'value</strong>' - The value entered in the field. This
		will vary depending upon the HTML form element.
	</p>
	<form id="form" name="form" method="post" action="formHandler.php">
		<p>
			First Name: <input type="text" name="firstName" id="firstName" />
		</p>
		<p>
			Last Name: <input type="text" name="lastName" id="lastName" />
		</p>
		<p>
			School: <input type="text" name="school" id="school" />
		</p>
		<p>
			<input type="text" name="email" id="test_email" />
		</p>

		<p>
			<input type="radio" name="gender" value="male" checked> Male<br> <input
				type="radio" name="gender" value="female"> Female<br> <input
				type="radio" name="gender" value="other"> Other<br> <br>
		</p>

		<p>
			<select name="car">
				<option name="car" value="volvo">Volvo</option>
				<option name="car" value="saab">Saab</option>
				<option name="car" value="mercedes">Mercedes</option>
				<option name="car" value="audi">Audi</option>
			</select>
		</p>

		<input type="checkbox" name="age" value="Over 21">I am over 21<br>
		<input type="checkbox" name="living" value="Off Campus">I
		live off-campus<br>

		<p>
			<input type="submit" name="button" id="button" value="Submit" /> <input
				type="reset" name="button2" id="button2" value="Reset" />
		</p>
	</form>

	<p>&nbsp;</p>
</body>

</html>
