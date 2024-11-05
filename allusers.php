<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- <link rel="stylesheet" href="allusers.css"> -->
    <style>
        table{
            width:70%;
            text-align:center;
        }
        table,th,td{
            border:1px solid black;
            border-collapse:collapse;zx
        }
        th{
            background:whitesmoke;
            /* width:3%; */
        }
        tr:nth-child(even){
            background:gray;
        }
    </style>
</head>
<body>
<form method="POST">
    <input type="text" name="search" placeholder="Search by Gmail" required>
    <select name="" id="">
        <option value="">Find by Mail</option>
    </select>
    <select name="" id="">
        <option value="">Find by Name</option>
    </select>
<input type="date" name="" id="">
    <button type="submit" name="submit">Search</button>
</form>
<table>
<tr>
    <th>ID</th>
    <th>Date</th>
    <th>Full name</th>
    <th>Gmail</th>
    <th>Colletion Date</th>
</tr>
<?php
    $connection = mysqli_connect("localhost", "root", "", "contribution");
?>
<?php

    if (isset($_POST['submit'])) {
       
        $search = mysqli_real_escape_string($connection, $_POST['search']);
        $query = "SELECT * FROM contribute WHERE gmail LIKE '%$search%'";
    }
     else{
        $query = "SELECT * FROM contribute";
    }

    $result = mysqli_query($connection, $query);
    $i = 1;
    if(mysqli_num_rows($result) >0){
        while($row = mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['gmail']; ?></td>
                <td><?php echo $row['collection_date']; ?></td>
            </tr>
            <?php
        } 
    }else{ ?>
<tr>
    <td colspan="5">No record found</td>
</tr>
    <?php } ?>
</table>
</body>
