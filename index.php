<?php
include 'config/db_connect.php';
$sql = "SELECT title,ingredients,id FROM pizzas ORDER BY createda_at";

$result = mysqli_query($con, $sql);

$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);



?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>


<?php include("templates/header.php"); ?>
<h4 class="center grey-text">Pizzas!</h4>

<div class="container">
    <div class="row">
        <?php foreach ($pizzas as $pizza) { ?>
            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <img src="img/pizza.svg" class="pizza">
                    <div class="card-content center">

                        <div><?php echo htmlspecialchars($pizza['ingredients']) ?>
                            <ul>
                                <?php foreach (explode(",", $pizza['ingredients']) as $ing): ?>
                                    <li><?php echo htmlspecialchars($ing) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                    <div class="card-action right-align">
                        <a class="brand-text" href="details.php?id=<?php echo $pizza['id'] ?>"> More Info</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<?php include("templates/footer.php"); ?>
<!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->



</html>