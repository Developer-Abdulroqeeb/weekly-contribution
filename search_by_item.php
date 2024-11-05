<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form {
            display: flex;
            align-items: center;
            gap:20px;
        }
        div {
            display: flex;
            align-items: center;
        }
        table {
            width: 70%;
            text-align: center;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th {
            background: whitesmoke;
        }
        tr:nth-child(even){
            background: gray;
        }
    </style>
</head>
<body>
<form method="post" action="">
    <div>
        <p>from:  </p>
        <input type="date" name="from_date">
    </div>
    <div>
        <p>to:   </p>
        <input type="date" name="to_date">
    </div>
    <select name="select_item">
        <option value="">Select a username</option> 
        <?php
        $connection = mysqli_connect("localhost", "root", "", "contribution");
        $query = "SELECT DISTINCT username FROM contribute";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <option value="<?php echo $row['username']; ?>">
                <?php echo $row['username']; ?>
            </option>
            <?php
        }
        ?>
    </select>
    <button type="submit" name="submit">Submit</button>
</form> 
<table>
<tr>
    <th>ID</th>
    <th>Date</th>
    <th>Full Name</th>
    <th>Gmail</th>
    <th>Collection Date</th>
</tr>
<?php  
if (isset($_POST['submit'])){
    $select_item = mysqli_real_escape_string($connection, $_POST['select_item']);
    $from_date = mysqli_real_escape_string($connection, $_POST['from_date']);
    $to_date = mysqli_real_escape_string($connection, $_POST['to_date']);

    $query = "SELECT * FROM contribute WHERE TRUE";

    if (!empty($select_item)) {
        $query .= " AND username = '$select_item'";
    }
    elseif (!empty($from_date)) {
        $query .= " AND collection_date >= '$from_date'"; 
    }
    elseif (!empty($to_date)) {
        $query .= " AND collection_date <= '$to_date'";
    }
}
 else {
    $query = "SELECT * FROM contribute";
}
$select_query = mysqli_query($connection, $query);

if (mysqli_num_rows($select_query) > 0) { 
    $i = 1;
    while($row_table = mysqli_fetch_array($select_query)) {
        ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row_table['date']; ?></td>
            <td><?php echo $row_table['username']; ?></td>
            <td><?php echo $row_table['gmail']; ?></td>
            <td><?php echo $row_table['collection_date']; ?></td>
        </tr>
        <?php
    }
} else {
    ?>
    <tr>
        <td colspan="5">No record found</td>
    </tr>
    <?php
}
?>
</table>
</body>
</html>
