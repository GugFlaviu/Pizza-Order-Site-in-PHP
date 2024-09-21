<?php
include 'config/db_connect.php';

$errors = ["email" => "", "title" => "", "ingredients" => ""];
$email = $title = $ingredients = '';
if (isset($_POST['submit'])) {
    // echo htmlspecialchars($_POST['email']);
    // echo htmlspecialchars($_POST['title']);
    // echo htmlspecialchars($_POST['ingredients']);
    if (empty($_POST['email'])) {
        $errors["email"] = "Please enter an email ";
    } else {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "enter a valid email";
        }
    }
    if (empty($_POST['title'])) {
        $errors["title"] = "Please enter an title ";
    } else {
        $title = $_POST["title"];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors["title"] = 'Title must be letters and spaces only';
        }
    }
    if (empty($_POST['ingredients'])) {
        $errors["ingredients"] = "Please enter ingredients ";
    } else {
        $ingredients = $_POST['ingredients'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
            $errors["ingredients"] = 'Ingredients must be a comma separated list';
        }
    }
    if (array_filter($errors)) {
        // echo "some errrors";
    } else {
        $email = mysqli_real_escape_string($con, $_POST["email"]);
        $title = mysqli_real_escape_string($con, $_POST["title"]);
        $ingredients = mysqli_real_escape_string($con, $_POST["ingredients"]);//check for sql injection
        //create sql
        $sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('$email','$title','$ingredients')";
        //save to db
        if (mysqli_query($con, $sql)) {
            header("Location: index.php");
        } else {
            echo "error sql :" . mysqli_error($con);
        }

    }

}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<?php include("templates/header.php"); ?>
<section class="container grey-text">
    <h4 class="center">Add a Pizza</h4>
    <form class="white" action="add.php" method="post">
        <label>Your Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
        <div class="red-text"><?php echo $errors["email"] ?></div>
        <label>Pizza Title</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
        <div class="red-text"><?php echo $errors["title"] ?></div>
        <label>Ingredients (comma separated)</label>
        <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
        <div class="red-text"><?php echo $errors["ingredients"] ?></div>
        <div class="center">

            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>
<?php include("templates/footer.php"); ?>
<!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

</html>