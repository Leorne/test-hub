<template>
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
                        <label>Test tags:</label>
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
                <div class="card text-center">
                    <div v-for="(question,index) in questions">
                        <ShowQuestion :question="question"
                                      :index="index"/>
                    </div>
                    <NewQuestionModal v-model="creatingQuestion" :questions="questions"/>
                    <span class="btn btn-secondary" @click="creatingQuestion = true">New question.</span>
                </div>
                <div class="card text-center my-3">
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import NewQuestionModal from "./NewQuestionModal";
    import ShowQuestion from "./ShowQuestion";

    export default {
        components: {
            NewQuestionModal,
            ShowQuestion
        },

        data() {
            return {
                creatingQuestion: false,
                testTitle: '',
                testAbout: '',
                full_result: false,
                timerEnable: false,
                timer: null,
                testTags: {},
                questions: [],
            }
        },

        methods: {
            setQuestions(newQuestions) {
                this.questions = newQuestions;
            },
        }
    }
</script>
