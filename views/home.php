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

        .prevision {
            display: none;
        }
    </style>
    <title>Ringo Météo</title>
</head>

<body>

    <div id="ringoMap"></div>



    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="../data/data.js"></script>

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

        function prev(num) {
            var currentElts = document.getElementsByClassName("p" + (num +1));
            var nextElts = document.getElementsByClassName("p"+ num);

            // citiesElts.style.display = "none";

            for (var i = 0; i < currentElts.length; i++) {
                currentElts[i].style.display = "none";
                nextElts[i].style.display = "block";

                // console.log(citiesElts[i])

            }
                // console.log(num)
            // });

        }

        function next(num) {
            var currentElts = document.getElementsByClassName("p" + (num -1));
            var nextElts = document.getElementsByClassName("p"+ num);

            // citiesElts.style.display = "none";

            for (var i = 0; i < currentElts.length; i++) {
                currentElts[i].style.display = "none";
                nextElts[i].style.display = "block";

                // console.log(citiesElts[i])

            }
                // console.log(num)
            // });

        }

        function test(num) {
                console.log(num.className)
        }

        function onEachFeature(feature, layer) {
            layer.bindPopup(
                `<h1>${feature.properties.name}</h1>
                <div class="p0"><h2>Aujourd\'hui <button onclick="next(1)">></button></h2><p>Temperature min.: ${feature.properties.tmin} °C</p><p>Temperature max.: 
                ${feature.properties.tmax}°C</p><p>Temps: ${feature.properties.tps} </p><p>Direction du vent: 
                ${feature.properties.vdir}</p><p>Force du vent: ${feature.properties.vforce} </p><p>Rafales de vent: ${feature.properties.vrafales} </p><p>Humidité: ${feature.properties.hum} </p>
                </div>

                <div class="prevision p1"><h2><button onclick="prev(0)"><</button> Demain <button  onclick="next(2)">></button></h2><p>Temperature min.: ${feature.previsions[0].tmin} °C</p><p>Temperature max.: 
                ${feature.previsions[0].tmax}°C</p><p>Temps: ${feature.previsions[0].tps} </p><p>Direction du vent: 
                ${feature.previsions[0].vdir}</p><p>Force du vent: ${feature.previsions[0].vforce} </p><p>Humidité: ${feature.previsions[0].hum} </p></div>

                <div class="prevision p2"><h2><button onclick="prev(1)"><</button> ${feature.previsions[1].date} <button  onclick="next(3)">></button></h2><p>Temperature min.: ${feature.previsions[1].tmin} °C</p><p>Temperature max.: 
                ${feature.previsions[1].tmax}°C</p><p>Temps: ${feature.previsions[1].tps} </p><p>Direction du vent: 
                ${feature.previsions[1].vdir}</p><p>Force du vent: ${feature.previsions[1].vforce} </p><p>Humidité: ${feature.previsions[1].hum} </p></div>

                <div class="prevision p3"><h2><button onclick="prev(2)"><</button> ${feature.previsions[2].date} <button  onclick="next(4)">></button></h2><p>Temperature min.: ${feature.previsions[2].tmin} °C</p><p>Temperature max.: 
                ${feature.previsions[2].tmax}°C</p><p>Temps: ${feature.previsions[2].tps} </p><p>Direction du vent: 
                ${feature.previsions[2].vdir}</p><p>Force du vent: ${feature.previsions[2].vforce} </p><p>Humidité: ${feature.previsions[2].hum} </p></div>

                <div class="prevision p4"><h2><button onclick="prev(3)"><</button> ${feature.previsions[3].date} <button  onclick="next(5)">></button></h2><p>Temperature min.: ${feature.previsions[3].tmin} °C</p><p>Temperature max.: 
                ${feature.previsions[3].tmax}°C</p><p>Temps: ${feature.previsions[3].tps} </p><p>Direction du vent: 
                ${feature.previsions[3].vdir}</p><p>Force du vent: ${feature.previsions[3].vforce} </p><p>Humidité: ${feature.previsions[3].hum} </p></div>

                <div class="prevision p5"><h2><button onclick="prev(4)"><</button> ${feature.previsions[4].date}</h2><p>Temperature min.: ${feature.previsions[4].tmin} °C</p><p>Temperature max.: 
                ${feature.previsions[4].tmax}°C</p><p>Temps: ${feature.previsions[4].tps} </p><p>Direction du vent: 
                ${feature.previsions[4].vdir}</p><p>Force du vent: ${feature.previsions[4].vforce} </p><p>Humidité: ${feature.previsions[4].hum} </p></div>`
            );
        }

        // function onEachFeaturePrev(feature, layer) {
        //     layer.bindPopup(
        //         `<div><h1>${previsions.features[0].properties.name}</h1><h2><button onclick="prev()"><</button> Aujourd\'hui <button  onclick="next()">></button></h2><p>Temperature min.: ${previsions.features[0].properties.tmin} °C</p><p>Temperature max.: 
        //         ${previsions.features[0].properties.tmax}°C</p><p>Temps: ${previsions.features[0].properties.tps} </p><p>Direction du vent: 
        //         ${previsions.features[0].properties.vdir}</p><p>Force du vent: ${previsions.features[0].properties.vforce} </p><p>Humidité: ${previsions.features[0].properties.hum} </p></div>`
        //     );
        // }

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
            // console.log(previsions);
        })();
    </script>
    
</body>

</html>