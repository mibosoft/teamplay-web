<?php render('_headercup', array('title' => $baseInfo->bas->namn, 'settings' => $settings, 'menuItems' => $menuItems)) ?>

<div class="content">
        <h2><?php echo S_SPELARSTATISTIK ?></h2>

        <ul class="nav nav-pills" role="tablist">
                <li role="presentation" <?php echo ($_GET['scope'] == "all" ? 'class="active"' : '') ?>><a href="?playerhighlights&home=<?php echo $_GET['home'] ?>&scope=all&layout=<?php echo $GLOBALS['layout']; ?>&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo S_SAMTLIGA ?></a></li>
                <?php foreach ($classes as $x) {
                        echo '<li role="presentation" ' . ($x->grp_nr == $_GET['scope'] ? 'class="active"' : '') . '><a href="?playerhighlights&home=' . $_GET['home'] . '&scope=' . $x->grp_nr . '&layout=' . $GLOBALS['layout'] . '&lang=' . $GLOBALS['lang'] . '">' . $x->grp_nr . '</a></li>';
                } ?>
        </ul>
        <br>

        <div class="table-responsive">
                <table class="table table-condensed table-striped">
                        <thead>
                                <tr>
                                        <th><?php echo S_MATCHNR ?></th>
                                        <th><?php echo S_SPELARE ?></th>
                                        <th><?php echo S_LAG ?></th>
                                        <th><?php echo S_KLASS ?></th>
                                        <th title="<?php echo S_POANGPOINTS ?>"><?php echo S_PTS ?></th>
                                </tr>
                        </thead>
                        <tbody>
                                <?php render($playerstat, array('view' => '_playerhighlights', 'baseInfo' => $baseInfo)) ?>
                        </tbody>
                </table>
        </div>

</div><!-- /.content -->

<?php render('_footercup', array('baseInfo' => $baseInfo, 'settings' => $settings)) ?>