<!DOCTYPE html>
<html>
<head>
	<title>NFA Acceptance Checker</title>
	<style>
		h3, br {
  			color: black;
  			text-align: left;
			font-family: 'Times New Roman', Times, serif;
			}
		h4, {
			text-align: left;
			}
		body {
			background-color: whitesmoke;
			text-align: center;
			}
		form {
			color: black;
			align-items: center;
			}
		button {
			color: black;
		}
		img {
			display: block;
			width: 100px;
			height: auto;
			align-items: center;
			margin: 0 auto;
		}
		
	</style>
</head>
<body>
	<img src="http://infimux.com/automata/assignments/mid4.jpg">
	
	<h4> <b> NFA Acceptance Checker </b></h4>
	<form method="post">
		<label for="word">Enter a word:</label>
		<input type="text" id="word" name="word" required>
		<button type="submit">Check</button>
	</form>
	
		<h6><b>Nama : Irfah Syagitsyah Iriansu</b></h6>
		<h6>NIM  : 211011060058</h6>
		<a href="https://youtu.be/oUR_jqOuyRA">Link Youtube Irfah Syagitsyah</a>
	<?php
		// Define the NFA transition function
		function transition($state, $symbol)
		{
			switch ($state) {
				case 0:
					if ($symbol == 'a') return array(1);
					if ($symbol == 'b') return array(2);
					break;
				case 1:
					if ($symbol == 'a') return array(1);
					if ($symbol == 'b') return array();
					break;
				case 2:
					if ($symbol == 'a') return array(3);
					if ($symbol == 'b') return array(2);
					break;
				case 3:
					if ($symbol == 'a') return array();
					if ($symbol == 'b') return array(2);
					break;
			}
			return array();
		}

		// Define the NFA acceptance function
		function accept($word)
		{
			$states = array(0);
			foreach (str_split($word) as $symbol) {
				$new_states = array();
				foreach ($states as $state) {
					$new_states = array_merge($new_states, transition($state, $symbol));
				}
				$states = array_unique($new_states);
			}
			return in_array(2, $states) || in_array(3, $states);
		}
		
		// Check the input word for acceptance
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$word = $_POST["word"];
			if (accept($word)) {
				echo "<p>Accepted</p>";
			} else {
				echo "<p>Not accepted</p>";
			}
		}
	?>
</body>
</html>
