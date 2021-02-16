require('./bootstrap');

import Vue from 'vue';

const app = new Vue({
    el: '#app',
    data: {
        results : []
    },
    created() {
        axios.get('http://127.0.0.1:8000/api/doctors')
            .then(response => {
                // handle success
                console.log(response);
                this.results = response.data;
            })
            .catch(error => {
                // handle error
                console.log(error);
            });
    }
});