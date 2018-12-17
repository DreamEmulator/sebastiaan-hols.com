<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">DUW 4101 - 21600 bph - {{hour}}:{{minute}}:{{second}}:{{millisecond}}</div>

                    <div class="card-body clock-container">

                        <div id="clock">
                            <div id="gangreserve-backdial" v-bind:style="{transform: gangreserve_rotation}">
                                <div id="gangreserve" v-bind:style="{transform: gangreserve_rotation}"></div>
                            </div>
                            <div v-if="hacking_seconds" v-on:click="hackSeconds()" id="crown-in"></div>
                            <div v-if="!hacking_seconds" v-on:click="startClock()" id="crown-out"></div>
                            <div id="day-window"></div>
                            <div id="day">{{day}}</div>
                            <div class="second-container">
                                <div id="second" v-bind:style="{transform: second_rotation}"></div>
                                <div class="base"></div>
                            </div>
                            <div id="minute" class="load-transition" v-bind:style="{transform: minute_rotation}"></div>
                            <div id="hour" class="load-transition" v-bind:style="{transform: hour_rotation}"></div>
                            <div class="base"></div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <button v-if="!shanghai_time" v-on:click="setShanghaiTime()"v-bind:class="{'text-muted': !hacking_seconds}" class="w-100 btn btn-light">Shanghai time</button>
                        <button v-if="shanghai_time" v-on:click="setShanghaiTime()"v-bind:class="{'text-muted': !hacking_seconds}" class="w-100 btn btn-light">Local time</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                clock_diameter: 0,
                millisecond: 0,
                second: 0,
                second_rotation: '',
                minute: 0,
                minute_rotation: '',
                hour: 0,
                hour_rotation: '',
                day: 0,
                power: 100,
                interval: null,
                date: null,
                hacking_seconds: false,
                gangreserve_degrees: 60,
                gangreserve_rotation: '',
                shanghai_time: false,
                transition_timeout: null,
                GMT: null,
            }
        },
        methods: {
            hackSeconds: function (){
                this.hacking_seconds = !this.hacking_seconds;
                clearInterval(this.interval);
            },
            startClock: function () {
                var time = new Date;
                this.GMT = time.getTimezoneOffset()/60;
                if (!this.hacking_seconds){
                    this.hacking_seconds = !this.hacking_seconds;
                    this.interval = setInterval(() => {
                        this.setTime()
                    }, 1000 / 6);
                }
            },
            setShanghaiTime: function(){
                clearInterval(this.transition_timeout);
                this.shanghai_time = !this.shanghai_time;
            },
            setTime: function (local) {
                //21600 bph = 360bpm = 6bps
                this.date = new Date;
                this.second = this.date.getSeconds();
                this.millisecond = this.date.getMilliseconds();
                this.second_rotation = "rotate(" + ((this.second + (this.millisecond / 1000)) * 6 - 90) + "deg) translateY(-50%)";
                this.second.toString().length === 1 ? this.second = '0' + this.second :null;

                this.minute = this.date.getMinutes();
                this.minute_rotation = "rotate(" + ((this.minute + ((this.second + (this.millisecond / 1000)) / 60)) * 6 - 90)+ "deg) translateY(-50%)";
                this.minute.toString().length === 1 ? this.minute = '0' + this.minute :null;

                this.hour = this.date.getHours();
                this.shanghai_time ? this.hour = this.hour + (8 + this.GMT) : null;
                this.hour > 24 ? this.hour = this.hour - 24 : null;
                this.hour_rotation = "rotate(" + (((this.hour + ((this.minute + ((this.second + (this.millisecond / 1000)) / 60)) / 60))* 30) - 90)  + "deg) translateY(-50%)";
                this.hour.toString().length === 1 ? this.hour = '0' + this.hour :null;

                this.gangreserve_degrees = this.gangreserve_degrees + (360/(42*60*60*60*6));
                this.gangreserve_rotation = "rotate(" + this.gangreserve_degrees + "deg)";

                this.day = this.date.getDate();
            },
            setSize: function () {
                this.clock_diameter = $("#clock").width();
                $("#clock").height(this.clock_diameter);
                $("#clock .base").css({
                    "width":this.clock_diameter*0.05 + "px",
                    "height":this.clock_diameter*0.05 + "px",
                    "border-width":this.clock_diameter*0.015 + "px",
                });
                $("#clock .second-container .base").css({
                    "width":this.clock_diameter*0.015 + "px",
                    "height":this.clock_diameter*0.015 + "px",
                    "border-width":this.clock_diameter*0.005 + "px",
                })
            }
        },
        created: function () {
            console.log("Vue ready");
            this.startClock();
            $('document').ready(() => {
                this.setSize()
            });

            $(window).on('resize', () => {
                this.setSize()
            });

            $(window).on('load', () => {
                this.setSize()
            });
        }
    }
