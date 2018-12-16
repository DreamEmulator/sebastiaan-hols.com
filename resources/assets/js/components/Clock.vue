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
                            <div id="day-window"></div>
                            <div id="day">{{day}}</div>
                            <div class="second-container">
                                <div id="second" class="load-transition" v-bind:style="{transform: second_rotation}"></div>
                                <div class="base"></div>
                            </div>
                            <div id="minute" class="load-transition" v-bind:style="{transform: minute_rotation}"></div>
                            <div id="hour" class="load-transition" v-bind:style="{transform: hour_rotation}"></div>
                            <div class="base"></div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <button v-on:click="startClock()" v-bind:class="{'text-muted': hacking_seconds}" class="btn btn-light">Start clock</button>
                        <button v-on:click="hackSeconds()"v-bind:class="{'text-muted': !hacking_seconds}" class="btn btn-light">Hack seconds</button>
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
                gangreserve_degrees: 32,
                gangreserve_rotation: '',
                GMT: 0,
            }
        },
        methods: {
            hackSeconds: function (){
                this.hacking_seconds = !this.hacking_seconds;
                clearInterval(this.interval);
            },
            startClock: function () {
                if (!this.hacking_seconds){
                    this.hacking_seconds = !this.hacking_seconds;
                    this.interval = setInterval(() => {
                        this.setTime()
                    }, 1000 / 6);
                }
            },
            setTime: function () {
                //21600 bph = 360bpm = 6bps
                this.date = new Date;

                this.second = this.date.getSeconds();
                this.millisecond = this.date.getMilliseconds();
                this.second_rotation = "rotate(" + ((this.second + (this.millisecond / 1000)) * 6 - 90) + "deg) translateY(-50%)";

                this.minute = this.date.getMinutes();
                this.minute_rotation = "rotate(" + ((this.minute + ((this.second + (this.millisecond / 1000)) / 60)) * 6 - 90)+ "deg) translateY(-50%)";

                this.hour = this.date.getHours();
                this.hour_rotation = "rotate(" + (((this.hour + ((this.minute + ((this.second + (this.millisecond / 1000)) / 60)) / 60))* 30) - 90)  + "deg) translateY(-50%)";

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
                setTimeout(()=>{$('#second.load-transition').removeClass('load-transition');},3000);
                setTimeout(()=>{$('.load-transition').removeClass('load-transition');},10000);
            });

            $(window).on('resize', () => {
                this.setSize()
                setTimeout(()=>{$('.load-transition').removeClass('load-transition');},10000);
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

    #clock:after {
        content: "";
        position: absolute;
        top: 50%;
        right: -4%;
        height: 10%;
        width: 3%;
        border-radius: 0.5vw;
        background-color: #dedede;
        transform: translateY(-50%);
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
        background-size: 100%;
        transform-origin: center;
    }

    #gangreserve-backdial {
        position: absolute;
        top: 27%;
        left: 52%;
        width: 10%;
        height: 10%;
        border-radius: 100%;
        background-image: url(/img/frontend/coding/nomos_gangreserve_backdial.svg);
        background-position: 0% 100%;
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
        padding: 0.5vw 0.75vw;
        font-size: 1.25vw;
    }

    #day-window {
        position: absolute;
        left: 50%;
        bottom: 4%;
        transform: translateX(-50%);
        border-bottom: 4.5vw solid #f0efed;
        border-left: 0.5vw solid transparent;
        border-right: 0.5vw solid transparent;
        height: 0;
        width: 5vw;
    }

    .load-transition {
        transition: 1s;
        transition-timing-function: linear;
    }
</style>