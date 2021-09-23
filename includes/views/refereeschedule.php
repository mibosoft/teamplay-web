<?php render('_headercup', array('title' => $baseInfo->bas->namn, 'settings' => $settings, 'menuItems' => $menuItems)) ?>

<div class="content">
    <h2><?php echo S_DOMARSCHEMA . " - " . $name ?></h2>

    <div class="table-responsive">
        <table class="table table-condensed table-striped">
            <thead>
                <tr>
                    <th><?php echo S_TID ?></th>
                    <th><?php echo S_GRUPP ?></th>
                    <th><?php echo S_NR ?></th>
                    <th><?php echo S_LAG_PLURAL ?></th>
                    <th><?php echo S_PLATS ?></th>
                    <th><?php echo S_DOMARE ?></th>
                    <th><?php echo S_ANM ?></th>
                </tr>
            </thead>
            <tbody>
                <?php render($refereeSchedule, array('view' => '_refereeschedule', 'settings' => $settings)) ?>
            </tbody>
        </table>
    </div>

</div><!-- /.content -->

<?php render('_footercup', array('baseInfo' => $baseInfo, 'settings' => $settings)) ?>