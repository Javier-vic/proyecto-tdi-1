function Grafico_anual(aux){
    var ctx = document.getElementById("Grafico_anual");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            datasets: [{
                data: ['aux', 21345, 18483, 24003, 23489, 24092, 12034],
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#007bff',
                borderWidth: 4,
                pointBackgroundColor: '#007bff'
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            },
            legend: {
                display: false,
            }
        }
    });
     
}



function Grafico_mensual(){
    var ctx = document.getElementById("Grafico_mensual");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Dias 1-7", "Dias 8-15", "Dias 16-23", "Dias 24-31"],
            datasets: [{
                data: [15339, 21345, 18483, 24003],
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#000bff',
                borderWidth: 4,
                pointBackgroundColor: '#007bff'
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            },
            legend: {
                display: false,
            }
        }
    });
     
}



function Grafico_semestral(){
    var ctx = document.getElementById("Grafico_semestral");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Mes 1", "Mes 2", "Mes 3", "Mes 4", "Mes 5", "Mes 6"],
            datasets: [{
                data: [15339, 21345, 18483, 24003, 23489, 24092],
                lineTension: 0,
                backgroundColor: 'transparent',
                borderColor: '#000bff',
                borderWidth: 4,
                pointBackgroundColor: '#007bff'
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false
                    }
                }]
            },
            legend: {
                display: false,
            }
        }
    });
     
}