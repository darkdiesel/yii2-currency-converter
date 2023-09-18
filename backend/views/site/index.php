<?php

/** @var yii\web\View $this */

$this->title = 'Currency Converter Admin Panel';

use yii\helpers\Url;
?>
<div class="site-index">


    <div class="body-content">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <ul class="list-group">
                    <li class="list-group-item list-group-item-action">
                        <a href="<?php echo Url::toRoute(['currency/index']); ?>">Currencies</a>
                    </li>
                    <li class="list-group-item list-group-item-action">
                        <a href="<?php echo Url::toRoute(['currency-values/index']); ?>">Currency values</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
