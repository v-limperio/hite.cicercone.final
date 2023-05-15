var indirizzo;
var latlng;
var map = L.map('mymap', {
      fullscreenControl: true,
      fullscreenControlOptions: {
      position: 'topleft'}}).setView([40.464647, 17.261841], 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var marker=L.marker();
var searchControl = L.esri.Geocoding.geosearch().addTo(map);
var geocodeService = L.esri.Geocoding.geocodeService();
var results = L.layerGroup().addTo(map);

map.on('click', function (e) {
  geocodeService.reverse().latlng(e.latlng).run(function (error, result) {
      if (error) {
        return;
      }
      if(marker){
        map.removeLayer(marker);
      }
      marker=L.marker(result.latlng,{draggable:true}).addTo(map).bindPopup(result.address.Match_addr).openPopup();
      $(".leaflet-marker-draggable").css("cursor","grab");
      marker.on('dblclick',function(removemarker){
        if (marker) {
          map.removeLayer(marker);
        }
      });
      indirizzo=result.address.LongLabel;
      latlng=e.latlng;
      marker.on('dragend', function(e){
        geocodeService.reverse().latlng(e.target._latlng).run(function (error, result) {
        if (error) {
          return;
        }
        marker.bindPopup(result.address.LongLabel).openPopup();

        indirizzo=result.address.LongLabel;
        latlng=e.target._latlng;
        console.log(indirizzo,latlng);
        });
      });
      document.getElementById('lat').value = latlng.lat.toString();
      document.getElementById('lng').value = latlng.lng.toString();
      document.getElementById('indirizzo').value = indirizzo;
      // indrizzoJSON = JSON.stringify(indirizzo);
      // locationJSON = JSON.stringify(latlng);

      console.log(indirizzo,latlng);

      
  });
});

searchControl.on('results', function (data) {
  if (marker) {
    map.removeLayer(marker);
  }
  for (var i = data.results.length - 1; i >= 0; i--) {
    marker=L.marker(data.results[i].latlng,{draggable:true});
    results.addLayer(marker);
    $(".leaflet-marker-draggable").css("cursor","grab");
    indirizzo=data.results[i].text;
    latlng=data.results[i].latlng;
    marker.on('dragend', function(e){
      geocodeService.reverse().latlng(e.target._latlng).run(function (error, result) {
      if (error) {
        return;
      }
      marker.bindPopup(result.address.LongLabel).openPopup();
      indirizzo=result.address.LongLabel;
      latlng=e.target._latlng;
      console.log(indirizzo,latlng);
      });
    });
    document.getElementById('lat').value = latlng.lat.toString();
    document.getElementById('lng').value = latlng.lng.toString();
    document.getElementById('indirizzo').value = indirizzo;
    // indrizzoJSON = JSON.stringify(indirizzo);
    // locationJSON = JSON.stringify(latlng);

    console.log(indirizzo, latlng);
  }
  marker.bindPopup(indirizzo).openPopup();
  marker.on('dblclick',function(removemarker){
    if (marker) {
      map.removeLayer(marker);
    }
  });
});

//action per l'impostazione del punto di incontro
// $(document).ready(function(){
//   $("button").click(function(){
//       $.ajax({
//         type:'POST',
//         url: 'action/call_imposta_punto_incontro.php',
//         data: {
//             latlng : locationJSON,
//             indirizzo : indrizzoJSON
//         },
//         dataType:'json',
//         success: function(){
//           location.replace("http://localhost:8080/hite.cicerone.io/html/cicerone/le_mie_attività.php/");
//         }
//     });
//   });
// });