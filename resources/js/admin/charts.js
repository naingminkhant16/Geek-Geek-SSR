// chart js admin dashboard
import {
    Chart
} from 'chart.js/auto';

window.showChart = function (chart, id, label) {

    chart = JSON.parse(chart);
    const labels = Object.keys(chart);
    const data = Object.values(chart);

    const ctx = document.getElementById(id);

    //color
    let backgroundColor;
    switch (label) {
        case "Users":
            backgroundColor = "#BB68FC";
            break;
        case "Posts":
            backgroundColor = "rgba(69, 235, 165,0.75)";
            break;
        case "Likes":
            backgroundColor = "rgba(220, 53, 69,0.75)";
            break;
        case "Comments":
            backgroundColor = "rgba(255, 193, 7,0.75)";
            break;
        default:
            backgroundColor = "#9BD0F5";
    }

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels,
            datasets: [{
                label,
                data,
                borderWidth: 1,
                backgroundColor,
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
