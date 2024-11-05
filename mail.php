<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Example</title>
    <style>
        section {
            height: 50vh; 
            padding: 20px;
            /* border: 1px solid #ccc; */
        }
    </style>
</head>
<body>

    <section id="section1">
        <h1>Section 1</h1>
        <button onclick="goToSection('section2')">Next</button>
    </section>

    <section id="section2">
        <h1>Section 2</h1>
        <button onclick="goToSection('section3')">Next</button>
    </section>

    <section id="section3">
        <h1>Section 3</h1>
        <button onclick="goToSection('section1')">Back to Section 1</button>
    </section>

    <script>
        function goToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth' });
            }
        }
    </script>

</body>
</html> -->
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Next and Previous Buttons</title>
    <style>
        section {
            display: none; /* Hide all sections initially */
            /* height: 100vh;  */
            padding: 20px;
            /* border: 1px solid #ccc; */
        }
        section.active {
            display: block; /* Show only the active section */
        }
    </style>
</head>
<body>

    <section id="section1" class="active">
        <h1>Section 1</h1>
        <button id="next">Next</button>
    </section>

    <section id="section2">
        <h1>Section 2</h1>
        <button id="prev">Previous</button>
        <button id="next">Next</button>
    </section>

    <section id="section3">
        <h1>Section 3</h1>
        <button id="prev">Previous</button>
    </section>

    <script>
        const sections = document.querySelectorAll('section');
        let currentSectionIndex = 0;

        function showSection(index) {
            sections.forEach((section, i) => {
                section.classList.toggle('active', i === index);
            });
        }

        document.querySelectorAll('#next').forEach(button => {
            button.addEventListener('click', () => {
                if (currentSectionIndex < sections.length - 1) {
                    currentSectionIndex++;
                    showSection(currentSectionIndex);
                }
            });
        });

        document.querySelectorAll('#prev').forEach(button => {
            button.addEventListener('click', () => {
                if (currentSectionIndex > 0) {
                    currentSectionIndex--;
                    showSection(currentSectionIndex);
                }
            });
        });

        // Initially show the first section
        showSection(currentSectionIndex);
    </script>

</body>
</html>
 -->
 <!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
</head>
<body>
    <h1>Send an Email</h1>
    <form  method="post">
        <label for="email">Enter your email:</label>
        <input type="email" id="email" name="email" required>
        <input type="submit" value="Send Email">
    </form>
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<?php 
    // if (isset($_POST['submit'])) {
    //     $select_item = $_POST['select_item'];
    //     $register_date = mysqli_real_escape_string($connection, $_POST['register_date']);
    //     $collection_date = mysqli_real_escape_string($connection,$_POST['collection_date']);
    //     if ($select_item === 'gmail') {
    //         $query = "SELECT * FROM contribute WHERE  gmail != ''"; 
    //     }      
    //      elseif($select_item === 'name'){
    //         $query = "SELECT * FROM contribute WHERE  username != ''"; 
    //     } elseif (!empty($register_date)) {
    //         $query = "SELECT * FROM contribute WHERE date = '$register_date'"; 
    //     }
    //     elseif(!empty($collection_date)) {
    //         $query = "SELECT * FROM contribute WHERE collection_date = '$collection_date'"; 
    //     }
    //      else {
    //         $query = "SELECT * FROM contribute";
    //     }
    // } else {
    //     ;
    // }
    // $connection = mysqli_connect("localhost", "root", "", "contribution");
    // $query = "SELECT * FROM contribute";
    // $result = mysqli_query($connection, $query);
    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_id = $_POST['selected_option'];

    if (!empty($selected_id)) {
        $sql = "SELECT * FROM your_table WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $selected_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Display the row data
            echo "You selected: " . $row['name'];
            // You can display other fields as needed
        } else {
            echo "No data found.";
        }
    } else {
        echo "Please select an option.";
    }
}


<body>
<form method="post" action="">
    <label for="filter_type">Select Filter:</label>
    
    <div>
        <p>Register Date</p>
        <input type="date" name="register_date" style="display: inline;">
    </div>
    
    <div>
        <p>Collection Date</p>
        <input type="date" name="collection_date">
    </div>
    
    <div>
        <select name="select_item" id="">
            <option value="">Select a username</option>
            <?php
            $connection = mysqli_connect("localhost", "root", "", "contribution");
            $query = "SELECT DISTINCT username FROM contribute";
            $result = mysqli_query($connection, $query);
            
            while ($row = mysqli_fetch_array($result)) {
                echo '<option value="' . $row['username'] . '">' . $row['username'] . '</option>';
            }
            ?>
        </select>
        <input type="submit" name="submit" value="Search" id="">
    </div>
</form>

<table>
<tr>
    <th>ID</th>
    <th>Date</th>
    <th>Full Name</th>
    <th>Gmail</th>
    <th>Collection Date</th>
</tr>

</table>
</body>

        </html>