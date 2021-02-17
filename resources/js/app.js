require('./bootstrap');

import axios from 'axios';
import Vue from 'vue';

const app = new Vue({
    el: '#app',
    data: {
        results : [],
        specs: [],
        modelSpec:""
    },
    // metodi
    methods:{
        // Search bar for guest by specialization
        search(query){
            axios.get('http://127.0.0.1:8000/api/doctors', {
                params:{
                    type: query
                }
            })
            .then(response => {
                // handle success
                console.log(response.data);
                this.results = response.data;
            })
            .catch(error => {
                // handle error
                console.log(error);
            });
        },

    }
});