<div class="site-index">

    <div class="jumbotron">
        <h1>Заработная плата сотрудников</h1>
    </div>

    <div class="body-content">
        <div class="row">

            <?php
                foreach ($oManagers as $oManager) {
                    echo '<div class="col-lg-4"><span class="full-name">' . $oManager->full_name . '</span><span> / итого = '
                        . $oManager->total_wages . '</span>';

                        echo '<div><br>История начисления бонусов';
                        foreach ($oManager->bonus_history as $date=>$wages) {
                            echo '<div><span>' . $date . '</span><span> - ' . $wages . '</span></div>';

                        }
                        echo '</div></div>';
                }
            ?>

        </div>

    </div>
</div>
