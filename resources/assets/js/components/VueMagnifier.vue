<!--Thanks to: https://github.com/zeknoss/vue-magnifier-->

<template>
    <div class="vue-magnifier-container">
        <slot></slot>

        <div class="loading-container" v-bind:style="{animationDelay: animation}" v-if="loading">
            <div class="dot dot-1" v-bind:style="{animationDelay: animation}"></div>
            <div class="dot dot-2" v-bind:style="{animationDelay: animation}"></div>
            <div class="dot dot-3" v-bind:style="{animationDelay: animation}"></div>
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                <defs>
                    <filter id="goo">
                        <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur"/>
                        <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 21 -7"/>
                    </filter>
                </defs>
            </svg>
        </div>

        <span ref="magnificationElement" class="preview" v-on:click="moveMagnifier"
              v-bind:style="{height: height + 'px', width: width, backgroundImage:'url(' + src + ')'}">
          <span ref="glass" class="magnifying-glass"
                v-bind:style="{backgroundColor: backgroundColor, backgroundImage: 'url(' + srcLarge + ')', backgroundPosition: backgroundPos, left: cursorX + 'px', top: cursorY + 'px'}"></span>
      </span>

    </div>
</template>

<script>
    export default {
        props: {
            src: String,
            srcLarge: String,
            index: String,
        },
        computed: {
            animation: function () {
                return `${this.index * 0.3}s`;
            }
        },
        methods: {
            setHeight: function () {
                var image = new Image();
                image.src = this.src;
                var height = image.naturalHeight, width = image.naturalWidth;
                var ratio = (height / width);
                var maxWidth = 500;
                this.width = this.$refs.magnificationElement.offsetWidth;
                this.height = ratio * this.width;

                if (height > width && window.innerWidth > maxWidth) {
                    this.width = maxWidth + 'px';
                    this.height = ratio * maxWidth;
                }

                $('.preview').addClass('show');
                setTimeout(() => {
                    this.loading = false
                }, 2000);
            },
            getCursorPos: function (e) {

                var x = 0;
                var y = 0;

                if (e.type == "touchmove" || e.type == "touchstart") {

                    $(`.touch:not(n${this.index})`).removeClass('touch');

                    this.$refs.magnificationElement.classList.add('touch');
                    this.$refs.magnificationElement.classList.add(`n${this.index}`);

                    x = e.touches["0"].clientX +
                        (document.documentElement.scrollLeft
                            ? document.documentElement.scrollLeft
                            : document.body.scrollLeft);
                    y = e.touches["0"].clientY +
                        (document.documentElement.scrollTop
                            ? document.documentElement.scrollTop
                            : document.body.scrollTop);
                } else {

                    x = window.Event
                        ? e.pageX
                        : e.clientX +
                        (document.documentElement.scrollLeft
                            ? document.documentElement.scrollLeft
                            : document.body.scrollLeft);


                    y = window.Event
                        ? e.pageY
                        : e.clientY +
                        (document.documentElement.scrollTop
                            ? document.documentElement.scrollTop
                            : document.body.scrollTop);

                }

                this.cursorX = x - this.thumbPos.x - window.pageXOffset;
                this.cursorY = y - this.thumbPos.y - window.pageYOffset;

                if (this.cursorX < 0 || this.cursorY < 0 || this.cursorY > this.height || this.cursorX > this.width) {
                    this.$refs.magnificationElement.classList.remove('touch');
                    this.$forceUpdate()
                }

            },
            getBounds: function () {
                var el = this.$refs.magnificationElement;
                this.bounds = el.getBoundingClientRect();

                var xPos = 0;
                var yPos = 0;
                while (el) {
                    var transform = this.getTransform(el);
                    if (el.tagName == "BODY") {
                        // deal with browser quirks with body/window/document and page scroll
                        var xScroll = el.scrollLeft || document.documentElement.scrollLeft;
                        var yScroll = el.scrollTop || document.documentElement.scrollTop;

                        xPos +=
                            el.offsetLeft - xScroll + el.clientLeft + parseInt(transform[0]);
                        yPos +=
                            el.offsetTop - yScroll + el.clientTop + parseInt(transform[1]);
                    } else {
                        // for all other non-BODY elements
                        xPos +=
                            el.offsetLeft -
                            el.scrollLeft +
                            el.clientLeft +
                            parseInt(transform[0]);
                        yPos +=
                            el.offsetTop - el.scrollTop + el.clientTop + parseInt(transform[1]);
                    }

                    el = el.offsetParent;
                }
                this.thumbPos = {
                    x: xPos,
                    y: yPos
                };
            },
            moveMagnifier: function (e) {
                e.preventDefault();

                this.getBounds();
                this.getCursorPos(e);

                this.backgroundPos =
                    (this.cursorX * 100) / this.bounds.width +
                    "% " +
                    (this.cursorY * 100) / this.bounds.height +
                    "%";

            },
            getTransform: function (el) {
                var transform = window
                    .getComputedStyle(el, null)
                    .getPropertyValue("-webkit-transform");

                function rotate_degree(matrix) {
                    if (matrix !== "none") {
                        var values = matrix
                            .split("(")[1]
                            .split(")")[0]
                            .split(",");
                        var a = values[0];
                        var b = values[1];
                        var angle = Math.round(Math.atan2(b, a) * (180 / Math.PI));
                    } else {
                        var angle = 0;
                    }
                    return angle < 0 ? (angle += 360) : angle;
                }

                var results = transform.match(
                    /matrix(?:(3d)\(-{0,1}\d+\.?\d*(?:, -{0,1}\d+\.?\d*)*(?:, (-{0,1}\d+\.?\d*))(?:, (-{0,1}\d+\.?\d*))(?:, (-{0,1}\d+\.?\d*)), -{0,1}\d+\.?\d*\)|\(-{0,1}\d+\.?\d*(?:, -{0,1}\d+\.?\d*)*(?:, (-{0,1}\d+\.?\d*))(?:, (-{0,1}\d+\.?\d*))\))/
                );

                var output = [0, 0, 0];
                if (results) {
                    if (results[1] == "3d") {
                        output = results.slice(2, 5);
                    } else {
                        results.push(0);
                        output = results.slice(5, 9); // returns the [X,Y,Z,1] value;
                    }

                    output.push(rotate_degree(transform));
                }
                return output;
            }
        },
        mounted: function () {

            window.addEventListener('load', () => {
                this.setHeight();
            }),

            window.addEventListener('resize', () => {
                this.setHeight();
            }),

            this.$nextTick(function () {
                this.$refs.magnificationElement.addEventListener("mousemove", this.moveMagnifier);
                this.$refs.magnificationElement.addEventListener("touchstart", this.moveMagnifier);
                this.$refs.magnificationElement.addEventListener("touchmove", this.moveMagnifier);
            });

           this.backgroundColor =  $('body').css('background-color');

        },
        data: function () {
            return {
                loading: true,
                height: null,
                width: 'auto',
                scrollTop: null,
                bounds: null,
                cursorX: 0,
                cursorY: 0,
                thumbPos: {x: 0, y: 0},
                backgroundPos: "0 0",
                backgroundColor: null,
            };
        }
    };
