<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

?>
<div class="site-index">

    <div class="jumbotron">
        <!-- <h1>Congratulations!</h1> -->
        <p class="lead">Total Result  of all polling unit under  each particular Local Government</p>

    </div>

    <div class="body-content">

        <div class="row">
            <ul class="list-group">
                <?php foreach ($rows as $row) { ?>
                    <li class='list-group-item'><?= $row['lga_name'] ?> <span class='badge'><?= $row['uniquewardid'] ?></span></li>
                <?php } ?>
                
            </ul>
        </div>

    </div>
</div>
