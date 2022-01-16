<?php
    include_once 'includes/header.php';
    include_once 'includes/db.php';
    include "includes/usersclass.php";

    $user=new usersclass();

    //get users from json
    $users=$user->getUsers();
    $sql="SELECT * FROM users";

    //add users to database if the database is empty
    $alreadyIn=mysqli_num_rows(mysqli_query($conn,$sql));
    if($alreadyIn<=1) {
        $user->userTable($users);
    }

    //get the number of users
    $userAll=mysqli_query($conn,$sql);
    $numberOfUser=mysqli_num_rows($userAll);

    //pagination
    $usersPerPAge=25;
    $table='users';
    $numberOfPages=ceil($numberOfUser/$usersPerPAge);
    $userLimit=$user->Pagination($usersPerPAge,$table);

    //Generate transactions button
    if (isset($_POST['btnTransactions'])) {
        foreach ($userAll as $users) {
            $user->makePayment($users['user_id']);
        }
    }

?>
<body>
    <section>
                <center>  <a href="transactions.php">Transaction Page</a></center>
                                <!---button for generating transactions --->
                    <center><form method="post"> <input type="submit" name="btnTransactions" value="Generate transactions"></form></button></center>
        <?php
        //pagination buttons
        for($i=1;$i<=$numberOfPages;$i++) {
            echo '<a href="index.php?page='. $i .'">'.$i .'</a> ';
        }
        ?>
        <div class="data-table-container">
            <table class="data-table">
                    <caption>Users</caption>
                    <tr class="data-heading">
                        <th class="ui-secondary-color">user_id</th>
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
                     //print user table
                    if($numberOfUser>0){
                            while($row=mysqli_fetch_assoc($userLimit)){
                                $i=$row["user_id"];
                                $largePicture=$row["picturelarge"];
                                $mediumPicture=$row["picturemedium"];
                                $thumbnailPicture=$row["picturethumbnail"];
                                echo "<tr><td><a href='userdetails.php?reference=$i'>".$row["user_id"]."</a></td><td>".$row["gender"]. "</td><td>".$row["nametitle"]."</td><td>".$row["namefirst"]."</td><td>".$row["namelast"]."</td><td>".$row["streetnumber"]."</td><td>".$row["streetname"]."</td><td>".$row["city"]."</td><td>".$row["state"]."</td><td>".$row["country"]."</td><td>".$row["postcode"]."</td><td>".$row["latitude"]."</td><td>".$row["longitude"]."</td><td>".$row["timezoneoffset"]."</td><td>".$row["timezonedescription"]."</td><td>".$row["email"]."</td><td>".$row["dobdate"]."</td><td>".$row["dobage"]."</td><td>".$row["registereddate"]."</td><td>".$row["registeredage"]."</td><td>".$row["phone"]."</td><td>".$row["cell"]."</td><td>"."<img src='$largePicture' alt='picture'"."</td><td>"."<img src='$mediumPicture' alt='picture'"."</td><td>"."<img src='$thumbnailPicture' alt='picture'". "</td></tr>";
                            }
                        }
                        else{
                            echo"No results";
                        }
                        $conn->close();
                        ?>
            </table>
        </div>
    </section>

</body>
</html>
