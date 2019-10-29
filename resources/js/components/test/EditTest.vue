<style>
</style>
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 py-3">
                <form>
                    <div class="card p-3 m-2">
                        <div class="form-group">
                            <label for="title">Test title</label>
                            <input name="title" type="text" class="form-control" id="title"
                                   placeholder="Enter test title" v-model="testTitle">
                            <small class="form-text text-muted">This field is required.</small>
                        </div>
                        <div class="form-group">
                            <label for="about">About this test</label>
                            <textarea name="about" class="form-control" id="about" rows="6"
                                      placeholder="Here you can describe this test" v-model="testAbout">
                            </textarea>
                        </div>
                        <div class="my-3">
                            <label for="tags">Test tags:</label>
                            <tags-bar v-model="testTags"
                                      :old="testTags"></tags-bar>
                            <small class="form-text text-muted">Test must include at least one tag.</small>
                        </div>

                        <div class="form-row text-center">
                            <div class="col-5 border p-0 ml-1 mr-auto">
                                <div class="custom-control custom-checkbox m-1">
                                    <input class="custom-control-input" type="checkbox" v-model="full_result"
                                           id="detailInfo">
                                    <label class="custom-control-label" for="detailInfo">
                                        Test person can see the detailed result?
                                    </label>
                                </div>
                            </div>

                            <div class="col-5 border mr-1 ml-auto">
                                <div class="custom-control custom-checkbox m-1">
                                    <input class="custom-control-input" type="checkbox" value="" id="timerEnable"
                                           v-model="timerEnable" @click="
                                            timerEnable ? timer = null : ''">
                                    <label class="custom-control-label" for="timerEnable">
                                        Timer enable?
                                    </label>
                                </div>
                                <div class="form-check m-1" v-show="timerEnable">
                                    <input type="number" min="0" max="180" name="timer" id="timer" step="0.5"
                                           v-model="timer">
                                    <small class="form-text text-muted">180 minute is maximum.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card">
                            <div class="btn btn-secondary text-center" @click="editQuestion=true" v-if="editing && !editQuestion">
                                <h3>Do you wanna edit questions?</h3>
                                <h5>Click here to do this.</h5>
                                <h5>If you do this all current test results will be old</h5>
                            </div>
                        </div>
                        <draggable v-if="editing && editQuestion" v-model="questions">
                            <div v-for="(question, index) in questions">
                                <show-question :question="question" :index="index"
                                               @edit="editQuestion"
                                               @delete="deleteQuestion"
                                ></show-question>
                            </div>
                        </draggable>
                    </div>
                    <div v-if="editQuestions" class="card text-center">
                        <span class="btn btn-secondary" @click="creatingQuestion = true">New question.</span>
                        <div>
                            <edit-question v-if="creatingQuestion"
                                           @create="addQuestion"
                                           @close="creatingQuestion = !creatingQuestion">
                            </edit-question>
                        </div>
                    </div>
                    <div class="card text-center my-3">
                        <div v-if="editing" @click="readyToCreate" class="btn btn-primary">Edit test.</div>
                        <div v-else @click="readyToCreate" class="btn btn-primary">Create test.</div>
                    </div>
                    <div class="alert alert-danger" v-for="error in errors">
                        {{ error }}
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

    import EditQuestion from './question/EditQuestion'
    import ShowQuestion from './question/ShowQuestion'
    import Draggable from 'vuedraggable'

    export default {
        components: {EditQuestion, ShowQuestion, Draggable},

        props: ['data'],

        mounted() {
            let data = JSON.parse(this.data);
            if (data) {
                this.editing = true;
                this.action = 'Edit test.';
                this.sendDataPath = '/new/' + data.id;
                this.newData = data;
                this.testTitle = data.title;
                this.testAbout = data.about;
                this.testTags = data.tags;
                if (data.timer) {
                    this.timer = data.timer;
                    this.timerEnable = true;
                }
                data.version.questions.forEach((question) => {
                    question.answer_data = question.answers.answer_data;
                });
                this.full_result = data.full_result;
                this.questions = data.version.questions;
            }else{
                this.editQuestion = true;
            }
        },

        data() {
            return {
                editing: false,
                editQuestion: false,
                action: 'Create Test.',
                newData: null,
                sendDataPath: '/new',
                creatingQuestion: false,
                errors: [],

                testTitle: null,
                testAbout: null,
                testTags: null,
                timer: null,
                timerEnable: false,
                full_result: false,
                questions: []
            }
        },

        methods: {
            addQuestion(question) {
                this.questions.push(question);
                this.creatingQuestion = false;
            },

            editQuestion(question, index) {
                Vue.set(this.questions, index, question);
            },

            deleteQuestion(index) {
                this.questions.splice(index, 1);
            },

            readyToCreate() {
                if (this.validate()) {
                    axios.post(this.sendDataPath, {
                        editQuestion: this.editQuestion,
                        title: this.testTitle,
                        about: this.testAbout,
                        timer: this.timer,
                        tags: this.testTags,
                        full_result: this.full_result,
                        questions: this.questions
                    });
                } else {
                    setTimeout(() => this.errors = [], 10000);
                }
            },

            validate() {
                this.errors = [];
                let isValid = true;
                if (!this.testTitle) {
                    this.errors.push('Test must include at least one tag');
                    isValid = false;
                }
                if (!this.testTags) {
                    this.errors.push('Title is required field!');
                    isValid = false;
                }
                if (this.questions.length < 1) {
                    this.errors.push('Your must contain at least one question!');
                    isValid = false;
                }
                return isValid;
            }
        }
    }
</script>
