<?php render('_headercup', array('title' => $baseInfo->bas->namn, 'settings' => $settings, 'menuItems' => $menuItems)) ?>

<div class="container">
  <div class="content">
    <h2><?php echo S_NYHETER ?></h2>

    <?php
    if (is_array($news)) {
      foreach ($news as $x) {
        echo '<p><a name="' . $x->datumtid . '"></a>';
        echo '<hr>';
        echo '<p><small>' . str_replace('T', ' ', $x->datumtid) . '</small></p>';
        echo '<h3>' . $x->rubrik . '</h3>';
        echo '<p>' . $x->sammanf . '</p>';
        echo '<p>' . $x->mer_info . '</p>';
      }
    }
    ?>

  </div>
  <!-- /.content -->
</div>

<?php render('_footercup', array('baseInfo' => $baseInfo, 'settings' => $settings)) ?>