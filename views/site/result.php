<?php

/* @var $this yii\web\View */


?>
<div class="site-index">

    <div class="jumbotron">
        <!-- <h1>Congratulations!</h1> -->
        <p class="lead">Total Result  of all polling unit under  each particular Local Government</p>

    </div>

    <div class="body-content">

        <div class="row">
            <ul class="list-group">
                <?php foreach ($results as $row) { ?>
                    <li class='list-group-item'><?= $row['party_abbreviation'] ?> <span class='badge'><?= $row['party_score'] ?></span></li>
                <?php } ?>
                
            </ul>
        </div>

    </div>
</div>
