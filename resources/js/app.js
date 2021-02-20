require('./bootstrap');

import axios from 'axios';
import Vue from 'vue';

const app = new Vue({
    el: '#app',
    data: {
        results : [],
        specialization: '',
    },
    // metodi
    methods:{
        // Search bar for guest by specialization
        search(spec){
            axios.get('http://127.0.0.1:8000/api/doctors', {
                params:{
                    spec: spec,
                    voteaverage: '',
                    review: ''
                }
            })
            .then(response => {
                this.results = response.data;
                console.log(response.data);
            })
            .catch(error => {
                console.log(error);
            });
            this.specialization = spec;
        },

        routing(slug){
            return window.location + 'show/' + slug ;
        },

        // Filtraggio Voti max
         maxVote(){
             axios.get('http://127.0.0.1:8000/api/doctors', {
                 params: {
                     spec: this.specialization,
                     voteaverage: 'true',
                     review: ''
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
         maxReview(){
             axios.get('http://127.0.0.1:8000/api/doctors', {
                 params: {
                     spec: this.specialization,
                     voteaverage: '',
                     review: 'true'
                 }
             })
            .then(response => {
                this.results = response.data;
                console.log(response.data);
            })
            .catch(error => {
                console.log(error);
            });

         }
    }
});