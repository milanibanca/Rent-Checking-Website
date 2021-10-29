
<?php
    include('db_conn.php');
	
	$result = mysqli_query($con,'CALL uspPreviousMonth()');

	echo "<table>
	<tr>
	<th>First Name</th>
	<th>Surname</th>
	<th>Days since payment</th>
	<th>Next</th>
	<th>Months since payment</th>
	<th>Amount</th>


	</tr>";

	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['surname'] . "</td>";
		echo "<td>" . $row['days since last payment'] . "</td>";
		echo "<td>" . $row['Next payment'] . "</td>";
		echo "<td>" . $row['Months'] . "</td>";
		echo "<td>" . $row['Amount'] . "</td>";

		echo "</tr>";	
	}
	echo "</table>";
	mysqli_close($con);
	echo "<hr/>";
?>