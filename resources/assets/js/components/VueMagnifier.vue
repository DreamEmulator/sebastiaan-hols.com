<!--Thanks to: https://github.com/zeknoss/vue-magnifier-->

<template>
    <div ref="magnificationContainer" class="vue-magnifier-container">
        <slot></slot>
        <h3 class="mt-4"> {{title}}</h3>
        <h4> {{painter}}</h4>
        <div class="loading" v-if="loading"></div>
        <span ref="magnificationElement" class="preview rounded-card" v-on:click="moveMagnifier"
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
            index: Number,
            title: String,
            painter: String,
        },
        methods: {
            setHeight: function (resize) {
                this.image = new Image();
                this.image.src = this.src;
                var measure = () => {
                    let height = this.image.naturalHeight, width = this.image.naturalWidth;
                    let ratio = (height / width);
                    let maxWidth = 500;
                    this.width = this.$refs.magnificationContainer.offsetWidth;
                    this.height = ratio * this.width;

                    if (height > width && window.innerWidth > maxWidth) {
                        this.width = maxWidth + 'px';
                        this.height = ratio * maxWidth;
                    }
                }

                if (resize == true){
                    measure();
                 } else {
                    console.log('loading: ' + this.src );
                    var loaded = setInterval(()=>{
                        if (this.image.complete){
                            clearInterval(loaded);
                            measure();
                            $('.preview').addClass('show');
                            setTimeout(() => {
                                this.loading = false
                                $("html, body").animate({ scrollTop: document.body.scrollHeight }, "slow");
                            }, 1000);
                        }
                    },100);
                }
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

            this.setHeight();

            window.addEventListener('resize', () => {
                const resize = true;
                this.setHeight(resize);
            }),

            this.$nextTick(function () {
                this.$refs.magnificationElement.addEventListener("mousemove", this.moveMagnifier);
                this.$refs.magnificationElement.addEventListener("touchstart", this.moveMagnifier);
                this.$refs.magnificationElement.addEventListener("touchmove", this.moveMagnifier);
            });

            this.backgroundColor = $('body').css('background-color');

        },
        data: function () {
            return {
                image: null,
                paintings: 0,
                show: false,
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
        min-height: 200px;

        &.scale {
            max-height: 200px;
        }

        .loading {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: 10%;
            background-position: 50% 50%;
            background-repeat: no-repeat;
            background-image: url("/img/frontend/paintings/loading.gif");
        }

        .preview {
            position: relative;
            background: {
                repeat: no-repeat;
                size: cover;
                position: 50% 50%;
            }
            /*border-top: 2px solid #d2d2d2;*/
            /*border-left: 2px solid #b9b9b9;*/
            /*border-bottom: 2px solid #4e4d4d;*/
            /*border-right: 2px solid #8a8a8a;*/
            display: block;
            clear: both;
            margin: 0 auto;
            cursor: none;
            opacity: 0;

            &.show {
                opacity: 1;
                transition: opacity 0.5s 1s;
                max-height: none;
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

</style>
