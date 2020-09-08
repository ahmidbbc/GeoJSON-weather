//VARS
var data;

var cities = {
  "type": "FeatureCollection",
  "features": []
}

var previsions = {
  "type": "FeatureCollection",
  "features": []
}

/**
 * Get JSON File
 * @param {*} callback: function 
 */
function loadJSON(callback) {

  var xobj = new XMLHttpRequest();
  xobj.overrideMimeType("application/json");
  xobj.open('GET', '../data/meteo.json', false);
  xobj.onreadystatechange = function () {
    if (xobj.readyState == 4 && xobj.status == "200") {

      // Anonymous callbacks
      callback(xobj.responseText);
    }
  };
  xobj.send(null);

}

/**
 * Get JSON response data
 * @param function : function
 */
loadJSON(function (response) {

  // Parse JSON string into object
  data = JSON.parse(response);

});
// console.log(data)


/**
 * Push cities data objects
 */
for (i = 0; i < data.meteo.bulletin.ville.length; i++) {

  let icon, color;
  if (data.meteo.bulletin.ville[i].condition == "Ensoleillé") { icon = "fas fa-sun"; color = "#FFE168" }
  else if (data.meteo.bulletin.ville[i].condition == "Pluie faible") { icon = "fas fa-cloud-sun-rain"; color = "#4DBFD9" }
  else { icon = "fab fa-soundcloud"; color = "#50504B" }

  let city = {
    "type": "Feature",
    "properties": {
      "name": data.meteo.bulletin.ville[i]["-id"],
      "tmin": data.meteo.bulletin.ville[i]["-temperature_mini"],
      "tmax": data.meteo.bulletin.ville[i]["-temperature_maxi"],
      "tps": data.meteo.bulletin.ville[i]["-temps"],
      "vdir": data.meteo.bulletin.ville[i]["-vent_direction"],
      "vforce": data.meteo.bulletin.ville[i]["-vent_force"],
      "vrafales": data.meteo.bulletin.ville[i]["-vent_rafales"],
      "hum": data.meteo.bulletin.ville[i]["-humidite"],
      "condition": data.meteo.bulletin.ville[i].condition,
      "icon": icon,
      "color": color
    },
    "geometry": {
      "type": "Point",
      "coordinates": [
        data.meteo.bulletin.ville[i].coordinates[0],
        data.meteo.bulletin.ville[i].coordinates[1]
      ]
    },
    "previsions": []
  }

  cities.features.push(city)

}

/**
 * Push weather forecast data objects
 */
data.meteo.previsions.prevision.forEach(element => {

  for (i = 0; i < element.ville.length; i++) {
    let icon, color;

    if (element.ville[i].condition == "Ensoleillé") { icon = "fas fa-sun"; color = "#FFE168" }
    else if (element.ville[i].condition == "Pluie faible") { icon = "fas fa-cloud-sun-rain"; color = "#4DBFD9" }
    else { icon = "fab fa-soundcloud"; color = "#666660" }

    let prevision = {
      "date": new Date(element["-date"]).toLocaleString("fr-FR", {year: "numeric", month: "long", day: "numeric"}),
      "name": element.ville[i]["-id"],
      "tmin": element.ville[i]["-temperature_mini"],
      "tmax": element.ville[i]["-temperature_maxi"],
      "tps": element.ville[i]["-temps"],
      "vdir": element.ville[i]["-vent_direction"],
      "vforce": element.ville[i]["-vent_force"],
      "hum": element.ville[i]["-humidite"],
      "condition": element.ville[i].condition,
      "icon": icon,
      "color": color
    }
    cities.features[i].previsions.push(prevision)
  }

});