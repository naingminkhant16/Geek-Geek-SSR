// chart js admin dashboard
import {
    Chart
} from 'chart.js/auto';

window.showChart = function (chart, id, label) {

    chart = JSON.parse(chart);
    const labels = Object.keys(chart);
    const data = Object.values(chart);

    const ctx = document.getElementById(id);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label,
                data,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
