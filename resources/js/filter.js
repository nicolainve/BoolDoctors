import axios from 'axios';
import Vue from 'vue';

const app = new Vue({
    el: '#app',
    data: {
        results: [],
        tools: false,
        specialization: '',
        avg: '',
        count: '',
        fakeImg: [
            'avatar/1.png',
            'avatar/2.png',
            'avatar/4.png',
            'avatar/5.png',
            'avatar/6.png',
            'avatar/7.png',
            'avatar/8.png',
            'avatar/9.png',
            'avatar/10.png',
            'avatar/11.png',
            'avatar/12.png',
            'avatar/13.png',
            'avatar/14.png',
            'avatar/15.png',
            'avatar/16.png',
            'avatar/17.png',
        ]
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