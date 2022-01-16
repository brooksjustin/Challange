<?php
    include_once 'includes/header.php';
    include_once 'includes/db.php';
    include "includes/usersclass.php";

    $user=new usersclass();

    //get number of transactions
    $transactionsAll=mysqli_query($conn,"SELECT * FROM transactions");
    $numTransactions=mysqli_num_rows($transactionsAll);

    //pagination
    $transactionsPerPage=50;
    $table='transactions';
    $numberOfPages=ceil($numTransactions/$transactionsPerPage);
    $transactionLimit=$user->Pagination($transactionsPerPage,$table)
?>
<body>
<section><a href="index.php">Home</a></section>
    <section class="container">
        <?php
        //pagination buttons
        for($i=1;$i<=$numberOfPages;$i++) {
            echo '<a href="transactions.php?page='. $i .'">'.$i .'</a> ';
        }
        ?>
        <div class="data-table-container">
            <table class="data-table">
                <caption>Transactions</caption>
                <tr class="data-headings">
                    <th>Transaction_id</th>
                    <th>Time</th>
                    <th>amount</th>
                    <th>status</th>
                    <th>Payment Method</th>
                    <th>user_id</th>
                </tr>
                <?php
                //print transaction table
                if($numTransactions>0){
                    while($row=mysqli_fetch_assoc($transactionLimit)){
                        $i=$row["user_id"];
                        echo "<tr><td>".$row["transaction_id"]."</td><td>".$row["timeStamp"]."</td><td>".$row["amount"]."</td><td>".$row["status"]."</td><td>".$row["PaymentMethod"]."</td><td><a href='userdetails.php?reference=$i'>".$row["user_id"]."</a></td></tr>";
                    }
                }
                else{
                    echo "No Results";
                }
                $conn->close();
                ?>
            </table>
        </div>
    </section>
</body>

</html>