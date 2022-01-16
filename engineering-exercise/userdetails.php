<?php
    include_once 'includes/header.php';
    include_once 'includes/db.php';


    //get the user from the clicked on id
    $need=mysqli_real_escape_string($conn,$_GET['reference']);
    $sqlUsers="SELECT * FROM users WHERE user_id=$need";
    $resultUsers=mysqli_query($conn,$sqlUsers);
    $row=mysqli_fetch_assoc($resultUsers);
    $largePicture=$row["picturelarge"];
    $mediumPicture=$row["picturemedium"];
    $thumbnailPicture=$row["picturethumbnail"];


    //get the transactions from the user with desired id
    $sqlTrans="SELECT * FROM transactions WHERE user_id=$need";
    $transResults=mysqli_query($conn,$sqlTrans);
?>

<body>
    <section><a href="index.php">Home</a></section>
    <table>
            <caption>User Details</caption>
        <tr class="data-heading">
            <th>User_id</th>
            <th>Gender </th>
            <th>Title </th>
            <th>First Name</th>
            <th>Last Name</th>
            <th> Street Number</th>
            <th>Street Name</th>
            <th>City</th>
            <th>State</th>
            <th>Country </th>
            <th>PostCode </th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Time Zone Offset </th>
            <th>Time Zone Description </th>
            <th>Email </th>
            <th>Birthdate</th>
            <th>Age</th>
            <th>Date Registered</th>
            <th>Registered age</th>
            <th>Phone</th>
            <th>Cell</th>
            <th>Picture Large</th>
            <th>Picture Medium</th>
            <th>Picture Thumbnail</th>
        </tr>
                <?php
                //print the user from the user id
                   echo   "<tr><td>".$row["user_id"]."</td><td>".$row["gender"]."</td><td>".$row["nametitle"]."</td><td>".$row["namefirst"]."</td><td>".$row["namelast"]."</td><td>".$row["streetnumber"]."</td><td>".$row["streetname"]."</td><td>".$row["city"]."</td><td>".$row["state"]."</td><td>".$row["country"]."</td><td>".$row["postcode"]."</td><td>".$row["latitude"]."</td><td>".$row["longitude"]."</td><td>".$row["timezoneoffset"]."</td><td>".$row["timezonedescription"]."</td><td>".$row["email"]."</td><td>".$row["dobdate"]."</td><td>".$row["dobage"]."</td><td>".$row["registereddate"]."</td><td>".$row["registeredage"]."</td><td>".$row["phone"]."</td><td>".$row["cell"]."</td><td>"."<img src='$largePicture' alt='picture'"."</td><td>"."<img src='$mediumPicture' alt='picture'"."</td><td>"."<img src='$thumbnailPicture' alt='picture'". "</td></tr>";
                ?>

    </table>
    </section>
    <section>
        <table>
            <caption>Users Transactions</caption>
            <tr class="data-headings">
                <th>Transaction_id</th>
                <th>Time</th>
                <th>amount</th>
                <th>status</th>
                <th>Payment Method</th>
                <th>user_id</th>
            </tr>
                <?php
                //print the transactions of the user with that id
                while($rowTrans=mysqli_fetch_assoc($transResults)) {
                    echo "<tr><td>" . $rowTrans["transaction_id"] . "</td><td>" . $rowTrans["timeStamp"] . "</td><td>" . $rowTrans["amount"] . "</td><td>" . $rowTrans["status"] . "</td><td>" . $rowTrans["PaymentMethod"] . "</td><td>" . $rowTrans["user_id"] . "</td></tr>";
                }
                $conn->close();
                ?>
        </table>
    </section>
</body>
</html>