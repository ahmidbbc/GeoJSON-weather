
function loadJSON(callback) {

  var xobj = new XMLHttpRequest();
  xobj.overrideMimeType("application/json");
  xobj.open('GET', '../data/meteo.json', false);
  xobj.onreadystatechange = function () {
    if (xobj.readyState == 4 && xobj.status == "200") {

      // Required use of an anonymous callback as .open will NOT return a value but simply returns undefined in asynchronous mode
      callback(xobj.responseText);
    }
  };
  xobj.send(null);
}

var data;

loadJSON(function (response) {
  // Parse JSON string into object
  data = JSON.parse(response);
});
// console.log(data)

var cities  = {
  "type": "FeatureCollection",
  "features": []
}

var previsions = {
  "type": "FeatureCollection",
  "features": []
}

var lng = 55.471;
var lat = -21.132;


for(i=0; i < data.meteo.bulletin.ville.length; i++){
  let city = {
    "type": "Feature",
    "properties": {
      "name" : data.meteo.bulletin.ville[i]["-id"],
      "tmin" : data.meteo.bulletin.ville[i]["-temperature_mini"],
      "tmax" : data.meteo.bulletin.ville[i]["-temperature_maxi"],
      "tps" : data.meteo.bulletin.ville[i]["-temps"],
      "vdir" : data.meteo.bulletin.ville[i]["-vent_direction"],
      "vforce" : data.meteo.bulletin.ville[i]["-vent_force"],
      "vrafales" : data.meteo.bulletin.ville[i]["-vent_rafales"],
      "hum" : data.meteo.bulletin.ville[i]["-humidite"]
    },
    "previsions": {
      "name" : data.meteo.previsions.prevision[0].ville[i]["-id"],
      "tmin" : data.meteo.previsions.prevision[0].ville[i]["-temperature_mini"],
      "tmax" : data.meteo.previsions.prevision[0].ville[i]["-temperature_maxi"],
      "tps" : data.meteo.previsions.prevision[0].ville[i]["-temps"],
      "vdir" : data.meteo.previsions.prevision[0].ville[i]["-vent_direction"],
      "vforce" : data.meteo.previsions.prevision[0].ville[i]["-vent_force"],
      "hum" : data.meteo.previsions.prevision[0].ville[i]["-humidite"]
    },
    "geometry": {
      "type": "Point",
      "coordinates": [
        data.meteo.bulletin.ville[i].coordinates[0],
        data.meteo.bulletin.ville[i].coordinates[1]
      ]
    }
  }
  cities.features.push(city)
  // console.log(cities.features[i])
}

for(i=0; i < data.meteo.previsions.prevision.length; i++){
  let prevision = {
    "type": "Feature",
    "properties": {
      "date": data.meteo.previsions.prevision[0]["-date"],
      "name" : data.meteo.previsions.prevision[0].ville[i]["-id"],
      "tmin" : data.meteo.previsions.prevision[0].ville[i]["-temperature_mini"],
      "tmax" : data.meteo.previsions.prevision[0].ville[i]["-temperature_maxi"],
      "tps" : data.meteo.previsions.prevision[0].ville[i]["-temps"],
      "vdir" : data.meteo.previsions.prevision[0].ville[i]["-vent_direction"],
      "vforce" : data.meteo.previsions.prevision[0].ville[i]["-vent_force"],
      "hum" : data.meteo.previsions.prevision[0].ville[i]["-humidite"]

    },
    "geometry": {
      "type": "Point",
      "coordinates": [
        data.meteo.bulletin.ville[i].coordinates[0],
        data.meteo.bulletin.ville[i].coordinates[1]
      ]
    }
  }
  previsions.features.push(prevision)
  // console².log(previsions.features)
}

/**
 * Coordonnées des villes
 * Refactor: séparer dans un fichier json
 * source : http://geojson.io/#map=11/-21.1239/55.5565
 */
