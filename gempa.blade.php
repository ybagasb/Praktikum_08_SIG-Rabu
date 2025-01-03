<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        #map { height: 600px; }
    </style>
     <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>
    <body>
        <div class="jdul" style="text-align: center;">
            <h1>Data Gempa</h1>
            <h3 style="margin-top: -20px;">Sumber Data: https://data.bmkg.go.id/</3>
            <h4 style="margin-top: -20px;">Updated: 03 Jan 2025</h4>
        </div>
        <div id="map"></div>
        <script>
            var map = L.map('map').setView([-0.3155398750904368, 117.1371634207888], 5);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png',{ maxZoom: 5,
              attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            let files = {!! file_get_contents("https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.json") !!};
            console.log(files);

            let gempas = files.Infogempa.gempa;

            gempas.forEach(gempas =>{
                let kordinat = gempas.Coordinates.split(",");
                let lat = kordinat[0];
                let log = kordinat[1];

                let marker = L.marker([lat,log]).addTo(map);

                marker.bindPopup(
                    "Tanggal: " + gempas.Tanggal + "</br>" +
                    "Jam: " + gempas.Jam + "</br>" +
                    "Kekuatan: " + gempas.Magnitude + " SR" + "</br>" +
                    "Wilayah: " + gempas.Wilayah + "</br>" +
                    "Potensi: " + gempas.Potensi
                )

            });
        </script>
    </body>
</html>