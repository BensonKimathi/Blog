<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
    if (!isset($_GET['viewsliderid']) || $_GET['viewsliderid'] == NULL) {
        echo "<script> window.location= 'sliderlist.php'; </script>";
    } else {
        $id = $_GET['viewsliderid'];
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Slider</h2>
        <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    }
?>              
<?php 
        $query = "SELECT * FROM tbl_slider WHERE id = '$id' ORDER BY id DESC";
        $slider = $db->select($query);
        while ($result = $slider->fetch_assoc()) {
            
?>
        <div class="block">
       <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
             
                <tr>
                    <td> <label>Title</label> </td>
                    <td> <input type="text" readonly value="<?php echo $result['title']; ?> " 
                        class="medium" /> </td>
                </tr>   

                <tr>
                    <td style="vertical-align: top; padding-top: 9px;"> <label>Description</label> </td>
                    <td> <textarea class="tinymce" name="description" >
                        <?php echo $result['description']; ?>
                    </textarea> </td>
                </tr>

                <tr>
                    <td> <label>Slider Image</label> </td>
                    <td> <img src="<?php echo $result['image']; ?>" height="100px" weight="250px" /> 
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td> <input type="submit" name="submit" Value="Okay" /> </td>
                </tr>

            </table>
            </form>
<?php } ?>
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