<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-6.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
    <div class="header">
        <div id="head_banner">
            Charts
            <p>
            Chart update of the most player tracks right now 
            </p> 
        </div>
        <div id="user_account">
           <button>
           <a class="nav-link" 
            href="../s_login.php">Back</a>
           </button>
        </div>
    </div>
    <div class="container-table100">
			<div class="wrap-table100">
            <div class="table">

<div class="row header">
    <div class="cell">
        *
    </div>
    <div class="cell">
        Tittle
    </div>
    <div class="cell">
        Score
    </div>
    <div class="cell">
        Album
    </div>
    <div class="time">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M7.999 3H6.999V7V8H7.999H9.999V7H7.999V3ZM7.5 0C3.358 0 0 3.358 0 7.5C0 11.642 3.358 15 7.5 15C11.642 15 15 11.642 15 7.5C15 3.358 11.642 0 7.5 0ZM7.5 14C3.916 14 1 11.084 1 7.5C1 3.916 3.916 1 7.5 1C11.084 1 14 3.916 14 7.5C14 11.084 11.084 14 7.5 14Z" fill="currentColor"></path></svg>
    </div>
</div>


<?php
    foreach(range(1,100)as $i);
    $conn = mysqli_connect("localhost", "root", "123456", "nguoi_dung");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql_id = "select * from nguoi_dung.number Order by id asc";
    $sql_select_bxh    = "select * from nguoi_dung.bang_xep_hang ORDER BY score DESC";
    $result_select_bxh = $conn->query($sql_select_bxh);

    if ($result_select_bxh->num_rows > 0) {
        while ($row = $result_select_bxh->fetch_assoc()) {
            echo "<div class=\"row\"><div class=\"cell\" data-title=\"*\">$row[id]</div><div class=\"cell\" data-title=\"Tittle\">  $row[ten_bai_nhac] </div><div class=\"cell\" data-title=\"Score\"> $row[score] </div><div class=\"cell\" data-title=\"album\"> $row[ten_album] </div><div class=\"cell\" data-title=\"time\"> $row[thoi_gian_bnhac] </div></div>";
        }
        echo "</table>";
    } else {
        echo "0 result";
    }
    $query = "SELECT * FROM Album";
    $result2 = mysqli_query($conn, $query);

    $options = "";

    while ($row2 = mysqli_fetch_array($result2)) {
        $options = $options . "<option>$row2[1]</option>";
    }

    $conn->close();

?>
<div class="row">
<div class="cell" data-title="*">
        2
    </div>
    <div class="cell" data-title="Tittle">
        Sing for a song
    </div>
    <div class="cell" data-title="Score">
        1.500.111 pts
    </div>
    <div class="cell" data-title="album">
        Album .......
    </div>
    <div class="cell" data-title="time">
        03:22
    </div>
</div>
</div>
			</div>
		</div>
    
</body>
</html>