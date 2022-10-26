<?php


//call sessions functions so we don't have to keep rewrting code
session_start();

//update guest
if(isset($_POST['updateguest'])) {

    include 'db.inc.php';

    $sql = "UPDATE MyGuests SET firstname='{$_POST['firstname']}',lastname='{$_POST['lastname']}',email='{$_POST['email']}' WHERE id='{$_POST['id']}'";

    if (mysqli_query($conn, $sql)) {
      $_SESSION['message'] = 'updateguest';
      header("Location: index.php");
    } else {
      echo "Error updating record: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
}

//Add guest
if(isset($_POST['addguest'])) {

//echo $_POST['firstname'].'<br>';
//echo $_POST['lastname'].'<br>';
//echo $_POST['email'].'<br>';

include 'db.inc.php';

$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('{$_POST['firstname']}', '{$_POST['lastname']}', '{$_POST['email']}')";

if (mysqli_query($conn, $sql)) {
  $_SESSION['message'] = 'addguest';
    header("Location: index.php");

} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

}

//Delete guest
if(isset($_POST['deleteguest'])) {
    //add code to delete from database procedural sql from w3s
//remember to include the db info
include 'db.inc.php';
    // sql to delete a record
    $sql = "DELETE FROM MyGuests WHERE id='{$_POST['id']}'";

    if (mysqli_query($conn, $sql)) {
      $_SESSION['message'] = 'deleteguest';
        header("Location: index.php");

    } else {
    echo "Error deleting record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>