import Chart from 'chart.js';
import axios from 'axios';

var id = document.getElementById('id').value;

async function getData() {
    try {
        let rev = await axios({
            url: 'http://127.0.0.1:8000/api/reviews?', 
            params: {
                id: id
            },
            method: 'get',
        })

        let mes = await axios({
            url: 'http://127.0.0.1:8000/api/messages?', 
            params: {
                id: id
            },
            method: 'get',
        })

        return [rev.data, mes.data]
    }
    catch (err) {
        console.error(err);
    }
}

getData()
.then(results => {
    // console.log(results);
    var revMonth = document.getElementById('revMonth');
    var revMonthGraph = new Chart(revMonth, {
        type: 'bar',
        data: {
            labels: ['Gen','Feb','Mar','Apr', 'Mag', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'],
            datasets: [{
                label: '# Reviews Mensili',
                data: results[0][0],
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
    });

    var revYear = document.getElementById('revYear');
    var revYearGraph = new Chart(revYear, {
        type: 'bar',
        data: {
            labels: ['2018', '2019', '2020', '2021'],
            datasets: [{
                label: '# Reviews Annuali',
                data: results[0][1],
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
    });

    var mesMonth = document.getElementById('mesMonth');
    var mesMonthGraph = new Chart(mesMonth, {
        type: 'bar',
        data: {
            labels: ['Gen','Feb','Mar','Apr', 'Mag', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'],
            datasets: [{
                label: '# Messaggi privati mensili',
                data: results[1][0],
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
    });

    var mesYear = document.getElementById('mesYear');
    var mesYearGraph = new Chart(mesYear, {
        type: 'bar',
        data: {
            labels: ['2018', '2019', '2020', '2021'],
            datasets: [{
                label: '# Messaggi privati annuali',
                data: results[1][1],
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
    });
})









