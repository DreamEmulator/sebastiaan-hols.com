<template>
  <div class="row">
    <gallery :images="locations" :index="index" @close="index = null; galleryOpen = false; playGallery=false;" ref="blueImpGallery"></gallery>

    <div class="card-columns col-lg-12">
      <div v-for="(image, imageIndex) in image_data" class="card rounded-card d-inline-block mt-2 mb-2 w-100">
        <img class="card-img-top"
             loading="lazy"
             @click="index = imageIndex; galleryOpen = true"
             :src="image.location"
        >
        <div class="card-body">
          <h4 class="card-title">{{ image.title }}</h4>
          <p class="card-text">{{ image.text }}</p>
        </div>
      </div>
    </div>
    <button id="galleryPlayButton" v-if="galleryOpen" v-on:click="playGallery">{{ !this.galleryPlaying ? 'Play' : 'Pause' }}</button>
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
      index: null,
      galleryOpen: false,
      galleryPlaying: false,
    };
  },
  components: {
    'gallery': VueGallery
  },
  methods:{
    playGallery: function (){
      if(!this.galleryPlaying){
        this.galleryPlaying = true
        this.$refs['blueImpGallery'].instance.play();
      } else {
        this.galleryPlaying = false
        this.$refs['blueImpGallery'].instance.pause();
      }
    }
  }
}
</script>

<style>
#galleryPlayButton {
  position: fixed;
  bottom: 1vh;
  left: 1vh;
  z-index: 1000000;
  color: rgba(255, 255, 255, 0.5);
  background: transparent;
  outline: 0;
  user-select: none;
}

#blueimp-gallery .next, #blueimp-gallery .prev {
  opacity: 0.1;
}

#blueimp-gallery .next:hover, #blueimp-gallery .prev:hover {
  opacity: 0.5;
}
</style>
