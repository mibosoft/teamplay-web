<?php render('_headercup', array('title' => $baseInfo->bas->namn, 'settings' => $settings, 'menuItems' => $menuItems)) ?>

<style>
  @media (max-width: 767px) {
    #teams-directory-table thead,
    #teams-directory-table tbody td::before {
      display: none;
    }

    #teams-directory-table tbody td:nth-child(2),
    #teams-directory-table tbody td:nth-child(4) {
      display: none;
    }

    #teams-directory-table tbody td {
      border-bottom: 0;
    }

    #teams-directory-table tbody tr {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    #teams-directory-table tbody td:first-child {
      display: block;
      flex: 1 1 auto;
      min-width: 0;
      text-align: left;
    }

    #teams-directory-table tbody td:first-child span {
      display: flex !important;
      min-width: 0;
      white-space: normal !important;
    }

    #teams-directory-table tbody td:first-child a {
      min-width: 0;
      overflow-wrap: anywhere;
    }

    #teams-directory-table tbody td:nth-child(3) {
      display: block;
      flex: 0 0 auto;
      text-align: right;
      white-space: nowrap;
    }
  }
</style>

<div class="container">
  <div class="content">
    <h2><?php echo S_LAG_PLURAL ?></h2>

    <ul class="nav nav-pills" role="tablist">
      <li role="presentation" <?php echo ($_GET['scope'] == "all" ? 'class="active"' : '') ?>><a href="?teams&home=<?php echo $_GET['home'] ?>&scope=all&layout=<?php echo $GLOBALS['layout']; ?>&lang=<?php echo $GLOBALS['lang']; ?>"><?php echo S_SAMTLIGA ?></a></li>
      <?php
      if (is_array($classes)) {
        foreach ($classes as $x) {
          echo '<li role="presentation" ' . ($x->grp_nr == $_GET['scope'] ? 'class="active"' : '') . '><a href="?teams&home=' . $_GET['home'] . '&scope=' . $x->grp_nr . '&layout=' . $GLOBALS['layout'] . '&lang=' . $GLOBALS['lang'] . '">' . $x->grp_nr . '</a></li>';
        }
      }
      ?>
    </ul>
    <div class="mt-3 flex w-full items-center justify-end gap-2 text-sm font-medium text-slate-600">
      <span><?php echo S_ANTAL ?>:</span>
      <span class="inline-flex min-w-8 items-center justify-center rounded-full bg-slate-900 px-2 py-1 text-xs font-bold text-white"><?php echo $count ?></span>
    </div>

    <?php echo $settings[0]->bool4 == "true" ? "" : "<!--" ?>
    <div class="row">
      <div id="map-container" class="col-md-12"></div>
    </div>
    <script type="text/javascript">
      var map;
      var teamMarkers = [];
      var infowindow;

      async function initMap() {
        map = new google.maps.Map(document.getElementById('map-container'), {
          zoom: 6,
          maxZoom: 16,
          mapTypeControl: false,
          center: {
            lat: 59.3325800,
            lng: 18.0649000
          }
        });

        infowindow = new google.maps.InfoWindow({});

        var teamLocations = [
          <?php
          if (is_array($teams)) {
            foreach ($teams as $x) {
              if (!empty($x->arena)) {
                // echo '["' . $x->klubb . ' (' . $x->klass . ')",' . $x->arena . ',1' . '],';
                echo '["' . $x->klubb . '",' . $x->arena . ',1,"' . $x->klass . '","' . $x->ort . '","' . $x->drakt . '"],';
              }
            }
          }
          ?>
        ];
        setMarkers(map, teamLocations);
        AutoCenter();
      }

      function setMarkers(map, teamLocations) {
        var image = {
          url: 'assets/images/locationflag.png',
          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(20, 32),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 32)
        };
        var shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: 'poly'
        };
        for (var i = 0; i < teamLocations.length; i++) {
          var teamLocation = teamLocations[i];
          var marker = new google.maps.Marker({
            position: {
              lat: teamLocation[1],
              lng: teamLocation[2]
            },
            map: map,
            icon: image,
            shape: shape,
            title: teamLocation[0],
            zIndex: teamLocation[3],
            infotext: '<h3>' + teamLocation[0] + '</h3>' + '<?php echo S_KLASS ?>' + ': ' + teamLocation[4] + '<br><?php echo S_ORT ?>' + ': ' + teamLocation[5] + '<br><?php echo S_DRAKTFARG ?>' + ': ' + teamLocation[6] + '<br>GPS: ' + teamLocation[1] + ',' + teamLocation[1]
          });
          teamMarkers.push(marker);
          marker.addListener('click', function() {
            infowindow.setContent(this.infotext);
            infowindow.open(map, this);
          });
        }
      }

      function AutoCenter() {
        if (teamMarkers.length > 0) {
          var bounds = new google.maps.LatLngBounds();
          $.each(teamMarkers, function(index, marker) {
            bounds.extend(marker.position);
          });
          map.fitBounds(bounds);
        }
      }

      $(window).resize(function() {
        var h = $(window).height() * 0.4,
          offsetTop = 20; // Calculate the top offset
        $('#map-container').css('height', (h - offsetTop));
      }).resize();
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDkTnb5G_YoNkyUnTAMPL69n8SrjaxlA8g&loading=async&callback=initMap">
    </script>
    <br>
    <?php echo $settings[0]->bool4 == "true" ? "" : "-->" ?>

    <div class="table-responsive">
      <table id="teams-directory-table" class="table table-condensed table-striped">

        <thead>
          <tr>
            <th><?php echo S_LAG ?></th>
            <th>&nbsp;</th>
            <th><?php echo S_KLASS ?></th>
            <?php echo ($settings[0]->value14 == "0") ? "<!--" : "" ?>
						<th><?php echo S_GRUPP ?></th>
            <?php echo ($settings[0]->value14 == "0") ? "-->" : "" ?>
          </tr>
        </thead>
        <tbody>
          <?php 
          if (is_array($teams)) {
            render($teams, array('view' => '_teams', 'settings' => $settings));
          }
          ?>

        </tbody>
      </table>
    </div>
    <p>
      <i>
        <?php echo ($settings[0]->bool24 == "true" ? "<b>*</b> = " . S_RESERV : "") ?><br>
        <?php echo ($settings[0]->bool23 == "true" ? "<b>" . S_FETSTIL . "</b> = " . S_AVGIFTBET : "") ?>
      </i>
      <!--
		echo "<b>*</b> = " . S_RESERV . ", <b>" . S_FETSTIL . "</b> = " . S_AVGIFTBET?></i>
-->
    </p>
  </div>
  <!-- /.content -->
</div>

<?php render('_footercup', array('baseInfo' => $baseInfo, 'settings' => $settings)) ?>