// var loc = {
//   "type": "FeatureCollection",
//   "features": [
//     {
//       "type": "Feature",
//       "properties": {},
//       "geometry": {
//         "type": "Point",
//         "coordinates": [
//           55.471343994140625,
//           -21.132542950367966
//         ]
//       }
//     },
//     {
//       "type": "Feature",
//       "properties": {
//         // "name": data.meteo.bulletin.ville[1]["-id"],
//       },
//       "geometry": {
//         "type": "Point",
//         "coordinates": [
//           55.55459976196288,
//           -21.22426154416536
//         ]
//       }
//     },
//     {
//       "type": "Feature",
//       "properties": {},
//       "geometry": {
//         "type": "Point",
//         "coordinates": [
//           55.63871383666992,
//           -21.136065481691592
//         ]
//       }
//     },
//     {
//       "type": "Feature",
//       "properties": {},
//       "geometry": {
//         "type": "Point",
//         "coordinates": [
//           55.29067039489746,
//           -20.935308258491343
//         ]
//       }
//     },
//     {
//       "type": "Feature",
//       "properties": {},
//       "geometry": {
//         "type": "Point",
//         "coordinates": [
//           55.51288604736328,
//           -21.281056878709553
//         ]
//       }
//     },
//     {
//       "type": "Feature",
//       "properties": {},
//       "geometry": {
//         "type": "Point",
//         "coordinates": [
//           55.648841857910156,
//           -20.959035078761598
//         ]
//       }
//     },
//     {
//       "type": "Feature",
//       "properties": {},
//       "geometry": {
//         "type": "Point",
//         "coordinates": [
//           55.70995330810547,
//           -21.034519020858227
//         ]
//       }
//     },
//     {
//       "type": "Feature",
//       "properties": {},
//       "geometry": {
//         "type": "Point",
//         "coordinates": [
//           55.446624755859375,
//           -20.878701415010315
//         ]
//       }
//     },
//     {
//       "type": "Feature",
//       "properties": {},
//       "geometry": {
//         "type": "Point",
//         "coordinates": [
//           55.28749465942383,
//           -21.167444336727833
//         ]
//       }
//     },
//     {
//       "type": "Feature",
//       "properties": {},
//       "geometry": {
//         "type": "Point",
//         "coordinates": [
//           55.41435241699218,
//           -21.286815182224156
//         ]
//       }
//     },
//     {
//       "type": "Feature",
//       "properties": {},
//       "geometry": {
//         "type": "Point",
//         "coordinates": [
//           55.27599334716797,
//           -21.004714636166792
//         ]
//       }
//     },
//     {
//       "type": "Feature",
//       "properties": {},
//       "geometry": {
//         "type": "Point",
//         "coordinates": [
//           55.765056610107415,
//           -21.360853248957188
//         ]
//       }
//     },
//     {
//       "type": "Feature",
//       "properties": {},
//       "geometry": {
//         "type": "Point",
//         "coordinates": [
//           55.47683715820312,
//           -21.335112066532552
//         ]
//       }
//     },
//     {
//       "type": "Feature",
//       "properties": {},
//       "geometry": {
//         "type": "Point",
//         "coordinates": [
//           55.55047988891601,
//           -20.897626192784756
//         ]
//       }
//     },
//     {
//       "type": "Feature",
//       "properties": {},
//       "geometry": {
//         "type": "Point",
//         "coordinates": [
//           55.821962356567376,
//           -21.158959894116233
//         ]
//       }
//     }
//   ]
// }


// console.log(data.meteo.previsions.prevision[0].ville.length)


// data.meteo.bulletin.ville.forEach(element => {
//   let city = {
//     "type": "Feature",
//     "properties": {
//       "name" : element["-id"],
//     },
//     "geometry": {
//       "type": "Point",
//       "coordinates": [
//         lng,
//         lat
//       ]
//     }
//   }  

//   cities.features.push(city)
//   // lng++;
//   // lat++;
//   console.log(element)
// });