<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<style>
    .leftside { float: left; width: 70% }
</style> 
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Social Media Links</h2>
    <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $website = $fm->validation($_POST['website']);
            $email = $fm->validation($_POST['email']);

            $facebook = $fm->validation($_POST['facebook']);
            $twitter = $fm->validation($_POST['twitter']);
            $linkedin = $fm->validation($_POST['linkedin']);
            $googleplus = $fm->validation($_POST['googleplus']);

            $website = mysqli_real_escape_string($db->link, $website);
            $email = mysqli_real_escape_string($db->link, $email);

            $facebook = mysqli_real_escape_string($db->link, $facebook);
            $twitter = mysqli_real_escape_string($db->link, $twitter);
            $linkedin = mysqli_real_escape_string($db->link, $linkedin);
            $googleplus = mysqli_real_escape_string($db->link, $googleplus);

            if ($website == "" || $email == "" || $facebook == "" || $twitter == "" || $linkedin == "" || $googleplus == "") {
                echo "<span class='error'>Field cannot be empty</span>";
            } else {
                $query = "UPDATE tbl_social SET website = '$website', email = '$email', facebook = '$facebook', twitter = '$twitter', linkedin = '$linkedin', googleplus = '$googleplus' 
                            WHERE id = '1' ";
                $updatedrow = $db->update($query);
                if ($updatedrow) {
                    echo "<span class='success'>Data updated successfully</span>";
                } else {
                    echo "<span class='error'>Data not updated</span>";
                }
            }
        }
    ?> 

        <div class="block"> 
    <?php 
        $query = "SELECT * FROM tbl_social WHERE id='1' ";
        $socialmedia = $db->select($query);
        if ($socialmedia) {
            while ($result = $socialmedia->fetch_assoc()) {
    ?>   <div class="leftside">         
         <form action="social.php" method="post" enctype="multipart/form-data">
            <table class="form">					
                <tr>
                    <td> <label>Website</label> </td>
                    <td> <input type="text" name="website" value="<?php echo $result['website']; ?>" 
                            class="medium" /> </td>
                </tr>

				 <tr>
                    <td> <label>Email</label> </td>
                    <td> <input type="email" name="email" value="<?php echo $result['email']; ?>" 
                            class="medium" /> </td>
                </tr>

                <tr>
                    <td> <label>Facebook</label> </td>
                    <td> <input type="text" name="facebook" value="<?php echo $result['facebook']; ?>" 
                            class="medium" /> </td>
                </tr>
                
				 <tr>
                    <td> <label>Twitter</label> </td>
                    <td> <input type="text" name="twitter" value="<?php echo $result['twitter']; ?>" 
                            class="medium" /> </td>
                </tr>
				
				 <tr>
                    <td> <label>LinkedIn</label> </td>
                    <td> <input type="text" name="linkedin" value="<?php echo $result['linkedin']; ?>" 
                            class="medium" /> </td>
                </tr>
				
				 <tr>
                    <td> <label>Google Plus</label> </td>
                    <td> <input type="text" name="googleplus" value="<?php echo $result['googleplus']; ?>" 
                            class="medium" /> </td>
                </tr>
				
				 <tr>
                    <td></td>
                    <td> <input type="submit" name="submit" Value="Update" /> </td>
                </tr>
            </table>
            </form>
        </div>
        <?php } } ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>