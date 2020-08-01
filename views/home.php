<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />

    <style>
        #ringoMap {
            height: 900px;
        }

        .todayPlus1 {
            display: none;
        }
    </style>
    <title>Ringo Météo</title>
</head>

<body>

    <div id="ringoMap"></div>



    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="../data/location.js"></script>

    <script>
        //Generate map instance
        const map = L.map('ringoMap').setView([-21.1293, 55.4734], 11);

        // API
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiYWhtaWRiYmMiLCJhIjoiY2tjaHF3OXU0MTRwMDJ5cGI1enppNzR3dSJ9.JazFWVUaQf10wt7JMpKd0w'
        }).addTo(map);

        // var marker = L.marker([-21.1293, 55.4734]).addTo(map);

        // marker.setLatLng([-21.1, 55.4])

        var geo;

        function prev() {
            map.removeLayer(geo);
            bindData(true);
        }

        function next() {
            var citiesElts = document.getElementsByClassName("today");
            var prevElts = document.getElementsByClassName("todayPlus1");

            // citiesElts.style.display = "none";

            for (var i = 0; i < citiesElts.length; i++) {
                citiesElts[i].style.display = "none";
                prevElts[i].style.display = "block";

                // console.log(citiesElts[i])

            }
            //     console.log(element)
            // });

        }

        function onEachFeature(feature, layer) {
            layer.bindPopup(
                `<h1>${feature.properties.name}</h1>
                <div class="today"><h2>Aujourd\'hui <button  onclick="next()">></button></h2><p>Temperature min.: ${feature.properties.tmin} °C</p><p>Temperature max.: 
                ${feature.properties.tmax}°C</p><p>Temps: ${feature.properties.tps} </p><p>Direction du vent: 
                ${feature.properties.vdir}</p><p>Force du vent: ${feature.properties.vforce} </p><p>Rafales de vent: ${feature.properties.vrafales} </p><p>Humidité: ${feature.properties.hum} </p>
                </div>
                <div class="todayPlus1"><h2><button onclick="prev()"><</button> ${previsions.features[0].properties.date} <button  onclick="next()">></button></h2><p>Temperature min.: ${previsions.features[0].properties.tmin} °C</p><p>Temperature max.: 
                ${previsions.features[0].properties.tmax}°C</p><p>Temps: ${previsions.features[0].properties.tps} </p><p>Direction du vent: 
                ${previsions.features[0].properties.vdir}</p><p>Force du vent: ${previsions.features[0].properties.vforce} </p><p>Humidité: ${previsions.features[0].properties.hum} </p></div>`
            );
        }

        function onEachFeaturePrev(feature, layer) {
            layer.bindPopup(
                `<div><h1>${previsions.features[0].properties.name}</h1><h2><button onclick="prev()"><</button> Aujourd\'hui <button  onclick="next()">></button></h2><p>Temperature min.: ${previsions.features[0].properties.tmin} °C</p><p>Temperature max.: 
                ${previsions.features[0].properties.tmax}°C</p><p>Temps: ${previsions.features[0].properties.tps} </p><p>Direction du vent: 
                ${previsions.features[0].properties.vdir}</p><p>Force du vent: ${previsions.features[0].properties.vforce} </p><p>Humidité: ${previsions.features[0].properties.hum} </p></div>`
            );
        }

        function bindData(state) {

            // if (state) {
            //     map.removeLayer(geo);
            //     geo = L.geoJson(cities, {
            //         onEachFeature: onEachFeaturePrev
            //     }).addTo(map);

            //     // } else if (!state) {

            // } else {
                geo = L.geoJson(cities, {
                    onEachFeature: onEachFeature
                }).addTo(map);
            // }
        }

        
        //Add data
        (function() {
            bindData();
            console.log(previsions);
        })();
    </script>
</body>

</html>