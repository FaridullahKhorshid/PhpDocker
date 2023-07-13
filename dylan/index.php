<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>stage opdracht crud</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <a class="btn btn-primary" href="create.php" role="button">new</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>firstname</th>
                    <th>lastname</th>
                    <th>email</th>
                    <th>address</th>
                    <th>birthdate</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "mariadb-test";
                $username = "root";
                $password = "root";
                $database = "test";

                $connection = new mysqli($servername, $username, $password, $database);

                if ($connection->connect_error){
                    die("connection failed: " . $connection->connect_error);
                }
                $sql = "SELECT * FROM employee";
                $result = $connection->query($sql);

                if (!$result) {
                    die("invalid query: " . $connection->error);
                }

                while($row = $result->fetch_assoc()){
                    echo"
                    <tr>
                    <td>$row[id]</td>
                    <td>$row[firstname]</td>
                    <td>$row[lastname]</td>
                    <td>$row[email]</td>
                    <td>$row[address]</td>
                    <td>$row[birthdate]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='edit.php?id=$row[id]'>edit</a>
                        <a class='btn btn-danger btn-sm' href='delete.php?id=$row[id]'>delete</a>
                    </td>

                </tr>
                    
                    
                    
                    ";
                }
                ?>
            
            </tbody>
        </table>
    </div>
    
</body>
</html>