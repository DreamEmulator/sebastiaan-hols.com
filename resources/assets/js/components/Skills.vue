<template>
    <div class="card my-4">
        <div class="card-body">
            <div class="card-title text-center">
                <h5 v-on:click="show_list = !show_list; load_json()" :class="[skillsButton, skillsList]">{{dropdown}} Skills</h5>
                <button v-if="prod == true" v-on:click="auth = !auth; load_json()" class="btn-primary">Preview</button>
            </div>
        </div>
        <ul v-if="show_list" class="list-group list-group-flush">
            <li v-for="(value, key, index) in skills" v-on:click="show_text(key + '_text')" v-if="key.indexOf('_text') == -1" class="list-group-item">
                <span>
                    <button v-if="remove_skills==true" v-on:click="remove_skill(key)">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    <h6>{{key}}</h6>
                </span>
                <div :style="{width: value+'%', transitionDelay: index + 's' }"
                     v-if="auth!=true" class="skill-slider w-0 mb-4"></div>
                <input type="range" class="form-control-range" min="1" max="100"
                       v-if="auth==true"
                       v-model="skills[key]"
                       v-on:change="changed_skills=true">
                <p v-if="auth!==true" :class="key + '_text'" style="display: none">{{skills[key + '_text']}}</p>
                <input v-if="auth==true" v-model="skills[key + '_text']" v-on:input="changed_skills=true"
                       type="text" class="form-control mb-2" placeholder="Describe skill" maxlength="240"/>
            </li>
            <li v-if="add_skill==true" class="list-group-item">
                <input class="form-control mb-2" type="text" placeholder="New skill" v-model="new_skill_name">
                <input type="range" class="form-control-range" min="1" max="100"
                       v-model="new_skill_level">
            </li>
        </ul>
        <div v-if="auth" class="card-body">
            <button v-if="changed_skills==true && add_skill==false && remove_skills==false" v-on:click="save_json"
                    class="btn-success">Save changes
            </button>
            <button v-if="changed_skills==true && add_skill==false && remove_skills==false" v-on:click="load_json"
                    class="btn-danger float-right">Cancel changes
            </button>

            <button v-if="add_skill==true && remove_skills==false" v-on:click="add_skill=false"
                    class="btn-danger float-right">Cancel
            </button>
            <button v-if="remove_skills==false && add_skill==false && changed_skills==false"
                    v-on:click="remove_skills = !remove_skills"
                    class="btn-warning float-right">Remove skill
            </button>
            <button v-if="remove_skills==true" v-on:click="remove_skills = false" class="btn-danger float-right">Cancel
            </button>
            <button v-if="add_skill==false && remove_skills==false && changed_skills==false"
                    v-on:click="add_skill = !add_skill" class="btn-primary float-right mr-2">New skill
            </button>
            <button v-if="add_skill==true && remove_skills==false && changed_skills==false" v-on:click="add_new_skill"
                    class="btn-primary">Add skill
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
        transition: 0s !important;
    }
</style>

<script>
    export default {
        props: ['prod', 'skill_name', 'saved_skills'],
        computed: {
            json_string: function () {
                this.saved_skills[this.skill_name] = this.skills;
                return JSON.stringify(this.saved_skills);
            },
            dropdown: function(){
                if (this.show_list){
                    this.skillsList = "open";
                    return "Hide";
                } else {
                    this.skillsList = "closed";
                    return "Show";
                }
            }
        },
        data: function () {
            return {
                auth: false,
                show_list: false,
                changed_skills: false,
                remove_skills: false,
                add_skill: false,
                new_skill_name: "",
                new_skill_level: 0,
                new_skill_text: "",
                skills: {},
                skillsList: "open",
                skillsButton: "skills-button"
            }
        },
        methods: {
            load_json: function () {
                this.saved_skills[this.skill_name] !== undefined ? this.skills = this.saved_skills[this.skill_name] : {};
                this.changed_skills = false;
                this.remove_skills = false;
                this.add_skill = false;
                setTimeout(function () {
                    $('.skill-slider').removeClass('w-0');
                }, 100);
                this.$forceUpdate();
            },
            save_json: function () {
                document.getElementById('skills_json').value = this.json_string;
                document.getElementById('submit_skills').click();
            },
            add_new_skill: function () {
                this.skills[this.new_skill_name] = this.new_skill_level;
                this.skills[this.skill_name + '_text'] = this.new_skill_text;
                this.add_skill = false;
                this.new_skill_name = "";
                this.new_skill_level = 0;
                this.changed_skills = true;
                this.$forceUpdate();
            },
            remove_skill: function (name) {
                delete this.skills[name];
                this.remove_skills = false;
                this.changed_skills = true;
                this.$forceUpdate();
            },
            show_text: function (text) {
                $('.' + text).toggle();
            }
        },
        mounted() {
            this.load_json();
            this.auth = this.prod;
        }
    }
</script>