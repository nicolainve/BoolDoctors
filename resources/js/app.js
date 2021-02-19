require('./bootstrap');

import axios from 'axios';
import Vue from 'vue';

const app = new Vue({
    el: '#app',
    data: {
        results : [],
    },
    // metodi
    methods:{
        // Search bar for guest by specialization
        search(spec){
            axios.get('http://127.0.0.1:8000/api/doctors', {
                params:{
                    spec: spec
                }
            })
            .then(response => {
                this.results = response.data;
                console.log(response.data);
            })
            .catch(error => {
                console.log(error);
            });
        },
        routing(slug){
            return window.location + 'show/' + slug ;
        }

    }
});