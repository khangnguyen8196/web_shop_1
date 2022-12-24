//sidebar

<div class="rightsidebar span_3_of_1">
    <div>
        <h2>CATEGORIES</h2>
        <?php
            $getAllCategory=$cat->show_category_frontend();
                if($getAllCategory){
                     while($result_cat=$getAllCategory->fetch_assoc()){
        ?> 
                        <ul>
                            <li><a href="productbycat.php?categoryId=<?php echo $result_cat['categoryId'] ?>"><?php echo $result_cat['catname'] ?></a></li>
                        </ul>
                    <?php
                     }       
                }
                    ?>
    </div>
  
</div>