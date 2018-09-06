<!--TODO-->
<!--Save json and stage the loading effect-->
<template>
    <div class="card my-4">
        <ul class="list-group list-group-flush">
            <li class="list-group-item" v-for="(value, key, index) in skills">
                <span><button v-if="remove_skills==true" v-on:click="remove_skill(key)"><i
                        class="fas fa-trash-alt"></i></button>
                {{key}}</span>
                <div class="skill-slider"
                     :style="{width: value+'%', transitionDelay: index + 's' }"
                     v-if="prod!=true"></div>
                <input type="range" class="form-control-range" min="1" max="100"
                       v-if="prod==true"
                       v-model="skills[key]"
                       v-on:click="changed_skills=true" >
            </li>
            <li v-if="add_skill==true" class="list-group-item">
                <input class="form-control mb-2" type="text" placeholder="New skill" v-model="new_skill_name">
                <input type="range" class="form-control-range" min="1" max="100"
                       v-model="new_skill_level">
            </li>
        </ul>
        <div v-if="prod" class="card-body">
            <button v-if="changed_skills==true" v-on:click="save_json" class="btn-success">Save changes
            </button>
            <button v-if="add_skill==false && remove_skills==false"  v-on:click="add_skill = !add_skill" class="btn-success">New skill
            </button>
            <button v-if="add_skill==true && remove_skills==false" v-on:click="save_new_skill" class="btn-success">Add
                skill
            </button>
            <button v-if="add_skill==true && remove_skills==false" v-on:click="add_skill=false"
                    class="btn-danger float-right">Cancel
            </button>

            <button v-if="remove_skills==false && add_skill==false" v-on:click="remove_skills = !remove_skills"
                    class="btn-warning">Remove skill
            </button>
            <button v-if="remove_skills==true" v-on:click="remove_skills = false" class="btn-danger float-right">Cancel
            </button>
        </div>
    </div>
</template>

<style>
    .skill-slider {
        background: linear-gradient(to right, #b7deed 0%, #21b4e2 50%, #b7deed 100%);
        width: 0%;
        height: 1em;
        transition: width 1s;
    }

    .w-0 {
        width: 0 !important;
    }
</style>

<script>
    export default {
        props: ['prod'],
        computed: {
            json_string: function () {
                return JSON.stringify(this.skills);
            }
        },
        data: function () {
            return {
                changed_skills: false,
                remove_skills: false,
                add_skill: false,
                new_skill_name: "",
                new_skill_level: 0,
                skills: {
                    HTML: 90,
                    SCSS: 80,
                    JS: 95,
                    PHP: 75,
                    MVC: 90,
                    OOP: 85,
                }
            }
        },
        methods: {
            save_new_skill: function () {
                this.skills[this.new_skill_name] = this.new_skill_level;
                this.add_skill = false;
                this.new_skill_name = "";
                this.new_skill_level = 0;
                this.$forceUpdate();
            },
            remove_skill: function (name) {
                delete this.skills[name];
                this.remove_skills = false;
                this.$forceUpdate();
            }
        },
        mounted() {
            console.log('Component mounted.');
            let skills = $('.skill-slider');
            skills.addClass('w-0');
            setTimeout(function () {
                skills.removeClass('w-0');
            }, 500);
        }
    }
</script>