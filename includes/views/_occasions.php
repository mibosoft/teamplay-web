  <div class="timeline-event">
    <div class="content-<?php echo ((strtoupper(substr($k->nr, 0, 1)) == 'A' and $baseInfo->bas->a_hand_hem == 'true') or strtoupper(substr($k->nr, 0, 1)) == 'H') ? 'left' : 'right' ?>">
      <?php $hasAssist = (empty($k->spelare_a1) ? false : true) ?>
      <?php $hasAssist2 = (empty($k->spelare_a2) ? false : true) ?>
      <?php $isPenalty = (empty($k->utv) ? false : true) ?>
      <p><?php echo $k->spelare ?> <?php echo $hasAssist ? '(' . $k->spelare_a1 . ($hasAssist2 ? ', ' . $k->spelare_a2 : '') . ')' : '' ?> <?php echo (empty($k->kod) ? '' : '(' . $k->kod . ')') ?>
        <span class="event-number"><?php echo ($isPenalty ? '<big><span class="label label-primary">' . $k->utv . '</span></big>' : '<big><span class="label label-danger">' . $k->h . '-' . $k->b . '</span></big>') ?></span>
      </p>
    </div>
    <div class="meta-time">
      <span class="time"><?php echo $k->tid ?></span>
    </div>
  </div>