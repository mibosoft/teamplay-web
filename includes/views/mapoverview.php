<?php render('_headercup', array('title' => $baseInfo->bas->namn, 'settings' => $settings, 'menuItems' => $menuItems)) ?>

<div class="content">
  <h2><?php echo S_OVERSIKTSKARTA ?></h2>

  <div class="row">
    <div class="col-md-12">
      <button class="btn btn-default btn-sm active" data-toggle="button" aria-pressed="true" id="btn-show-arenas" type="button">
        <img width="16" height="19" src="assets/images/arena.png"> <?php echo S_SPELPLATSER ?>
      </button>

      <?php echo empty($foodplaces) ? "<!--" : "" ?>
      <button class="btn btn-default btn-sm" data-toggle="button" id="btn-show-food" type="button">
        <img width="16" height="19" src="assets/images/food.png"> <?php echo S_MATSTALLEN ?>
      </button>
      <?php echo empty($foodplaces) ? "-->" : "" ?>

      <?php echo empty($lodgingplaces) ? "<!--" : "" ?>
      <button class="btn btn-default btn-sm" data-toggle="button" id="btn-show-lodging" type="button">
        <img width="16" height="19" src="assets/images/lodging.png"> <?php echo S_BOENDE ?>
      </button>
      <?php echo empty($lodgingplaces) ? "-->" : "" ?>

      <?php echo empty($otherplaces) ? "<!--" : "" ?>
      <button class="btn btn-default btn-sm" data-toggle="button" id="btn-show-other" type="button">
        <img width="16" height="19" src="assets/images/other.png"> <?php echo S_OVRIGT ?>
      </button>
      <?php echo empty($otherplaces) ? "-->" : "" ?>
    </div>
  </div>
  <br>
  <div class="row">
    <div id="map-container" class="col-md-12"></div>
  </div>
  <br>
  <p>
    <i><?php echo S_KLICKAFORINFO ?></i>
  </p>

  <script type="text/javascript">
    var map;
    var allMarkers = [];
    var arenaMarkers = [];
    var lodingMarkers = [];
    var foodMarkers = [];
    var otherMarkers = [];
    var arenasHidden = false;
    var foodHidden = true;
    var lodgingHidden = true;
    var otherHidden = true;

    var infowindow;

    function initMap() {
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

      var setBtn = document.getElementById('btn-show-arenas');
      setBtn.onclick = function() {
        if (arenasHidden) {
          showMarkers(arenaMarkers);
        } else {
          clearMarkers(arenaMarkers);
        }
        arenasHidden = !arenasHidden;
      };

      var setBtn = document.getElementById('btn-show-food');
      if (setBtn != undefined) {
        setBtn.onclick = function() {
          if (foodHidden) {
            showMarkers(foodMarkers);
          } else {
            clearMarkers(foodMarkers);
          }
          foodHidden = !foodHidden;
        };
      }

      var setBtn = document.getElementById('btn-show-lodging');
      if (setBtn != undefined) {
        setBtn.onclick = function() {
          if (lodgingHidden) {
            showMarkers(lodingMarkers);
          } else {
            clearMarkers(lodingMarkers);
          }
          lodgingHidden = !lodgingHidden;
        };
      }

      var setBtn = document.getElementById('btn-show-other');
      if (setBtn != undefined) {
        setBtn.onclick = function() {
          if (otherHidden) {
            showMarkers(otherMarkers);
          } else {
            clearMarkers(otherMarkers);
          }
          otherHidden = !otherHidden;
        };
      }

      var arenaLocations = [
        <?php
        if (is_array($arenas)) {
          foreach ($arenas as $x) {
            if (!empty($x->longlat)) {
              echo '["' . $x->namn . '",' . $x->longlat . ',1' . ',"' . $x->adress . '","' . $x->ort . '","' . $x->info . '"],';
            }
          }
        }
        ?>
      ];
      setMarkers(arenaLocations, arenaMarkers, "assets/images/arena.png");

      var lodingLocations = [
        <?php
        if (is_array($lodgingplaces)) {
          foreach ($lodgingplaces as $x) {
            if (!empty($x->longlat)) {
              echo '["' . $x->namn . '",' . $x->longlat . ',1' . ',"' . $x->adress . '","' . $x->ort . '","' . $x->info . '"],';
            }
          }
        }
        ?>
      ];
      setMarkers(lodingLocations, lodingMarkers, "assets/images/lodging.png");
      clearMarkers(lodingMarkers);

      var foodLocations = [
        <?php

        if (is_array($foodplaces)) {
          foreach ($foodplaces as $x) {
            if (!empty($x->longlat)) {
              echo '["' . $x->namn . '",' . $x->longlat . ',1' . ',"' . $x->adress . '","' . $x->ort . '","' . $x->info . '"],';
            }
          }
        }
        ?>
      ];
      setMarkers(foodLocations, foodMarkers, "assets/images/food.png");
      clearMarkers(foodMarkers);

      var otherLocations = [
        <?php
        if (is_array($otherplaces)) {
          foreach ($otherplaces as $x) {
            if (!empty($x->longlat)) {
              echo '["' . $x->namn . '",' . $x->longlat . ',1' . ',"' . $x->adress . '","' . $x->ort . '","' . $x->info . '"],';
            }
          }
        }
        ?>
      ];
      setMarkers(otherLocations, otherMarkers, "assets/images/other.png");
      clearMarkers(otherMarkers);

      //Main marker
      var longlat = [<?php echo $baseInfo->bas->longlat ?>];
      var marker = new google.maps.Marker({
        position: {
          lat: longlat[0],
          lng: longlat[1]
        },
        title: '<?php echo $baseInfo->bas->namn ?>',
        icon: "assets/images/start.png",
        map: map,
        infotext: '<h3>' + '<?php echo $baseInfo->bas->namn ?>' + '</h3>' + '<?php echo S_ADRESS ?>' + ': ' + '<?php echo $baseInfo->bas->adress ?>' + ' ' + '<?php echo $baseInfo->bas->plats ?>' + '<br>GPS: ' + '<?php echo $baseInfo->bas->longlat ?>'
      });
      marker.addListener('click', function() {
        infowindow.setContent(this.infotext);
        infowindow.open(map, this);
      });
      arenaMarkers.push(marker);
      allMarkers.push(marker);
      AutoCenter(allMarkers);
      //  map.setCenter({lat: 59.3325800, lng: 18.0649000});
    }

    function setMarkers(mapLocations, markerArray, icon) {
      var image = {
        url: icon,
        // This marker is 20 pixels wide by 32 pixels high.
        size: new google.maps.Size(32, 37),
        // The origin for this image is (0, 0).
        origin: new google.maps.Point(0, 0),
        // The anchor for this image is the base of the flagpole at (0, 32).
        anchor: new google.maps.Point(16, 32)
      };
      for (var i = 0; i < mapLocations.length; i++) {
        var mapLocation = mapLocations[i];
        var marker = new google.maps.Marker({
          position: {
            lat: mapLocation[1],
            lng: mapLocation[2]
          },
          map: map,
          icon: image,
          title: mapLocation[0],
          zIndex: mapLocation[3],
          infotext: '<h3>' + mapLocation[0] + '</h3>' + mapLocation[6] + '<br><br>' + '<?php echo S_ADRESS ?>' + ': ' + mapLocation[4] + ' ' + mapLocation[5] + '<br>GPS: ' + mapLocation[1] + ',' + mapLocation[2]
        });
        marker.addListener('click', function() {
          infowindow.setContent(this.infotext);
          infowindow.open(map, this);
        });
        markerArray.push(marker);
        allMarkers.push(marker);
      }
    }

    //Sets the map on all markers in the array.
    function setMapOnAll(map, markerArray) {
      for (var i = 0; i < markerArray.length; i++) {
        markerArray[i].setMap(map);
      }
    }

    // Removes the markers from the map, but keeps them in the array.
    function clearMarkers(markerArray) {
      setMapOnAll(null, markerArray);
    }

    // Shows any markers currently in the array.
    function showMarkers(markerArray) {
      setMapOnAll(map, markerArray);
    }

    function AutoCenter(markerArray) {
      if (markerArray.length > 0) {
        var bounds = new google.maps.LatLngBounds();
        $.each(markerArray, function(index, marker) {
          bounds.extend(marker.position);
        });
        map.fitBounds(bounds);
      }
    }

    $(window).resize(function() {
      var h = $(window).height() * 0.6,
        offsetTop = 20; // Calculate the top offset
      $('#map-container').css('height', (h - offsetTop));
    }).resize();
  </script>

  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDkTnb5G_YoNkyUnTAMPL69n8SrjaxlA8g&callback=initMap">
  </script>
  <br>

</div>
<!-- /.content -->

<?php render('_footercup', array('baseInfo' => $baseInfo, 'settings' => $settings)) ?>