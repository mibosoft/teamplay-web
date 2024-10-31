<?php render('_headercup', array('title' => $baseInfo->bas->namn, 'settings' => $settings, 'menuItems' => $menuItems)) ?>

<div class="container">
        <div class="content">
                <h2><?php echo S_SPELARSTATISTIK ?></h2>

                <br>
                <ul class="nav nav-pills" role="tablist">
                        <li role="presentation" <?php echo ($_GET['scope'] == "all" ? 'class="active"' : '') ?>><a href="?playerstat&home=<?php echo $_GET['home'] ?>&scope=all&sort=<?php echo $_GET['sort']; ?>&layout=<?php echo $GLOBALS['layout']; ?>&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo S_SAMTLIGA ?></a></li>
                        <?php foreach ($classes as $x) {
                                echo '<li role="presentation" ' . ($x->grp_nr == $_GET['scope'] ? 'class="active"' : '') . '><a href="?playerstat&home=' . $_GET['home'] . '&scope=' . $x->grp_nr . '&sort=' . $_GET['sort'] . '&layout=' . $GLOBALS['layout'] . '&lang=' . $GLOBALS['lang'] . '">' . $x->grp_nr . '</a></li>';
                        } ?>
                </ul>
                <br>

                <div class="table-responsive">
                        <table class="table table-condensed table-striped">
                                <thead>
                                        <tr>
                                                <th><?php echo S_SPELARE ?></th>
                                                <th><?php echo S_LAG ?></th>
                                                <th><?php echo S_KLASS ?></th>
                                                <th title="<?php echo S_ANTALSPELADEMATCHERGAMESPLAYED ?>"><?php echo S_GP ?></th>
                                                <th title="<?php echo S_HALPOANG . ' (' . S_VI . '-' . S_FO . ')' ?>"><?php echo S_HP ?></th>
                                                <th title="<?php echo S_POANG_MTCH ?>"><i><?php echo S_HP_GP ?></i></th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <?php render($playerstat, array('view' => '_playerstatgolf', 'baseInfo' => $baseInfo)) ?>
                                </tbody>
                        </table>
                </div>
                <small><i>
                                <?php echo S_GP ?>=<?php echo S_ANTALSPELADEMATCHERGAMESPLAYED ?>,
                                <?php echo S_HP ?>=<?php echo S_HALPOANG ?>,
                        </i></small>

        </div><!-- /.content -->
</div>

<?php render('_footercup', array('baseInfo' => $baseInfo, 'settings' => $settings)) ?>