<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <title>My Guests App</title>

</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Page 1</a></li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
    <div class = "container">
        <div class = "row">
            <div class = "col-md-12">
                <h1>My Guests</h1>

                <?php
   //echo session_id();
    if(isset($_SESSION['message'])) {

        if($_SESSION['message'] == 'addguest') {
            echo '<div class="alert alert-success">
            <strong>Success!</strong> Guest Added.
            </div>';
        }
            if($_SESSION['message'] == 'updateguest') {
            echo '<div class="alert alert-info">
            <strong>Success!</strong> Guest Updated.
            </div>';
        }
            if($_SESSION['message'] == 'deleteguest') {
                echo '<div class="alert alert-danger">
                <strong>Success!</strong> Guest Deleted.
                </div>';
            }

            unset($_SESSION['message']);
    }
                ?>
                <form action = "process.php" method = "POST">
                <div class = "form-group">
                    <label for = "email">First Name:</label>
                    <input 
                        type = "text" 
                        class="form-control" 
                        name = "firstname" 
                        value = "<?=$_POST['firstname']?>"
                        required><br>
                    </div>
                    <div class = "form-group">
                        <label for = "email">Last Name:</label>
                        <input 
                        type = "text" 
                        class="form-control" 
                        name = "lastname" 
                        value = "<?=$_POST['lastname']?>"
                        required><br>
                    </div>
                    <div class = "form-group">
                        <label for = "email">Email</label>
                        <input 
                            type = "text" 
                            class = "form-control" 
                            id = "email" 
                            name = "email" 
                            value = "<?=$_POST['email']?>"
                            required><br><br>
                    </div>  
                    <?php
                    if(isset($_POST['editguest'])) {
                        echo '<input type = "hidden" name = "id" value = "'.$_POST['id'].'">';

                        echo '<button class = "btn btn-info" type = "submit" name = "updateguest">Update Guest</button><br><br>';
                  
                    }  else {
                        echo '<button class = "btn btn-primary" type = "submit" name = "addguest">Add Guest</button><br><br>';
                    
                    }
                    ?>
                </form>


                <table class = "table table-hover table-striped">
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Reg Date</th>
                        <th></th> <!--delete column-->
                        <th></th> <!--update column-->
                    </tr>

<!--copy from php select data mysql w3s-->
    <?php
include 'db.inc.php';

//select everything from myguests database
    $sql = "SELECT * FROM MyGuests";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
?>
<!--end php to enter table, using php shortcuts-->
    <tr>
        <td><?=$row['id']?></td>
        <td><?=$row['firstname']?></td>
        <td><?=$row['lastname']?></td>
        <td><?=$row['email']?></td>
        <td><?=$row['reg_date']?></td>

<!--edit button-->
        <td>
            <form action = "index.php" method = "POST">
                <input type = "hidden" name = "id" value = "<?=$row['id']?>">
                <input type = "hidden" name = "firstname" value = "<?=$row['firstname']?>">
                <input type = "hidden" name = "lastname" value = "<?=$row['lastname']?>">
                <input type = "hidden" name = "email" value = "<?=$row['email']?>">
                <button type = "submit" name = "editguest" class = "btn btn-success btn-xs">edit</button>
            </form>
        </td>

        <!--delete button-->
        <td>
            <form action = "process.php" method = "POST">
                <input type = "hidden" name = "id" value = "<?=$row['id']?>">
                <button type = "submit" name = "deleteguest" class = "btn btn-danger btn-xs">X</button>
            </form>
        </td>
    </tr>
<!--restart php-->        
<?php
    }
    } else {
      echo "0 results";
    }
    
    mysqli_close($conn);
    ?>
           </table>
        </div>
    </div>
</div>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>