<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header" v-on:click="hackSeconds()">DUW 4101 - 21600 bph - {{hour}}:{{minute}}:{{second}}:{{millisecond}}</div>

                    <div class="card-body clock-container">

                        <div id="clock">
                            <div id="day">{{day}}</div>
                            <div class="second-container">
                                <div id="second" v-bind:style="{transform: second_rotation}"></div>
                                <div class="base"></div>
                            </div>
                            <div id="minute" v-bind:style="{transform: minute_rotation}"></div>
                            <div id="hour" v-bind:style="{transform: hour_rotation}"></div>
                            <div class="base"></div>
                        </div>

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
            }
        },
        methods: {
            hackSeconds: function (){
                console.log('clearing');
                clearInterval(this.interval);
            },
            startClock: function () {
                this.interval = setInterval(() => {
                    this.setTime()
                }, 1000 / 6);
            },
            setTime: function () {
                console.log('Setting time');
                //21600 bph = 360bpm = 6bps
                let date = new Date;

                this.second = date.getSeconds();
                this.millisecond = date.getMilliseconds();
                this.second_rotation = "rotate(" + ((this.second + (this.millisecond / 1000)) * 6 - 90) + "deg) translateY(-50%)";

                this.minute = date.getMinutes();
                this.minute_rotation = "rotate(" + ((this.minute + ((this.second + (this.millisecond / 1000)) / 60)) * 6 - 90)+ "deg) translateY(-50%)";

                this.hour = date.getHours();
                this.hour_rotation = "rotate(" + (((this.hour + ((this.minute + ((this.second + (this.millisecond / 1000)) / 60)) / 60))* 30) - 90)  + "deg) translateY(-50%)";

                this.day = date.getDate();
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
            })
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

    .second-container {
        position: absolute;
        top: 60%;
        left: 37.5%;
        width: 25%;
        height: 25%;
        border-radius: 100%;
        border: 0.15vmin #dedddb solid;
        background-color: #fff;
        background-image: url("/img/frontend/coding/nomos_metro_gangreserve_seconds.svg");
        background-position: center;
        background-repeat: no-repeat;
        background-size: 95%;
    }

    #second {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 45%;
        height: 1%;
        background-color: #ab4245;
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
        background-color: #ab4245;
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
        border: 0.05px solid #ab4245;
        width: 1%;
        height: 1%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    #day {
        position: absolute;
        bottom: 5%;
        left: 50%;
        transform: translateX(-50%);
        color: #111;
        padding: 3.5% 1%;
        font-size: 190%;
        background-color: #f0efed;
        line-height: 50%;
    }
</style>