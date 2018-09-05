<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>High Score <span class="badge badge-secondary">{{highscore}}</span></h1>
                <h1>Rank <span class="badge badge-secondary">{{rank}}</span></h1>
            </div>
        </div>
    </div>
</template>

<style>

</style>

<script>
    export default {
        props: ['last_highscore'],
        data: function () {
            return {
                highscore: 0
            }
        },
        computed: {
            rank: function () {
                switch (true) {
                    case this.highscore < 3:
                        return 'Noob'
                        break;
                    case this.highscore >= 3 && this.highscore < 6:
                        return 'Rookie'
                        break;
                    case this.highscore >= 6 && this.highscore < 9:
                        return 'Upstart'
                        break;
                    case this.highscore >= 9 && this.highscore < 12:
                        return 'Whippersnapper'
                        break;
                    case this.highscore >= 12 && this.highscore < 15:
                        return 'Lieutenant'
                        break;
                    case this.highscore >= 15 && this.highscore < 18:
                        return 'Consigliere'
                        break;
                    case this.highscore >= 18 && this.highscore < 21:
                        return 'Super Hans'
                        break;
                    case this.highscore >= 24 && this.highscore < 27:
                        return 'Arend'
                        break;
                    case this.highscore >= 27:
                        return 'Functioning God Class'
                        break;
                }
            }
        },
        watch: {
            highscore: function () {
                if (this.highscore > this.last_highscore) {
                    $.get('/highscore/' + this.highscore)
                }
            }
        },
        created: function () {
            $.vue_app = this;
            this.highscore = this.last_highscore;
        }
    }
</script>
