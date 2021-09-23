<?php echo $GLOBALS['layout'] == 3 ? "<strong>" : "<h4>" ?>
<?php echo $k->datum != "" ? dow(date("N", strtotime($k->datum))) : ""; ?> <?php echo $k->datum ?>
<?php echo $GLOBALS['layout'] == 3 ? "</strong>" : "</h4>" ?>

<div class="table-responsive">
    <table class="table table-condensed table-striped">
        <thead>
            <tr>
                <th style="width: 4%"><?php echo S_NR ?></th>
                <th style="width: 10%"><?php echo S_GRUPP ?></th>
                <th style="width: 5%"><?php echo S_TID ?></th>
                <th style="width: 40%"><?php echo S_LAG_PLURAL ?></th>
                <th style="width: 16%"><?php echo S_RESULTAT ?></th>
                <th style="width: 15%"><?php echo S_PLATS ?></th>
                <th style="width: 10%"><?php echo S_ANM ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>