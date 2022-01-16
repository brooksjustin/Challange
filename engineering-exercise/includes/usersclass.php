<?php
class usersClass
{
    // used to get users from json
   public function getUsers()
    {
        $jsonData = file_get_contents("https://randomuser.me/api/?results=500&nat=us&exc=login,id,nat");
        $usersDAta = json_decode($jsonData, true);
        return $usersDAta['results'];
    }

    //generates a payment with random information and adds it to the transactions table from passed in user_id
   public function makePayment($user_id)
    {
        include 'includes/db.php';

        $amount = mt_rand(10000, 30000) / 10;
        $status = ["paid", "due", "pending"];
        $statusRandom = $status[rand(0, 2)];
        $paymentMethods = ["Visa", "Discover", "Mastercard", "American Express", "eCheck", "Paypal"];
        $paymentMethodRandom = $paymentMethods[rand(0, 5)];
        $randomTime = mt_rand(1, time());
        $timeStamp = date("m-d-Y", $randomTime);

        $sql = "INSERT INTO transactions(timeStamp,amount,status,PaymentMethod,user_id) VALUES(?,?,?,?,?)";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            echo "error in transactions table generation";
        }
        else{
            mysqli_stmt_bind_param($stmt,"sssss",$timeStamp,$amount,$statusRandom,$paymentMethodRandom,$user_id);
            mysqli_stmt_execute($stmt);
        }
        $conn->close();
    }

    //used to add users to sql table
    public function userTable($users)
    {
        include 'includes/db.php';

        //prepared statement
        $sql = "INSERT INTO users(gender,nametitle,namefirst,namelast,streetnumber,streetname,city,state,country,postcode,latitude,longitude,timezoneoffset,timezonedescription,email,dobdate,dobage,registereddate,registeredage,phone,cell,picturelarge,picturemedium,picturethumbnail) 
                VALUES (?,?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt=mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            echo "error in user table generation";
        }
        mysqli_stmt_bind_param($stmt,"ssssssssssssssssssssssss",$gender,$nameTitle,$nameFirst,$nameLast,$locationStreetNumber,$locationStreetName,$locationCity,$locationState,$locationCountry
            ,$locationPostcode,$locationCoorLat,$locationCoorLon,$timeZoneDiff,$timeZoneDesc,$email,$dobDate,$dobAge,$registerDate,$registerAge,$phone,$cell,$pictureLarge,$pictureMedium,$pictureThumb);

        //insert users into database
        $i = 0;
        while ($i < count($users)) {
            //destructure json array
            [$i=>['gender'=>$gender,'name'=>['title'=>$nameTitle,'first'=>$nameFirst,'last'=>$nameLast],
                'location'=>['street'=>['number'=>$locationStreetNumber,'name'=>$locationStreetName],'city'=>$locationCity,'state'=>$locationState,'country'=>$locationCountry,'postcode'=>$locationPostcode,
                    'coordinates'=>['latitude'=>$locationCoorLat,'longitude'=>$locationCoorLon],'timezone'=>['offset'=>$timeZoneDiff,'description'=>$timeZoneDesc]]
                ,'email'=>$email,'dob'=>['date'=>$dobDate,'age'=>$dobAge],'registered'=>['date'=>$registerDate,'age'=>$registerAge],'phone'=>$phone,'cell'=>$cell,
                'picture'=>['large'=>$pictureLarge,'medium'=>$pictureMedium,'thumbnail'=>$pictureThumb]]]=$users;

            //format birthday correctly
            $dobDate=usersClass::Birthday($dobDate);
            mysqli_stmt_execute($stmt);
            $i++;
        }
        $conn->close();
    }

    //formats user birthday to correct format
    private function Birthday($scrambled){
        $timestamp=strtotime($scrambled);
        return date('F j, Y',$timestamp);
   }

    //pagination function
    public function Pagination($pageLimit,$table){

       include 'includes/db.php';

        if(!isset($_GET['page'])){
            $page=1;
        }else{
            $page=$_GET['page'];
        }
        $firstResult=($page-1)*$pageLimit;
        $firstResultClean=mysqli_real_escape_string($conn,$firstResult);
        $results=mysqli_query($conn,"SELECT * FROM $table LIMIT $firstResultClean,$pageLimit");
        $conn->close();
        return $results;
    }

}


