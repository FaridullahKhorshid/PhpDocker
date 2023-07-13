<?php
$servername = "mariadb-test";
$username = "root";
$password = "root";
$database = "test";

$connection = new mysqli($servername, $username, $password, $database);


$firstname= "";
$lastname= "";
$email= "";
$address= "";
$birthdate= "";

$errorMessage = "";
$succesMessage = "";



if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $birthdate = $_POST["birthdate"];

    do{
        if(empty($firstname) || empty($lastname) || empty($email) || empty($address) || empty($birthdate)){
            $errorMessage = "All the fields are required";
            break;
        }
        
        $sql = "INSERT INTO employee (firstname, lastname, email, address, birthdate )".  
               "VALUES('$firstname', '$lastname','$email','$address','$birthdate')";
        $result = $connection->query($sql);

      
        
        if(!$result) {
            $errorMessage = "invalid query:" . $connection->error;
            break;
        }
        
       

        $firstname= "";
        $lastname= "";
        $email= "";
        $address= "";
        $birthdate= "";

        $succesMessage = "Employee added correctly";


        header("location: index.php");
        exit;


    } while (false);

}



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>nieuwe medewerker toevoegen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">

         <?php
           if(!empty($errorMessage)){
            echo"

            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                 <strong>$errorMessage</strong>
                 <button type= 'button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            
            </div>
            ";
           }
          ?>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm3 col-form-label">firstname</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>">
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm3 col-form-label">lastname</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>">
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm3 col-form-label">email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm3 col-form-label">address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>

            </div>
            <div class="row mb-3">
                <label class="col-sm3 col-form-label">birthdate</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="birthdate" value="<?php echo $birthdate; ?>">
                </div>

            </div>
            <?php 
             if(!empty($succesMessage)){
                echo"
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>$succesMessage</strong>
                            <button type= 'button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                
                        </div>
                    </div>
                </div>
                ";
               }

            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">submit</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="/index.php" role="button">cancel</a>
        </form>
       


    </div>      
</body>
</html>