<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Themes</h2>
        <div class="block copyblock"> 
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $theme = mysqli_real_escape_string($db->link, $_POST['theme']);
        
            $query = "UPDATE tbl_theme SET theme ='$theme' WHERE themeId = '1' ";
            $updated_row = $db->update($query);
            if ($updated_row) {
                echo "<span class='success'>Theme was edited successfully</span> ";
            } else {
                echo "<span class='error'>Theme editing was unsuccessful</span> ";
            }
    }
?>
    <?php 
        $query = "SELECT * FROM tbl_theme WHERE themeId = '1' ";
        $themes = $db->select($query);
        while ($result = $themes->fetch_assoc()) {  
    ?> 
    <form action="" method="POST">
        <table class="form">
            <tr>
                <td> <input <?php if ($result['theme'] == 'default') { echo "checked";} ?> type="radio" name="theme" value="default" />Default</td>
            </tr>
            <tr>
                <td> <input <?php if ($result['theme'] == 'green') { echo "checked";} ?> type="radio" name="theme" value="green" />Green</td>
            </tr>
            <tr>
                <td> <input <?php if ($result['theme'] == 'red') { echo "checked";} ?> type="radio" name="theme" value="red" />Red</td>
            </tr>
            <tr>
                <td> <input type="submit" name="submit" Value="Save" /> </td>
             </tr>
        </table>
    </form>
    <?php  } ?>
     </div>

 </div>
</div>
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