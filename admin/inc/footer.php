<div class="clear"> </div>
</div>
<div class="clear"> </div>
<div id="site_info">
    <?php 
        $squery = "SELECT * FROM tbl_social WHERE id='1' ";
        $socialmedia = $db->select($squery);
        if ($socialmedia) {
            while ($sresult = $socialmedia->fetch_assoc()) {
    ?>
    
    <?php 
        $query = "SELECT * FROM tbl_title_slogan_logo WHERE id='1' ";
        $blog_title = $db->select($query);
        if ($blog_title) {
            while ($result = $blog_title->fetch_assoc()) {
    ?>
    
    <p> &copy; Copyright <a href="<?php echo $sresult['website']; ?>"><?php echo $result['title']; ?></a>. All Rights Reserved. </p>
    <?php } } ?>
    <?php } } ?>
</div>
</body>
</html>
