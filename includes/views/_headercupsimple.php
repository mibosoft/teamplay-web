<?php include "_head.php"; ?>

<body>
  <?php include_once("includes/analyticstracking.php") ?>

  <div class="container">
    <div class="row row-offcanvas row-offcanvas-right">
      <div class="col-xs-12 col-sm-9">
        <?php echo $GLOBALS['layout'] == 3 ? "<!--" : "" ?>
        <div class="row">
          <div class="col-sm-12">
            <ul class="nav nav-tabs">
              <li role="presentation" <?php echo (isset($_GET['teams']) ? 'class="active"' : '') ?>><a href="?home=<?php echo $_GET['home']; ?>&layout=2&teams&scope=all&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo S_LAG_PLURAL ?></a></li>
              <li role="presentation" <?php echo (isset($_GET['overview']) ? 'class="active"' : '') ?>><a href="?home=<?php echo $_GET['home']; ?>&layout=2&overview&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo S_KLASSER ?></a></li>
              <li role="presentation" class="<?php echo ((isset($_GET['games']) or isset($_GET['latestgames']) or isset($_GET['unplayedgames'])) ? 'dropdown tab-pane active' : 'dropdown') ?>">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php echo S_MATCHER ?><span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a href="?home=<?php echo $_GET['home']; ?>&layout=2&games&scope=all&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo S_SAMTLIGAMATCHER ?></a></li>
                  <li role="presentation"><a href="?home=<?php echo $_GET['home']; ?>&layout=2&unplayedgames&scope=all&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo S_OSPELADEMATCHER ?></a></li>
                  <li role="presentation"><a href="?home=<?php echo $_GET['home']; ?>&layout=2&latestgames&scope=all&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo S_SENASTERESULTAT ?></a></li>
                </ul>
              </li>
              <?php echo ($settings[0]->value11 == "1" or $GLOBALS['layout'] == 3) ? "" : "<!--"; ?>
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=2&fairplay&scope=all&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo S_FAIRPLAY ?></a></li>
              <?php echo ($settings[0]->value11 == "1" or $GLOBALS['layout'] == 3) ? "" : "-->"; ?>
              <?php echo $settings[0]->value8 == "1" ? '<li role="presentation" ' . (isset($_GET['arenas']) ? 'class="active"' : '') . '><a href="?home=' . $_GET['home'] . '&layout=2&arenas&lang=' . $GLOBALS['lang'] . '">' . S_SPELPLATSER . '</a></li>' : ""; ?>
              <li role="presentation" <?php echo (isset($_GET['teamstat']) ? 'class="active"' : '') ?>><a href="?home=<?php echo $_GET['home']; ?>&layout=2&teamstat&scope=all&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo S_LAGSTATISTIK ?></a></li>
              <?php echo $settings[0]->value6 == "1" ? '<li role="presentation" ' . (isset($_GET['playerstat']) ? 'class="active"' : '') . '><a href="?home=' . $_GET['home'] . '&layout=2&playerstat&scope=all&lang=' . $GLOBALS['lang'] . '">' . S_SPELARSTATISTIK . '</a></li>' : ""; ?>
              <li role="presentation"><a title="<?php echo S_OPPNAEGETFONSTER ?>" href="?home=<?php echo $_GET['home']; ?>&layout=2&overview&lang=<?php echo $GLOBALS['lang']; ?>" target=_blank"><span class="glyphicon glyphicon-new-window"></span></a></li>
            </ul>
          </div>
        </div>
        <?php echo $GLOBALS['layout'] == 3 ? "-->" : "" ?>