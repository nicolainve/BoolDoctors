import Chart from 'chart.js';
import axios from 'axios';

var ctx = document.getElementById('myChart');
var id = document.getElementById('id').value;
var reviews = [];

axios.get('http://127.0.0.1:8000/api/reviews',{
    params: {
        id: id
    }
    })
    .then(response => {
        reviews = response.data;
        console.log(reviews);
    })
    .catch(error => {
        console.log(error);
    });

// async function asyncFunc() {
//     try {
//         // fetch data from a url endpoint
//         const response = await axios.get("http://127.0.0.1:8000/api/reviews?id=" + id);
//         return console.log(response.data);
//     } catch(error) {
//         console.log("error", error);
//         // appropriately handle the error
//     }
// }

// asyncFunc()
    
setTimeout(() => {

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Gen','Feb','Mar','Apr', 'Mag', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'],
            datasets: [{
                label: '# of Votes',
                miniBarThickness: 2,
                data: reviews,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
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
}, 2000);








