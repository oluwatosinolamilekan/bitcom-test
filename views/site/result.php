<?php

/* @var $this yii\web\View */


?>
<div class="site-index">


    <div class="body-content">

        <div class="row">
            <div class="col-md-3">
                <?php foreach ($results as $row) { ?>
                    <li class='list-group-item'><?= $row['party_abbreviation'] ?> <span class='badge'><?= $row['party_score'] ?></span></li>
                <?php } ?>
                
            </div>
        </div>

    </div>
</div>
