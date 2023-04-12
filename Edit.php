<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include('config.php');

// Retrieve the current user ID
$user_id = $_SESSION["id"];

// Prepare the SQL query with a WHERE clause to filter by user ID
$sql = "SELECT * FROM Dashboard WHERE user_id = $user_id";
$result = $conn->query($sql);

// Fetch the row for the current user
$row = $result->fetch_assoc();

// Handle form submission when user updates the values
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Get the updated values from the form
    $totaal = $_POST['totaal'];
    $uitgegeven = $_POST['uitgegeven'];

    // Update the record for the current user
    $update_sql = "UPDATE Dashboard SET `Totaal op de rekening` = '$totaal', `Uitgegeven deze maand` = '$uitgegeven' WHERE user_id = $user_id";

    if ($conn->query($update_sql) === TRUE) {
        // Redirect to the welcome page
        header("location: welcome.php");
        exit;
    } else {
      echo "Error updating record: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="./imgs/MicrosoftTeams-image.png" alt="" id="foto">
        <h1 id="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bewerk hier uw gegevens.</h1>
    </header>

    <div id="Sign-Out"> 
        <a href="reset-password.php" class="btn btn-warning">Reset Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out</a>  
    </div>

    <div id="buttons">
        <a href="welcome.php" class="btn btn-warning">Terug naar overzicht</a>
        <a href="" class="btn btn-warning">Account</a>
        <a href="" class="btn btn-warning">Dashboard</a>
    </div>

    <form method="POST" action="">
        <table>
            <tr>
                <th>Totaal op de rekening</th>
                <td><input type="text" name="totaal" value="<?php echo $row['Totaal op de rekening']?>" required></td>
            </tr>
            <tr>
                <th>Uitgegeven deze maand</th>
                <td><input type="text" name="uitgegeven" value="<?php echo $row['Uitgegeven deze maand']?>" required></td>
            </tr>
        </table>
        <br>
        <div id="opslaan">
        <button type="submit" class="btn btn-primary">Opslaan</button></div>
    </form>

<style>
body{ font: 16px sans-serif;  }

header{
    width: 100%;
    height: 150px;
    background-color: blue;
}

#Sign-Out {
text-align: right;
margin-top: -120px;
}
#opslaan{
    text-align: center;
}
#buttons{
    text-align: right;
    margin-top: 10px;
}
#foto{
    margin-top: 25px;
}

#my-5{
    /* margin-top: -5px; */
    text-align: center;
    margin-top: -20px;
}


table{
    margin-top: 350px;
    margin-left: 35%;
}

 td, th {

     border: 1px solid #dddddd;

     text-align: left;

     padding:50px;
}
</style>
</body>
</html>
