<?php include('./files/country.php') ?>
<?php 
    
    include './files/action.php';

    if(isset($_GET['logout'])){
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['img']);
    }
    else{
        //
    }

    if(isset($_SESSION['username'])){
        $user = $_SESSION['username'];
        $ava = $_SESSION['img'];
    }
    else{
        header('location: login.php');
    }


    if(isset($_GET['empty'])){
        unset($_SESSION['cart']);
    }

    if(isset($_GET['remove'])){
        $id = $_GET['remove'];
        foreach($_SESSION['cart'] as $k => $part){
            if($id == $part['id']){
                unset($_SESSION['cart'][$k]);
            }
        }
    }

    $total = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;700&family=Poppins:wght@900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6d5ca9b667.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/checkout.css">
    <link rel="shortcut icon" href="./img/logo.png">
    <title>Checkout - WebCOM</title>
</head>

<body>

    <!-------------->
    <div class="nav">
        <div class="nav-con">
            <div class="nav-1">
                <a href="index.php">WebMentor<span>.com</span></a>
            </div>

            <div class="nav-2">
                <ul>
                    <a href="index.php">Home</a>
                    <a href="index.php">About</a>
                    <a href="index.php">Contact</a>
                    <a href="index.php">Service</a>
                    <a href="index.php">Products</a>
                </ul>
            </div>

            <div class="nav-3">
                <button><img src="<?php echo $ava;?>">
                    <ul class="drop-down">
                        <li><a href="profile.php">Edit Your Profile</a></li>
                        <li><a href="tracking.php">Track Order</a></li>
                        <li><a href="checkout.php">Checkout</a></li>
                        <li><a href="admin-panel.php">Admin</a></li>
                        <li class="logout"><a href="index.php?logout=1">Logout</a></li>
                    </ul>
                </button>
            </div>
        </div>
    </div>

    <div class="table">
        <a class='empty' href="checkout.php?empty=1">EmptyCart</a>
        <table style="border-bottom: 1px #e3e3e3 solid; margin-bottom:20px;">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Remove</th>
            </tr>

            <?php if(isset($_SESSION['cart'])) :?>
                <?php foreach($_SESSION['cart'] as $k => $item) :?>
                    <tr>
                        <td><img src="<?php echo $item['img']; ?>"></td>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo $item['quan']; ?></td>
                        <td><?php echo $item['price'] * $item['quan']; 
                                        $pro = $item['price'] * $item['quan'];
                                        $total = $total + $pro;?></td>
                        <td><a href="checkout.php?remove=<?php echo $item['id']; ?>"><i class="fas fa-times"></i></a></td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </table>
        
        <div class="total" style="float: right;">
            <h2>Total Rs: <span><?php echo $total; ?></span></h2>
        </div>
    </div>

    
    <form action="checkout.php" method="POST">
        <?php include('./files/errors.php');?>
        <?php if(isset($success)){echo $success;} ?>
        <input type="text" name="name" placeholder="Enter Name" autocomplete="off" required>
        <input type="text" name="address" placeholder="Enter Address" autocomplete="off" required>
        <input type="text" name="phone" placeholder="Enter Phone Number" autocomplete="off" required>
        <input type="text" name="email" placeholder="Enter Email Address (Optional)" autocomplete="off">
        <div class="radio">
            <label>Cash On Delivery:</label>
            <input type="radio" name="method" value="Cash On Delivery" checked>
            <label>Bank Transfer:</label>
            <input type="radio" name="method" value="Bank Transfer">
            <label>Jazz Cash / EasyPaisa:</label>
            <input type="radio" name="method" value="Jazz Cash / EasyPaisa">
        </div>
        <button type="submit" name="order">Place Order</button>
    </form>

    <!-------------->
    <div class="footer">
        <p>Copyrights &copy; All Reserved. Created By M Ahmer Tahir</p>
    </div>
</body>

</html>