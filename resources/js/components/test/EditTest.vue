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
                                    <!--                                    <label for="timer" class="form-check-label">Timer</label>-->
                                    <input type="number" min="0" max="180" name="timer" id="timer" step="0.5"
                                           v-model="timer">
                                    <small class="form-text text-muted">180 minute is maximum.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-for="(question, index) in questions">
                        <show-question :question="question" :index="index"
                                       @edit="editQuestion"
                                       @delete="deleteQuestion"
                        ></show-question>
                    </div>
                    <div class="card text-center">
                        <span class="btn btn-secondary" @click="creatingQuestion = true">New question.</span>
                        <div>
                            <edit-question v-if="creatingQuestion"
                                           @create="addQuestion"
                                           @close="creatingQuestion = !creatingQuestion">
                            </edit-question>
                        </div>
                    </div>
                    <div class="card text-center my-3">
                        <div @click="readyToCreate" class="btn btn-primary">Create Test.</div>
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

    export default {
        components: {EditQuestion, ShowQuestion},

        data() {
            return {
                creatingQuestion: false,
                errors: [],

                testTitle: null,
                testAbout: null,
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
                    axios.post('/new', {
                        title: this.testTitle,
                        about: this.testAbout,
                        timer: this.timer,
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
