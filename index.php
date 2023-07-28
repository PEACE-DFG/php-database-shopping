
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="icon/all.min.css">
    <title>Document</title>
    <style>
        body{
            background-image:url("https://img.rawpixel.com/s3fs-private/rawpixel_images/website_content/v983batch2-021.jpg?w=800&dpr=1&fit=default&crop=default&q=65&vib=3&con=3&usm=15&bg=F4F4F3&ixlib=js-2.2.1&s=1a2fa6c9edab02b4256ee4834718e972");
            background-size:cover;
            background-repeat:no-repeat;
        }
        .one{
            max-width:700px;
            background-color:rgb(0,0,0,0.8);
            padding:20px;
            border:1px solid grey;
            border-radius:10px;
            box-shadow:100px 100px 30px grey;
            overflow:auto;
            height:500px;
            width:500px;


        }
        .two{
            max-width:500px;
            background-color:rgb(0,0,0,0.8);
            padding:20px;
            border:1px solid grey;
            border-radius:10px;
            box-shadow:100px 100px 30px grey;
            margin-top:50px;

        }
        .rel{
            display:flex;
            justify-content:space-between;
            align-items:center;
            border:3px solid white;
            padding:0px 10px;
            border-radius:3px;
        }
        .re{
            display:flex;
            justify-content:space-between;
            align-items:center;
            /* border:3px solid white; */
            padding:0px 10px;
            border-radius:3px;
        }
        .same{
            /* border:3px solid white; */
            color:white;
            padding:0px 30px;

        }
        .whole{
            display:flex;
            justify-content:space-evenly;
        }
        .but{
            background-color:green;
            color:white;
            border:none;
            padding:5px 15px;
            font-size:20px;
            border-radius:10px;
        }
        .product1{
            margin:10px 0px;
            display:flex;
            justify-content:space-around;
            align-items:center;
            border:1px solid white;
            box-shadow:5px 5px 4px white;

        }
    </style>
</head>
<body >
    <section class="whole">
        <!-- First section -->
        <section class="one">
        <div class="rel">
            <div class="same">
                <h3>Island Store</h3>
            </div>
            <div class="same">
            <i class="fa-solid fa-bars"></i>
            </div>
        </div>
        <?php 
            require_once 'database.php';
            $sql = "SELECT * FROM product";
            $select = mysqli_query($conn, $sql);
            ?>
        <!-- down 1 -->
<?php

$sn=1;
while($result =mysqli_fetch_array($select)){

    ?>
      <div class="product1">
        <div style="color:white">
        <?php echo $sn++ ?>
        </div>
            <div >
                <img src="<?php echo $result['image'] ?>" style="width:100px" alt="">
            </div>
            <div>
              <!-- inner -->
                <section style="display:flex;align-items:center;color:white">
                <div>
                    <h5>
                    <?php echo $result['title'] ?>
                     </h5>
                 </div>
                 <div style="padding-left:30px">
                        <i class="fa-solid fa-trash"></i>
                </div>
                </section>
                <!-- price -->
                <h5 style="color:white">
                    Price:<?php echo $result['price'] ?>
                </h5>
            </div>

        </div>
        <?php
};


?>
      
        </section>
        <!-- second section -->
        <section class="two">
        <div class="re">
            <div class="same">
                <h3>Island Store</h3>
            </div>
            <div class="same">
             <i class="fa-solid fa-crown "></i>
            </div>
        </div>
        <hr>
        <div>
            <form action="index.php" method="post">
            <?php
            require_once "database.php";
$errors=[];
$data = array(
    'title' => '',
    'image' => '',
    'price' => ''
);

// $title=$image=$price="";
// array($title="");

if(isset($_POST['add'])){
    if(empty($_POST['title'])){
        $errors['titleErr']="Your Product Title is Required";
    }
    else{
        $data['title']=$_POST['title'];
    }
    if(empty($_POST['image'])){
        $errors['imageErr']="Your Product Image is Required";
    }
    else{
        $data['image']=$_POST['image'];
    }
    if(empty($_POST['price'])){
        $errors['priceErr']="Your Product Price is Required";
    }
    else{
        $data['price']=$_POST['price'];
    }
    $title = $data['title'];
    $image = $data['image'];
    $price = $data['price'];
    $date = date("Y-m-d h:i:s a");

    if(count($errors)==0){
        $sql = "INSERT INTO product(title, image, price,dateadded) VALUES('$title','$image','$price', '$date')";
        if(mysqli_query($conn,  $sql)){
            echo "<p style='color:green'>Data submitted successfully <i class='fa-solid fa-score'></i></p>";
          }else{
            echo "Something went wrong". mysqli_error($conn);
          }
    }
}
// print_r ($errors);
// echo "<br>";
// print_r ($data);
?>
                <div style="margin:20px;">
                <h4 style="color:white;">
                    Product Title
                </h4>
                <input type="text" name="title" style="width:100%;font-size:20px;" value="<?php echo array_key_exists('title',$data)? $data['title']:''?>">

                <p style="color:red">
                    <?php
                    echo array_key_exists('titleErr',$errors)? $errors['titleErr']: " "
                    ?>
                    </p>
                <div>
                    <h4 style="color:white">
                    Image Address:
                    </h4>
                    <input type="text" name="image" style="width:100%;font-size:20px;" value="<?php echo array_key_exists('image',$data)? $data['image']:''?>">
                    <p style="color:red">
                    <?php
                    echo array_key_exists('imageErr',$errors)? $errors['imageErr']: " "
                    ?>
                    </p>
                </div>
                <div>
                    <h4 style="color:white">
                    Product Price:
                    </h4>
                    <input type="text" name="price" style="width:100%;font-size:20px;" value="<?php echo array_key_exists('price',$data)? $data['price']:''?>">
               
                    <p style="color:red">
                    <?php
                    echo array_key_exists('priceErr',$errors)? $errors['priceErr']: " "
                    ?>
                    </p>
                </div>
                <div>
                    <button name="add" style="width:100%;margin:20px 0px 0px 5px;padding:15px;background:linear-gradient(to right,green,yellow,pink,orange);color:rgb(0,0,0,0.7);font-weight:900;border:none;"><i class="fa-solid fa-circle-plus fa-beat" style="padding-right:5px;"></i>ADD PRODUCT</button>
                </div>
                </div>
        </form>
        </div>
        </section>
    </section>
</body>
</html>