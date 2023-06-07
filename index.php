<?php include "../inc/dbinfo.inc"; ?>
<html>
<head>
    <title>Search Airlines</title>
    <style>
        body {
            background-image: url('123.jpg');
            background-size: cover;
            background-position: center;
        }
        h1 {
            color: #fff;
            text-align: center;
        }
        form {
            margin: 20px auto;
            text-align: center;
        }
        input[type="text"] {
            padding: 10px;
            font-size: 16px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            text-align: center;
            width: 80%;
            background-color: rgba(255, 255, 255, 0.8);
        }
        table td, table th {
            padding: 10px;
            border: 1px solid #ddd;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table tr:hover {
            background-color: #ddd;
        }
        .return-button {
            margin-top: 20px;
            text-align: center;
        }
        .return-button a {
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
    <h1>Search Airlines</h1>
    <form method="POST" action="">
        <label for="keyword">Please enter airline company name:</label>
        <br>
        <input type="text" id="keyword" name="keyword" required>
        <br>
        <input type="submit" name="submit" value="Search">
    </form>
    <?php
    // Create a new MySQLi object
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $tablename = "airlinetable";

    if (isset($_POST["submit"])) {
        $searchKeyword = $_POST['keyword'];
        $keyword = $conn->real_escape_string($searchKeyword);
        $table = $conn->real_escape_string($tablename);

        $sql = "SELECT * FROM $table WHERE code LIKE '%$keyword%'";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table border='1' cellpadding='2' cellspacing='2'>";
            echo "<tr>";
            echo "<th>Code</th>",
                 "<th>Name</th>",
                 "<th>Country</th>";
            echo "</tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['code']}</td>",
                     "<td>{$row['name']}</td>",
                     "<td>{$row['country']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No results found.";
        }
        $result->free_result();
    }

    // Close the database connection
    $conn->close();
    ?>
    <!-- Return button -->
    <div class="return-button">
        <a href="http://YOUR EC2 IPV43/airline.html">back</a>
    </div>
</body>
</html>