</script>

<style>
    .clock-container {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #clock {
        position: relative;
        width: 100%;
        border-radius: 100%;
        background-color: #f9f8f6;
        border: 1vmin solid #dedede;
        box-sizing: border-box;
        background-image: url("/img/frontend/coding/nomos_metro_gangreserve.svg");
        background-position: center;
        background-repeat: no-repeat;
        background-size: 96%;
    }

    #crown-in {
        content: "";
        position: absolute;
        top: 50%;
        right: -4%;
        height: 10%;
        width: 3%;
        border-radius: 0.5vw;
        background-color: #dedede;
        transform: translateY(-50%);
        cursor: pointer;
    }

    #crown-out {
        content: "";
        position: absolute;
        top: 50%;
        right: -5%;
        height: 10%;
        width: 3%;
        border-radius: 0.5vw;
        background-color: #dedede;
        transform: translateY(-50%);
        cursor: pointer;
    }

    .second-container {
        position: absolute;
        top: 60%;
        left: 37.5%;
        width: 25%;
        height: 25%;
        border-radius: 100%;
        border: 0.15vmin #dedddb solid;
        background-color: #f7f7f7;
        background-image: url("/img/frontend/coding/nomos_metro_gangreserve_seconds.svg");
        background-position: center;
        background-repeat: no-repeat;
        background-size: 95%;
    }

    #second {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 47%;
        height: 1%;
        background-color: #f7594a;
        transform-origin: 0 0;
    }

    #second:after {
        position: absolute;
        content: "";
        left: -25%;
        top: 50%;
        height: 105%;
        width: 25%;
        transform: translateY(-80%);
        transform-origin: 0 0;
        background-color: #f7594a;
    }

    #minute {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 39.75%;
        height: 1%;
        background-color: #0d0d0d;
        transform-origin: 0 0;
        border-radius: 0.2vmin;
    }

    #minute:before {
        position: absolute;
        content: "";
        right: -20%;
        top: 50%;
        height: 40%;
        width: 25%;
        border-radius: 2px;
        transform: translateY(-50%);
        transform-origin: initial;
        background-color: #0d0d0d;
    }

    #hour {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 28%;
        height: 1%;
        background-color: #0d0d0d;
        transform-origin: 0 0;
        border-radius: 0.2vmin;
    }

    #hour:before {
        position: absolute;
        content: "";
        right: -35%;
        top: 50%;
        height: 40%;
        width: 40%;
        border-radius: 2px;
        transform: translateY(-50%);
        transform-origin: initial;
        background-color: #0d0d0d;
    }

    #clock .base{
        position: absolute;
        background-color: #c6c6c6;
        border-radius: 100%;
        border: 1px solid #000;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    #clock .second-container .base {
        position: absolute;
        background-color: #c6c6c6;
        border-radius: 100%;
        border: 0.05px solid #f7594a;
        width: 1%;
        height: 1%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    #gangreserve {
        position: absolute;
        width: 103%;
        height: 103%;
        border-radius: 100%;
        background-image: url(/img/frontend/coding/gangreserve.svg);
        background-position: center;
        background-repeat: no-repeat;
        transform-origin: center;
    }

    #gangreserve-backdial {
        position: absolute;
        top: 27%;
        left: 52%;
        width: 10%;
        height: 10%;
        background-position: 80% 99%;
        background-size: 80%;
        background-image: url(/img/frontend/coding/nomos_gangreserve_backdial.svg);
        background-repeat: no-repeat;
        transform: rotate(101deg);
        transform-origin: center;
    }

    #day {
        position: absolute;
        bottom: 5%;
        left: 50%;
        transform: translateX(-50%) scale(1.5,2.5);
        color: #111;
        padding: 0.5vmax 0.75vmax;
        font-size: 1.25vmax;
    }

    #day-window {
        position: absolute;
        left: 50%;
        bottom: 4%;
        transform: translateX(-50%);
        border-bottom: 4.5vmax solid #f0efed;
        border-left: 0.5vmax solid transparent;
        border-right: 0.5vmax solid transparent;
        height: 0;
        width: 5vmax;
    }

    .load-transition {
        transition: 1s;
        transition-timing-function: ease-out;
    }
</style>