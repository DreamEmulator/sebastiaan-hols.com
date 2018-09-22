<template>
    <div class="card my-5">

        <div :class="[skillsButton]" v-on:click="show_list = !show_list; load_json()">
            <div class="card-title text-center">
                <h5 class="skills-button-title my-4">{{dropdown}} Skills</h5>
            </div>
        </div>

        <transition name="fade">
            <div class="list-wrapper">
                <button v-if="prod == true && show_list == true" v-on:click="auth = !auth; previewing = !previewing; load_json()"
                        class="btn-primary w-100">Preview
                </button>
                <ul v-if="show_list" class="list-group list-group-flush list-border">

                    <li v-for="(value, key, index) in skills" v-on:click="show_text(key + '_text', $event)"
                        v-if="key.indexOf('_text') == -1" :class="skill">

                <span>
                    <button v-if="remove_skills==true" v-on:click="remove_skill(key)">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    <h6>{{key}}</h6>
                </span>

                        <div :style="{width: value+'%', transitionDelay: index + 's' }"
                             v-if="auth!=true" class="skill-slider w-0 my-4">
                        </div>

                        <input type="range" class="form-control-range mb-3" min="1" max="100"
                               v-if="auth==true"
                               v-model="skills[key]"
                               v-on:change="changed_skills=true">

                        <p v-if="auth!==true" class="skill-description">{{skills[key + '_text']}}</p>
                        <p v-if="auth!==true && skills[key + '_text']" class="show-skill-description">show</p>

                        <input v-if="auth==true" v-model="skills[key + '_text']" v-on:input="changed_skills=true"
                               type="text" class="form-control mb-2" placeholder="Describe skill" maxlength="240"/>
                    </li>

                    <li v-if="add_skill==true" class="list-group-item">
                        <input class="form-control mb-2" type="text" placeholder="New skill" v-model="new_skill_name">
                        <input type="range" class="form-control-range" min="1" max="100"
                               v-model="new_skill_level">
                    </li>

                </ul>
            </div>
        </transition>

        <div v-if="auth && show_list" class="card-body">
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
        pointer-events: none;
    }

    .skill.visit > * {
        user-select: none;
    }

    .skill.visit:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        z-index: 1;
    }

    .w-0 {
        width: 0 !important;
        transition: 0s !important;
    }

    .skill .show-skill-description {
        float: right;
        opacity: 0;
        font-size: 1em;
        color: #a6a6a6;
        margin: -2em 0 0 0;
        transition: margin 0.5s 0.5s, opacity 0.5s;
    }

    .skill:hover .show-skill-description {
        opacity: 1;
    }

    .skill.open .show-skill-description {
        margin: 1em 0 0 0;
        opacity: 1;
        transition: margin 0.5s 0s;
    }

    .skill-description {
        margin: 0;
        opacity: 0;
        max-height: 0px;
        transition: max-height 0.25s 0.25s, opacity 0.5s;
    }

    .skill.open .skill-description {
        opacity: 1;
        max-height: 1000px;
        transition: max-height 0.5s, opacity 0.25s 0.25s;
    }

    @media screen and (max-width: 1024px) {
        .skill .show-skill-description {
            opacity: 1;
        }
    }

    .skills-button {
        border: 0.05em solid #b9b9b9;
        transition: border 0.5s 1s;
    }

    .skills-button.open {
        transition: border 0s;
        border-bottom: none;
    }

    .list-border {
        border: 0.05em solid #b9b9b9;
        border-top: none;
    }

    .skills-button-title {
        user-select: none;
        position: relative;
    }

    .skills-button-title:before {
        content: "";
        position: absolute;
        height: 1em;
        width: 1em;
        left: 50%;
        bottom: -1.25em;
        transition: border 0.25s;
        transform: translateX(-50%) rotate(45deg);
    }

    .skills-button.closed .skills-button-title:before {
        border-left: 2px solid rgba(0, 0, 0, 0);
        border-top: 2px solid rgba(0, 0, 0, 0);
    }

    .skills-button.open .skills-button-title:before {
        bottom: -1.75em;
        border-right: 2px solid rgba(0, 0, 0, 0);
        border-bottom: 2px solid rgba(0, 0, 0, 0);
    }

    body.text-dark .skills-button.closed .skills-button-title:before {
        border-right: 2px solid rgba(0, 0, 0, 1);
        border-bottom: 2px solid rgba(0, 0, 0, 1);
    }

    body.text-dark .skills-button.open .skills-button-title:before {
        border-left: 2px solid rgba(0, 0, 0, 1);
        border-top: 2px solid rgba(0, 0, 0, 1);
    }

    body.text-light .skills-button.closed .skills-button-title:before {
        bottom: -0.9em;
        border-right: 2px solid rgba(255, 255, 255, 1);
        border-bottom: 2px solid rgba(255, 255, 255, 1);
    }

    body.text-light .skills-button.open .skills-button-title:before {
        border-left: 2px solid rgba(255, 255, 255, 1);
        border-top: 2px solid rgba(255, 255, 255, 1);
    }

    .fade-enter {
        max-height: 0px;
    }

    .fade-enter li {
        opacity: 0;
    }

    .fade-enter-to {
        max-height: 1000px;
    }

    .fade-enter-active, .fade-leave-active {
        border: 0.05em solid #b9b9b9;
        border-top: none;
        transition: max-height 1s;
    }

    .fade-enter-active li, .fade-leave-active li {
        transition: opacity .5s;
    }

    .fade-leave {
        max-height: 1000px;
    }

    .fade-leave-to {
        max-height: 0px;
    }

    .fade-leave-to li {
        opacity: 0;
    }

</style>

<script>
    export default {
        props: ['prod', 'skill_name', 'saved_skills'],
        computed: {
            skill: function () {
                if (this.prod !== true || this.previewing == true) {
                    return "list-group-item skill visit";
                } else {
                    return "list-group-item skill";
                }
            }
            ,
            json_string: function () {
                this.saved_skills[this.skill_name] = this.skills;
                return JSON.stringify(this.saved_skills);
            },
            dropdown: function () {
                if (this.show_list) {
                    this.skillsList = "open";
                    return "Hide";
                } else {
                    this.skillsList = "closed";
                    return "Show";
                }
            },
            skillsButton: function () {
                if (this.show_list) {
                    return "card skills-button open";
                } else {
                    return "card skills-button closed";
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
                previewing: false,
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
            show_text: function (text, event) {
                $($('.skill')[$(event.target).index()]).toggleClass('open');
                $('.skill .show-skill-description').text('show');
                $('.skill.open .show-skill-description').text('hide');
            }
        },
        mounted() {
            this.load_json();
            this.auth = this.prod;
        }
    }
</script>