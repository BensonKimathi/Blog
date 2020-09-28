<?php include '../lib/Session.php'; 
Session::checkSession();
?>

<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>

<?php
    $db = new Database();
?>

<?php
    if (!isset($_GET['delpage']) || $_GET['delpage'] == NULL) {
        echo "<script> window.location= 'index.php'; </script>";
    } else {
        $pageid = $_GET['delpage'];

        $delquery = "DELETE FROM tbl_pages WHERE id = '$pageid' ";
        $delPage = $db->delete($delquery);
        if ($delPage) {
            echo "<script>alert('Page deleted successfully');</script>";
            echo "<script>window.location = 'index.php' ;</script>";            
        } else {
            echo "<script>alert('Page not deleted');</script>";
            echo "<script>window.location = 'index.php' ;</script>"; 
        }
    }
    ?>

<script type="text/javascript" src="js/tiny-mce/jquery.tinymce.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include 'inc/footer.php'; ?>