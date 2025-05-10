import './bootstrap';
import Chart from 'chart.js/auto';
import './public_dashboard';
let map;

function initMap() {
    const mapOptions = {
        center: { lat: -6.200000, lng: 106.816666 }, // Ganti dengan koordinat default
        zoom: 10
    };
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
}
