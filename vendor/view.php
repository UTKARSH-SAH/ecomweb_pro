
<?php
include "authguard.php";
include "menu.html";
include "../shared/connection.php";

$userid=$_SESSION['userid'];

$sql_result=mysqli_query($conn,"select * from product where uploaded_by=$userid");


while($row=mysqli_fetch_assoc($sql_result)){
    
    echo "<div class='card-box'>
                <div class='name'>$row[name]</div>
                <div class='price'>$row[price]</div>
                <div class='pdt-img'>
                    <img src='$row[impath]' >
                </div>
                <div class='detail'>$row[detail]</div>  
                <hr>
                <div class='action'>
                    <a href='editproduct.php?pid=$row[pid]'>
                        <button class='btn btn-warning'>Edit</button>
                    </a>
                    <a href='deletepdt.php?pid=$row[pid]'>
                        <button class='btn btn-danger'>Delete</button>
                    </a>
                </div>  
    </div>";

    
}
?>