</script>

<style lang="scss">
    // Magnifying glass options
    $border-size: 4px; // Modify the border width of the magnifying glass component
    $border-color: #202020;
    $magnifier-width: 200px; // Modify the width of the magnifying glass component
    $magnifier-height: 200px; // Modify the height of the magnifying glass component

    .vue-magnifier-container {
        position: relative;
        z-index: 1;
        min-height: 250px;

        &.scale {
            max-height: 200px;
        }
        .preview {
            position: relative;
            background: {
                repeat: no-repeat;
                size: cover;
                position: 50% 50%;
            }
            border-top: 2px solid #d2d2d2;
            border-left: 2px solid #b9b9b9;
            border-bottom: 2px solid #4e4d4d;
            border-right: 2px solid #8a8a8a;
            display: block;
            clear: both;
            margin: 0 auto;
            cursor: none;
            opacity: 0;

            &.show {
                opacity: 1;
                transition: opacity 0.5s 1s;
            }

            .magnifying-glass {
                position: absolute;
                border: $border-size solid $border-color;
                border-radius: 50%;
                cursor: none;
                width: $magnifier-width;
                height: $magnifier-height;
                transform: translate(
                                        (-1 * $magnifier-width/2),
                                        (-1 * $magnifier-width/2)
                );
                background: no-repeat;
                opacity: 0;
                transition: opacity 0.5s;
                pointer-events: none;

            }

            &.touch {
                .magnifying-glass {
                    opacity: 1;
                }
            }

            &:hover {
                .magnifying-glass {
                    opacity: 1;
                }
            }

        }
    }

    .loading-container {
        width: 100px;
        height: 100px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        margin: auto;
        filter: url('#goo');
        animation: rotate-move 2s ease-in-out infinite;
    }

    .dot {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background-color: #000;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
    }

    .dot-3 {
        background-color: #f74d75;
        animation: dot-3-move 2s ease infinite, index 6s ease infinite;
    }

    .dot-2 {
        background-color: #10beae;
        animation: dot-2-move 2s ease infinite, index 6s -4s ease infinite;
    }

    .dot-1 {
        background-color: #ffe386;
        animation: dot-1-move 2s ease infinite, index 6s -2s ease infinite;
    }

    @keyframes dot-3-move {
        20% {
            transform: scale(1)
        }
        45% {
            transform: translateY(-18px) scale(.45)
        }
        60% {
            transform: translateY(-90px) scale(.45)
        }
        80% {
            transform: translateY(-90px) scale(.45)
        }
        100% {
            transform: translateY(0px) scale(1)
        }
    }

    @keyframes dot-2-move {
        20% {
            transform: scale(1)
        }
        45% {
            transform: translate(-16px, 12px) scale(.45)
        }
        60% {
            transform: translate(-80px, 60px) scale(.45)
        }
        80% {
            transform: translate(-80px, 60px) scale(.45)
        }
        100% {
            transform: translateY(0px) scale(1)
        }
    }

    @keyframes dot-1-move {
        20% {
            transform: scale(1)
        }
        45% {
            transform: translate(16px, 12px) scale(.45)
        }
        60% {
            transform: translate(80px, 60px) scale(.45)
        }
        80% {
            transform: translate(80px, 60px) scale(.45)
        }
        100% {
            transform: translateY(0px) scale(1)
        }
    }

    @keyframes rotate-move {
        55% {
            transform: translate(-50%, -50%) rotate(0deg)
        }
        80% {
            transform: translate(-50%, -50%) rotate(360deg)
        }
        100% {
            transform: translate(-50%, -50%) rotate(360deg)
        }
    }

    @keyframes index {
        0%, 100% {
            z-index: 3
        }
        33.3% {
            z-index: 2
        }
        66.6% {
            z-index: 1
        }
    }
</style>
