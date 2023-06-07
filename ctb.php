<!DOCTYPE html>
<html>
<head>
  <title>Create airlines table</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url("789.jpg");
      background-size: cover;
      background-position: center;
      padding: 20px;
      color: #333;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    table td, table th {
      padding: 8px;
      border: 1px solid #ddd;
    }

    table th {
      background-color: #f2f2f2;
      font-weight: bold;
    }

    form {
      margin-bottom: 20px;
    }

    input[type="text"] {
      padding: 5px;
      width: 100%;
      border: 1px solid #ddd;
    }

    input[type="submit"] {
      padding: 8px 16px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
    }

    .return-button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      text-decoration: none;
      font-size: 16px;
      border-radius: 5px;
      border: none;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <h1>Create airlines table</h1>
  <?php include "../inc/dbinfo.inc"; ?>

  <?php
    /* Connect to MySQL and select the database. */
    $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

    if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

    $database = mysqli_select_db($connection, DB_DATABASE);
     
    /* Ensure that the airline table exists. */
    $tablename = "airlinetable";
    VerifyTable($tablename, $connection, DB_DATABASE);

    /* If input fields are populated, add a row to the EMPLOYEES table. */
    $code = htmlentities($_POST['code']);
    $name = htmlentities($_POST['name']);
    $country = htmlentities($_POST['country']);

    if (strlen($code) || strlen($name) || strlen($country)) {
      AddItem($tablename, $connection, $code, $name, $country);
    }
  ?>

  <!-- Input form -->
  <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST">
    <table>
      <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Country</th>
      </tr>
      <tr>
        <td>
          <input type="text" name="code" maxlength="12" size="12" />
        </td>
        <td>
          <input type="text" name="name" maxlength="15" size="15" />
        </td>
        <td>
          <input type="text" name="country" maxlength="20" size="20" />
        </td>
        <td>
          <input type="submit" value="Add Data" />
        </td>
      </tr>
    </table>
  </form>

  <!-- Display table data. -->
  <table>
    <tr>
      <th>ID</th>
      <th>Code</th>
      <th>Name</th>
      <th>Country</th>
    </tr>

  <?php
  $t = mysqli_real_escape_string($connection, $tablename);
  $result = mysqli_query($connection, "SELECT * FROM $t");

  while($query_data = mysqli_fetch_row($result)) {
    echo "<tr>";
    echo "<td>", $query_data[0], "</td>",
         "<td>", $query_data[1], "</td>",
         "<td>", $query_data[2], "</td>",
         "<td>", $query_data[3], "</td>";
    echo "</tr>";
  }
  ?>

  </table>

  <!-- Clean up. -->
  <?php
    mysqli_free_result($result);
    mysqli_close($connection);
  ?>

  <!-- Return button -->
  <div>
    <a href="http://52.206.189.233/airline.html" class="return-button">Back</a>
  </div>

</body>
</html>

<?php
/* Add an employee to the table. */
function AddItem($tablename, $connection, $code, $name, $country) {
   $t = mysqli_real_escape_string($connection, $tablename);
   $c = mysqli_real_escape_string($connection, $code);
   $n = mysqli_real_escape_string($connection, $name);
   $cn = mysqli_real_escape_string($connection, $country);

   $query = "INSERT INTO $t (code, name, country) VALUES ('$c', '$n', '$cn');";

   if(!mysqli_query($connection, $query)) echo("<p>Error adding employee data.</p>");
}

/* Check whether the table exists and, if not, create it. */
function VerifyTable($tablename, $connection, $dbName) {
  if(!TableExists($tablename, $connection, $dbName))
  {
     $t = mysqli_real_escape_string($connection, $tablename);
     $query = "CREATE TABLE $t (
         ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         code VARCHAR(20),
         name VARCHAR(20),
         country VARCHAR(30)
       )";

     if(!mysqli_query($connection, $query)) echo("<p>Error creating table.</p>");
  }
}

/* Check for the existence of a table. */
function TableExists($tableName, $connection, $dbName) {
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, $dbName);

  $checktable = mysqli_query($connection,
      "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");

  if(mysqli_num_rows($checktable) > 0) return true;

  return false;
}
?>
