document.addEventListener("DOMContentLoaded", () => {
    const ctx1 = document.getElementById('phChart')?.getContext('2d');
    const ctx2 = document.getElementById('kekeruhanChart')?.getContext('2d');

    if (typeof window.labels !== 'undefined' && ctx1 && ctx2) {
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: window.labels,
                datasets: [{
                    label: 'pH',
                    data: window.phData,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false
                }]
            }
        });

        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: window.labels,
                datasets: [{
                    label: 'Kekeruhan',
                    data: window.kekeruhanData,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    fill: false
                }]
            }
        });
    }
});
