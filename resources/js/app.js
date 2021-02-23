require('./bootstrap');

import axios from 'axios';
import Vue from 'vue';

const app = new Vue({
    el: '#app',
    data: {
        results: [],
        tools: false,
        specialization: '',
        avg: '',
        count: ''
    },
    // metodi
    methods:{
        // Search bar for guest by specialization
        search(spec){
            axios.get('http://127.0.0.1:8000/api/doctors', {
                params:{
                    spec: spec,
                }
            })
            .then(response => {
                this.tools = true;
                this.results = response.data;
            })
            .catch(error => {
                console.log(error);
            });
            this.specialization = spec;
        },
        filter() {
            axios.get('http://127.0.0.1:8000/api/doctors', {
                params:{
                    spec: this.specialization,
                    avg: this.avg,
                    count: this.count,
                }
            })
            .then(response => {
                this.results = response.data;
            })
            .catch(error => {
                console.log(error);
            });
        },
        routing(slug){
            return window.location + 'show/' + slug ;
        },
    }
});