<div class="slidersection templete clear">
        <div id="slider">
            <?php 
                $query = "SELECT * FROM tbl_slider ORDER BY id LIMIT 5 ";
                $slider = $db->select($query);
                if ($slider) {
                    while ($result = $slider->fetch_assoc()) {                        
            ?>

            <a href="#">
            	<img src="admin/<?php echo $result['image']; ?>" alt="<?php echo $result['description']; ?>" title="<?php echo $result['title']; ?>" />
            </a>
        <?php } } ?>
            
            </a>
        </div>

</div>