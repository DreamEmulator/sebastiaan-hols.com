<template>
    <div class="loading-target">
        <vue-magnifier ref="magnifier" v-if="index < load" v-for="(painting,index) in paintings" v-bind:src="painting.location" v-bind:src-large="painting.location" :painter="painting.subtitle" :title="painting.title" :key="painting.id" :index="painting.id"></vue-magnifier>
        <button v-if="load !== paintings.length" class="mt-2 w-25 btn rainborder" v-on:click="load_extra">More art!</button>
    </div>
</template>

<script>
    import VueMagnifier from './VueMagnifier'

    export default {
        name: "VueLoader",
        components: {
            VueMagnifier
        },
        data: function(){
            return {
                paintings: 0,
                load: 1,
                allowLoad: true,
            }
        },
        methods: {
            load_extra: function(){
                this.load++;
                $("html, body").animate({ scrollTop: document.body.scrollHeight }, "slow")
            }
        },
        mounted: function() {
            axios.get('/load_paintings').then(response => (this.paintings = response.data));
        }
    }
</script>

<style scoped>

</style>