<?php 
    require '../config/db.php';
    if ($_GET["table"] == "cart") {
        $delpc = mysqli_query($conn, "DELETE from cart where id=" . $_GET["id"]);
        if ($delpc) {
            header("location:cart.php");
        } else {
            echo "Something wrong in delete data.......!";
        }
    }
    if ($_GET["table"] == "wishlist") {
        $delpw = mysqli_query($conn, "DELETE from wishlist where id=" . $_GET["id"]);
        if ($delpw) {
            header("location:wishlist.php");
        } else {
            echo "Something wrong in delete data.......!";
        }
    }
?>  