<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
    <link rel="stylesheet" href="assets/main.css" />
    <script src="https://kit.fontawesome.com/a52eb46639.js" crossorigin="anonymous"></script>

    <title>GeoJSON Météo</title>
</head>

<body>

    <h1>GeoJSON Météo by <a href="mailto:ahmidbbc@gmail.com">Abdel</a></h1>
    <p class="leaflet-credit">with Leaflet API <i class="fab fa-envira fa-rotate-90"></i></p>


    <!-- weather report -->
    <section id="report">
        <div id="head">
            <h2 id="title"></h2>
            <div id="date"></div>
        </div>

        <div id="intro"></div>

        <button class="accordion">Situation<i class="fas fa-chevron-down"></i></button> 
        <div class="panel">
            <div id="info"></div>
        </div>

        <button class="accordion">Prévisions <i class="fas fa-chevron-down"></i></button>
        <div class="panel">
        <div id="forecast"></div>
        </div>

    </section>



    <!-- Map -->
    <div id="leafletMap"></div>


    <!-- Scripts -->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="../data/data.js"></script>

    <script>
        //Generate map instance
        const map = L.map('leafletMap').setView([-21.1293, 55.4734], 11);

        // API call
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiYWhtaWRiYmMiLCJhIjoiY2tjaHF3OXU0MTRwMDJ5cGI1enppNzR3dSJ9.JazFWVUaQf10wt7JMpKd0w'
        }).addTo(map);

        /**
         * Function to display previous weather forecast day
         * @param num : number
         **/
        function prev(num) {

            var currentElts = document.getElementsByClassName("p" + (num + 1));
            var nextElts = document.getElementsByClassName("p" + num);

            for (var i = 0; i < currentElts.length; i++) {
                currentElts[i].style.display = "none";
                nextElts[i].style.display = "block";
            }

        }

        /**
         * Function to display next weather forecast day
         * @param num : number
         **/
        function next(num) {

            var currentElts = document.getElementsByClassName("p" + (num - 1));
            var nextElts = document.getElementsByClassName("p" + num);

            for (var i = 0; i < currentElts.length; i++) {
                currentElts[i].style.display = "none";
                nextElts[i].style.display = "block";
            }

        }

        // API Doc: https://leafletjs.com/reference-1.7.1.html
        function onEachFeature(feature, layer) {

            layer.bindPopup(

                `<h2>${feature.properties.name}</h2>
                
                <div class="p0"><h3>Aujourd\'hui <i class="fas fa-caret-square-right" onclick="next(1)"></i></h3><div class="condition"><h4>${feature.properties.condition}</h4><i class="${feature.properties.icon}" style="color: ${feature.properties.color}"></i></div>
                <p>Temperature min.: ${feature.properties.tmin} °C</p><p>Temperature max.: 
                ${feature.properties.tmax}°C</p><p>Temps: ${feature.properties.tps} </p><p>Direction du vent: 
                ${feature.properties.vdir}</p><p>Force du vent: ${feature.properties.vforce} </p><p>Rafales de vent: ${feature.properties.vrafales} </p><p>Humidité: ${feature.properties.hum} </p>
                </div>
                
                <div class="prevision p1"><h3><i class="fas fa-caret-square-left" onclick="prev(0)"></i> Demain <i class="fas fa-caret-square-right" onclick="next(2)"></i></h3><div class="condition"><h4>${feature.previsions[0].condition}</h4><i class="${feature.previsions[0].icon}" style="color: ${feature.previsions[0].color}"></i></div>
                <p>Temperature min.: ${feature.previsions[0].tmin} °C</p><p>Temperature max.: 
                ${feature.previsions[0].tmax}°C</p><p>Temps: ${feature.previsions[0].tps} </p><p>Direction du vent: 
                ${feature.previsions[0].vdir}</p><p>Force du vent: ${feature.previsions[0].vforce} </p><p>Humidité: ${feature.previsions[0].hum} </p></div>

                <div class="prevision p2"><h3><i class="fas fa-caret-square-left" onclick="prev(1)"></i> ${feature.previsions[1].date} <i class="fas fa-caret-square-right" onclick="next(3)"></i></h3><div class="condition"><h4>${feature.previsions[1].condition}</h4><i class="${feature.previsions[1].icon}" style="color: ${feature.previsions[1].color}"></i></div>
                <p>Temperature min.: ${feature.previsions[1].tmin} °C</p><p>Temperature max.: 
                ${feature.previsions[1].tmax}°C</p><p>Temps: ${feature.previsions[1].tps} </p><p>Direction du vent: 
                ${feature.previsions[1].vdir}</p><p>Force du vent: ${feature.previsions[1].vforce} </p><p>Humidité: ${feature.previsions[1].hum} </p></div>

                <div class="prevision p3"><h3><i class="fas fa-caret-square-left" onclick="prev(2)"></i> ${feature.previsions[2].date} <i class="fas fa-caret-square-right" onclick="next(4)"></i></h3><div class="condition"><h4>${feature.previsions[2].condition}</h4><i class="${feature.previsions[2].icon}" style="color: ${feature.previsions[2].color}"></i></div>
                <p>Temperature min.: ${feature.previsions[2].tmin} °C</p><p>Temperature max.: 
                ${feature.previsions[2].tmax}°C</p><p>Temps: ${feature.previsions[2].tps} </p><p>Direction du vent: 
                ${feature.previsions[2].vdir}</p><p>Force du vent: ${feature.previsions[2].vforce} </p><p>Humidité: ${feature.previsions[2].hum} </p></div>

                <div class="prevision p4"><h3><i class="fas fa-caret-square-left" onclick="prev(3)"></i> ${feature.previsions[3].date} <i class="fas fa-caret-square-right" onclick="next(5)"></i></h3><div class="condition"><h4>${feature.previsions[3].condition}</h4><i class="${feature.previsions[3].icon}" style="color: ${feature.previsions[3].color}"></i></div>
                <p>Temperature min.: ${feature.previsions[3].tmin} °C</p><p>Temperature max.: 
                ${feature.previsions[3].tmax}°C</p><p>Temps: ${feature.previsions[3].tps} </p><p>Direction du vent: 
                ${feature.previsions[3].vdir}</p><p>Force du vent: ${feature.previsions[3].vforce} </p><p>Humidité: ${feature.previsions[3].hum} </p></div>

                <div class="prevision p5"><h3><i class="fas fa-caret-square-left" onclick="prev(4)"></i> ${feature.previsions[4].date}</h3><div class="condition"><h4>${feature.previsions[4].condition}</h4><i class="${feature.previsions[4].icon}" style="color: ${feature.previsions[4].color}"></i></div>
                <p>Temperature min.: ${feature.previsions[4].tmin} °C</p><p>Temperature max.: 
                ${feature.previsions[4].tmax}°C</p><p>Temps: ${feature.previsions[4].tps} </p><p>Direction du vent: 
                ${feature.previsions[4].vdir}</p><p>Force du vent: ${feature.previsions[4].vforce} </p><p>Humidité: ${feature.previsions[4].hum} </p></div>`, {
                    className: "popup-styling"
                }
            );
        }

        function bindData(state) {
            var geo = L.geoJson(cities, {
                onEachFeature: onEachFeature
            }).addTo(map);
        }

        function accordion() {
            var acc = document.getElementsByClassName("accordion");
            var i;

            for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var panel = this.nextElementSibling;
                    if (panel.style.display === "block") {
                        panel.style.display = "none";
                    } else {
                        panel.style.display = "block";
                    }
                });
            }
        }

        //Add data when the DOM is loaded
        (function() {
            bindData();

            accordion();

            var titleElt = document.getElementById('title');
            titleElt.innerHTML = data.meteo.bulletin.sujet;

            var dateElt = document.getElementById('date');
            const day = new Date(data.meteo.bulletin.date)
            dateElt.innerHTML = day.toLocaleString("fr-FR", {
                timeZone: "Europe/Paris"
            }).split(',')[0];
            console.log();

            var introElt = document.getElementById('intro');
            introElt.innerHTML = data.meteo.bulletin.introduction;

            var infoElt = document.getElementById('info');
            infoElt.innerHTML = data.meteo.bulletin.situation;

            var forecastElt = document.getElementById('forecast');
            forecastElt.innerHTML = data.meteo.bulletin.previsions;

            // console.log(previsions);
        })();
    </script>

</body>

</html>