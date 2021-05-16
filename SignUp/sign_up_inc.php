<?php
	if(isset($_POST['sign_sub'])){

		include_once '../dbconnect.php';

		$username= mysqli_real_escape_string($conn,$_POST['uid']);
		$email = mysqli_real_escape_string($conn,$_POST['mail']);
		$fullName = mysqli_real_escape_string($conn,$_POST['fname']);
		$password =mysqli_real_escape_string($conn,$_POST['pass']);
		$confirmPassword = mysqli_real_escape_string($conn,$_POST['cpass']);

		if(empty($username) )
			{
				header("Location: ../Signup/sign_up.php?error=emptyfield&uid=&email=".$email);
				exit();
			}
			else if(empty($email)){
				header("Location: ../Signup/sign_up.php?error=emptyfield&email=&username=".$username);
				exit();
			}
			else if (!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
				header("Location: ../Signup/sign_up.php?error=invalidmail&mailusername");
				exit();
			}
			else if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
				{
					header("Location: ../Signup/sign_up.php?error=invalidusername&mail=".$username);
					exit();
				}
			else if (empty($fullName)){
				header("Location: ../Signup/sign_up.php?error=emptyfield&fname=&username=".$username."&mail=".$email);
				exit();
			}
			else if ($password !==$confirmPassword) 
				{
					header("Location: ../Signup/sign_up.php?error=passwordcheckusername=".$username."&email=".$email);
					exit();
				}
			else{
				$sql = "select user_name from tai_khoan where user_name =?";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt,$sql)){
					header("Location: ../Signup/sign_up.php?error=sqlerror");
					exit();
				}
				else{
					mysqli_stmt_bind_param($stmt,"s",$username);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_store_result($stmt);
					$resultCheck = mysqli_stmt_num_rows($stmt);
					if($resultCheck>0){
						header("Location: ../Signup/sign_up.php?error=usertaken&mail=".$email);
						exit();
					}
					else{
						$stmt = mysqli_stmt_init($conn);
						$md5password = md5($password);
						$sql = "Insert into tai_khoan (user_name,pass,full_name,roler,email) values ('$username','$md5password','$fullName','1','$email')";
						mysqli_query($conn, $sql);
						mysqli_stmt_execute();
						header("Location: ../Login/login.php");
						exit();
						
					
					}
				}
			}	
		mysqli_stmt_close($stmt);
		mysqli_close($conn);	
	}
	