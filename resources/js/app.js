import './bootstrap';
import Chart from 'chart.js/auto';
import './public_dashboard';

import Alpine from 'alpinejs';
import '../../vendor/livewire/livewire/dist/livewire.esm'



window.Alpine = Alpine;
window.Livewire = Livewire;

Alpine.start();
Livewire.start();
let map;

function initMap() {
    const mapOptions = {
        center: { lat: -6.200000, lng: 106.816666 }, // Ganti dengan koordinat default
        zoom: 10
    };
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
}
