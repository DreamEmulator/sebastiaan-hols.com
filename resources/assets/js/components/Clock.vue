<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header" v-on:click="setTime()">DUW 4101 - 21600 bph - {{hour}}:{{minute}}:{{second}}:{{millisecond}}</div>

                    <div class="card-body clock-container">

                        <div id="clock">
                            <div id="day">{{day}}</div>
                            <div class="second-container">
                                <div id="second" v-bind:style="{transform: second_rotation}"></div>
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
                power: 100
            }
        },
        methods: {
            startClock: function () {
                setInterval(() => {
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
        background-color: #f5f5f5;
        border: 1vmin solid #dedede;
        box-sizing: border-box;
    }

    .second-container {
        position: absolute;
        top: 60%;
        left: 35%;
        width: 30%;
        height: 30%;
        border-radius: 100%;
        background-color: #fff;
    }

    #second {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 45%;
        height: 0.15vmin;
        background-color: #ab4245;
        transform-origin: 0 50%;
    }

    #minute {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 35%;
        height: 0.15vmin;
        background-color: #0d0d0d;
        transform-origin: 0 50%;
    }

    .base{
        position: absolute;
        background-color: #c6c6c6;
        border-radius: 100%;
        border: 1px solid #000;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    #hour {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20%;
        height: 1%;
        background-color: #0d0d0d;
        transform-origin: 0 50%;
    }

    #day {
        position: absolute;
        bottom: 1vmin;
        left: 50%;
        transform: translateX(-50%);
        color: #111;
        padding: 2px 4px;
        background-color: #e0e0f1;
    }
</style>