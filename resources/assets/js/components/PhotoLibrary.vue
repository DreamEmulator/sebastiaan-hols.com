<template>
    <div class="row">
        <gallery :images="locations" :index="index" @close="index = null"></gallery>

        <div v-for="image, imageIndex in image_data" class="col-lg-6 mt-2 mb-2">
            <div class="card">
                <img class=" card-img-top"
                     @click="index = imageIndex"
                     :src="image.location"
                >
                <div class="card-body">
                    <h4 class="card-title">{{image.title}}</h4>
                    <p class="card-text">{{image.text}}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import VueGallery from 'vue-gallery';

    export default {
        props: ['photos'],
        data: function () {
            return {
                image_data: this.photos,
                locations: _.map(this.photos, 'location'),
                index:null
            };
        },
        components: {
            'gallery': VueGallery
        },
    }
</script>