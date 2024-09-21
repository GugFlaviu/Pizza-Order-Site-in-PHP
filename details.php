<?php
include("config/db_connect.php");
if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_escape_string($con, $_POST['id_to_delete']);
    $sql = "DELETE FROM pizzas WHERE id=$id_to_delete";
    if (mysqli_query($con, $sql)) {
        header('Location: index.php');
    } else {
        echo "query ERRROR";
    }
}
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    $sql = "SELECT * FROM pizzas WHERE id=$id";
    //get the query
    $result = mysqli_query($con, $sql);
    //fetch to an array
    $pizza = mysqli_fetch_assoc($result);
}

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<?php include("templates/header.php"); ?>
<div class="container center">
    <?php if ($pizza): ?>
        <h4 class="center">Title: <?php echo htmlspecialchars($pizza['title']) ?></h4>
        <p>Ingredients: <?php echo htmlspecialchars($pizza['ingredients']) ?></p>
        <p>Created At: <?php echo htmlspecialchars($pizza['createda_at']) ?></p>
        <p>Email: <?php echo htmlspecialchars($pizza['email']) ?></p>

        <!-- -->
        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?>">
            <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
        </form>
    <?php else: ?>
        <h1>No Pizza</h1>
    <?php endif; ?>
</div>

<?php include("templates/footer.php"); ?>

</html>