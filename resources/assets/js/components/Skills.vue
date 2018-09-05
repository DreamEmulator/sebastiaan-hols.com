<template>
    <div class="card my-4">
        <ul class="list-group list-group-flush">
            <li class="list-group-item" v-for="(value, key) in skills">
                <span>{{key}}</span><span><input type="range" class="form-control-range" id="formControlRange" min="1" max="10" v-model="skills[key]"></span>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                skills: {
                    html: 9,
                    scss: 10,
                    js: 7,
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
