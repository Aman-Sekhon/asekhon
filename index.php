<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Registration</title>
    
</head>

<body>
	<?php

	$firstnameErr = $lastnameErr  = $phoneErr = $emailErr  = NULL;
	$firstname = $lastname  = $phone = $email = $country = $state = NULL;

	$flag = true;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if (empty($_POST["firstname"])) {
			$firstnameErr = "First name is required";
			$flag = false;
		} else {
			$firstname = test_input($_POST["firstname"]);

            if (!preg_match("/^[a-zA-Z-' ]*$/",$firstname)) {
                $firstnameErr = "Only letters and white space allowed";
            }
		}

		if (empty($_POST["lastname"])) {
			$lastnameErr = "Last name is required";
			$flag = false;
		} else {
			$lastname = test_input($_POST["lastname"]);

            if (!preg_match("/^[a-zA-Z-' ]*$/",$firstname)) {
                $lastnameErr = "Only letters and white space allowed";
            }
		}

		if (empty($_POST["phone"])) {
			$phoneErr = "Phone is required";
			$flag = false;
		} else {
			$phone = test_input($_POST["phone"]);
		}

		if (empty($_POST["email"])) {
			$emailErr = "Email is required";
			$flag = false;
		} else {
			$email = test_input($_POST["email"]);

            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
                $flag = false;
            }
		}

		$country = $_POST["country"];
		$state = $_POST["state"];

		// submit form if validated successfully
		if ($flag) {

			$conn = new mysqli('localhost', "Aman", "Amandeep@2", "aman");

			if ($conn->connect_error) {
				die("connection failed error: " . $conn->connect_error);
			}
			
			$sql = "INSERT INTO student (firstname, lastname, phone, email, country, stat) VALUES('$firstname', '$lastname', '$phone', '$email', '$country', '$state') ";

			// execute sql insert
			if ($conn->query($sql) === TRUE) {
				echo "<script> alert('Data saved successfully');</script>";
			}
		}
	}
 
	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"> PHP </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
    	<form action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="card pt-2 mx-auto" style="max-width: 30rem;">
                <div class="card-header">
                    <header>Registration Form</header>
                </div>
                <div class="card-body">
                    <div class="card-text mb-2">
                        First Name* <input type="text" name="firstname" class="form-control" placeholder="First Name" value="<?= $firstname; ?>">
                        <span class="error"> <?= $firstnameErr; ?></span>
                    </div>
                    <div class="card-text mb-2">
                        Last Name* <input type="text" name="lastname" class="form-control" placeholder="Last Name" value="<?= $lastname; ?>">
                        <span class="error"> <?= $lastnameErr; ?></span>
                    </div>
                    <div class="card-text mb-2">
                        Phone* <input type="text" name="phone" class="form-control" placeholder="Please enter your phone" value="<?= $phone; ?>">
                        <span class="error"> <?= $phoneErr; ?></span>
                    </div>
                    <div class="card-text mb-2">
                        Email-id* <input type="text" name="email" class="form-control" placeholder="Please enter your Email id" value="<?= $email; ?>">
                        <span class="error"> <?= $emailErr; ?></span>
                    </div>
                    <div class="card-text mb-2">
                        Country <small>(optional)</small> <input type="text" name="country" class="form-control" placeholder="Please enter your Country" value="<?= $country; ?>">
                    </div>
                    <div class="card-text mb-2" style="background-size: 20px;">
                        <label>State <small>(optional)</small></label> 
                        <select class="form-select" name="state" data-bs-toggle="dropdown">
                            <option value=""> --select state-- </option>
                            <option <?= $state == 'Arunachal Pradesh' ? 'selected' : '' ?> value="Arunachal Pradesh" >Arunachal Pradesh</option>
                            <option <?= $state == 'Assam' ? 'selected' : '' ?> value="Assam" >Assam</option>
                            <option <?= $state == 'Bihar' ? 'selected' : '' ?> value="Bihar" >Bihar</option>
                            <option <?= $state == 'Chandigarh' ? 'selected' : '' ?> value="Chandigarh" >Chandigarh</option>
                            <option <?= $state == 'Delhi' ? 'selected' : '' ?> value="Delhi" >Delhi</option>
                            <option <?= $state == 'Haryana' ? 'selected' : '' ?> value="Haryana" >Haryana</option>
                            <option <?= $state == 'Himachal Pradesh' ? 'selected' : '' ?> value="Himachal Pradesh" >Himachal Pradesh</option>
                            <option <?= $state == 'Madhya Pradesh' ? 'selected' : '' ?> value="Madhya Pradesh" >Madhya Pradesh</option>
                            <option <?= $state == 'Maharashtra' ? 'selected' : '' ?> value="Maharashtra" >Maharashtra</option>
                            <option <?= $state == 'Manipur' ? 'selected' : '' ?> value="Manipur" >Manipur</option>
                            <option <?= $state == 'Mizoram' ? 'selected' : '' ?> value="Mizoram" >Mizoram</option>
                            <option <?= $state == 'Punjab' ? 'selected' : '' ?> value="Punjab" >Punjab</option>
                            <option <?= $state == 'Rajasthan' ? 'selected' : '' ?> value="Rajasthan" >Rajasthan</option>
                            <option <?= $state == 'Sikkim' ? 'selected' : '' ?> value="Sikkim" >Sikkim</option>
                            <option <?= $state == 'Tripura' ? 'selected' : '' ?> value="Tripura" >Tripura</option>
                            <option <?= $state == 'Uttar Pradesh' ? 'selected' : '' ?> value="Uttar Pradesh" >Uttar Pradesh</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer mb-2 btn-lg">
                    <input class="button btn btn-primary" type="submit" name="button">
                </div>
            </div>
        </form>
    </div>
</body>

</html>