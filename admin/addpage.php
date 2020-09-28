<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Page</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $name    = mysqli_real_escape_string($db->link, $_POST['name']);
        $body = mysqli_real_escape_string($db->link, $_POST['body']);

    if ($name == "" || $body == "") {
           echo "<span class='error'>Field is empty and cannot be saved</span> ";
        } else {
            $query = "INSERT INTO tbl_pages (name,body) VALUES ('$name','$body') ";
            $pageinsert = $db->insert($query);
            if ($pageinsert) {
                echo "<span class='success'>You added a new Page</span> ";
            } else {
                echo "<span class='error'>The page was not saved</span> ";
            }

        }
    }
?>
        <div class="block">               
         <form action="addpage.php" method="post">
            <table class="form">
             
                <tr>
                    <td> <label>Title</label> </td>
                    <td> <input type="text" name="name" placeholder="Enter the title here ..." 
                        class="medium" /> </td>
                </tr>          

                <tr>
                    <td style="vertical-align: top; padding-top: 9px;"> <label>Content</label> </td>
                    <td> <textarea class="tinymce" name="body" ></textarea> </td>
                </tr>

            	<tr>
                    <td></td>
                    <td> <input type="submit" name="submit" Value="Save" /> </td>
                </tr>

            </table>
            </form>
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