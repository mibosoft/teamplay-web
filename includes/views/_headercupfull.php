<?php include "_head.php"; ?>

<body>
  <?php include_once("includes/analyticstracking.php") ?>

  <div id="fb-root"></div>
  <nav class="navbar navbar-fixed-top navbar-<?php echo $settings[0]->bool3 == 'true' ? "inverse" : "default" ?>">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only"><?php echo S_KLASSER ?></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <!--      <a class="navbar-brand" href="?home=<?php echo $_GET['home']; ?>&layout=1"><img alt="<?php echo $title ?>" src="assets/images/home.png"  class="img-responsive"></a> -->
        <a class="navbar-brand tpfont" href="?home=<?php echo $_GET['home']; ?>&layout=1"><b><?php echo $title ?></b> <span class="glyphicon glyphicon-home"></span></a>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo S_INFO ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&info"><?php echo S_INFORMATIONTAVLING ?></a></li>
              <?php echo $settings[0]->bool6 == 'true' ? "" : "<!--"; ?>
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&mapoverview"><?php echo S_OVERSIKTSKARTA ?></a></li>
              <?php echo $settings[0]->bool6 == 'true' ? "" : "-->"; ?>
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&news"><?php echo S_NYHETER ?></a></li>
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&rules"><?php echo S_REGLER ?></a></li>
              <?php echo $settings[0]->value8 == "1" ? "" : "<!--"; ?>
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&arenas"><?php echo S_SPELPLATSER ?></a></li>
              <?php echo $settings[0]->value8 == "1" ? "" : "-->"; ?>
              <?php echo $settings[0]->value12 == "1" ? "" : "<!--"; ?>
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&referees"><?php echo S_DOMARE ?></a></li>
              <?php echo $settings[0]->value12 == "1" ? "" : "-->"; ?>
              <?php if (is_array($menuItems)) {
                foreach ($menuItems as $menuItem) {
                  if ($menuItem['type'][0] == "1") {
                    echo '<li><a href="?home=' . $_GET['home'] . '&layout=1&userpage&scope=' . $menuItem['id'][0] . '">' . $menuItem['menutitle'][0] . '</a></li>';
                  }
                }
              } ?>
            </ul>
          </li>
          <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&teams&scope=all"><?php echo S_LAG_PLURAL ?></a></li>
          <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&overview"><?php echo S_KLASSER ?></a></li>
          <?php echo $settings[0]->value5 == "1" ? "" : "<!--"; ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo S_MATCHER ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&games&scope=all"><?php echo S_SAMTLIGAMATCHER ?></a></li>
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&bookedgames&scope=all"><?php echo S_BOKADEMATCHER ?></a></li>
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&unplayedgames&scope=all"><?php echo S_OSPELADEMATCHER ?></a></li>
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&latestgames&scope=all"><?php echo S_SENASTERESULTAT ?></a></li>
            </ul>
          </li>
          <?php echo $settings[0]->value5 == "1" ? "" : "-->"; ?>
          <?php echo $settings[0]->value11 == "1" ? "" : "<!--"; ?>
          <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&fairplay&scope=all"><?php echo S_FAIRPLAY ?></a></li>
          <?php echo $settings[0]->value11 == "1" ? "" : "-->"; ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo S_STATISTIK ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&teamstat&scope=all"><?php echo S_LAGSTATISTIK ?></a></li>
              <?php echo $settings[0]->value6 == "1" ? "" : "<!--"; ?>
              <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&playerstat&scope=all"><?php echo S_SPELARSTATISTIK ?></a></li>
              <?php echo $settings[0]->value6 == "1" ? "" : "-->"; ?>
            </ul>
          </li>
          <?php echo $settings[0]->bool8 == 'true' ? "" : "<!--"; ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo S_HISTORIK_ ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <?php echo $settings[0]->memo5 ?>
            </ul>
            <?php echo $settings[0]->bool8 == 'true' ? "" : "-->"; ?>
          </li>
          <?php if (is_array($menuItems)) {
            foreach ($menuItems as $menuItem) {
              if ($menuItem['type'][0] == "2") {
                echo '<li><a href="?home=' . $_GET['home'] . '&layout=1&userpage&scope=' . $menuItem['id'][0] . '">' . $menuItem['menutitle'][0] . '</a></li>';
              }
            }
          } ?>
          <?php echo ($settings[0]->bool7 == 'true' and !isHttps()) ? "" : "<!--"; ?>
          <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&refereeregistration"><?php echo S_INTRESSEANMALANDOMARE ?></a></li>
          <?php echo ($settings[0]->bool7 == 'true' and !isHttps()) ? "" : "-->"; ?>
          <?php echo ($settings[0]->bool7 == 'true' and isHttps()) ? "" : "<!--"; ?>
          <li><a href="<?php echo $settings[0]->string21 . '/' . $settings[0]->value21 . '/?intresseanmalan!=' . $GLOBALS['lang']  . '&' ?>" role="button" target="_blank"><?php echo S_INTRESSEANMALANDOMARE ?></a></li>
          <?php echo ($settings[0]->bool7 == 'true' and isHttps()) ? "" : "-->"; ?>
          <?php echo $settings[0]->value27 == "1" ? "" : "<!--"; ?>
          <li><a href="?home=<?php echo $_GET['home']; ?>&layout=1&registration"><?php echo S_ANMALAN ?></a></li>
          <?php echo $settings[0]->value27 == "1" ? "" : "-->"; ?>
        </ul>
        <?php echo $settings[0]->value15 == "1" ? "" : "<!--"; ?>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="<?php echo $settings[0]->string21 . '/' . $settings[0]->value21; ?>" target="_blank"><?php echo S_LOGGAIN ?></a></li>
        </ul>
        <?php echo $settings[0]->value15 == "1" ? "" : "-->"; ?>
      </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->