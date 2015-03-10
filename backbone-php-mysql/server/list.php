<?php  

	include "config.php";

	if($_GET['full_name'])
	{
		$full_name = $_GET['full_name'];
                $query = "SELECT * FROM contacts WHERE full_name = '$full_name' ORDER BY id DESC";

	}
	else
	{
                $query = "SELECT * FROM contacts ORDER BY id DESC";
		
	}

		
	


	$contacts = array();

	


	$result = mysql_query($query);

	while($row = mysql_fetch_array($result)):
		$contacts[] = array(
			'id' => $row['id'],
			'full_name' => $row['full_name'], 
                        'email' => $row['email'], 
                        'phone' => $row['phone'], 
                        'address' => $row['address']
		);

	endwhile;

echo json_encode($contacts);

?>

