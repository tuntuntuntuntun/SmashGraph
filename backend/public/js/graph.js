window.onload = function () {
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: created_at,
            datasets: [{
                label: fighter,
                data: power,
                backgroundColor: 'pink',
                borderColor: 'red',
                borderWidth: 1,
                lineTension: 0,
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}