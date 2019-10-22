<style>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 70%;
        height: 90%;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
        overflow-y: scroll;
    }
</style>
<!--START MOADL-->
<template>
    <div>
        <div class="card text-center" v-if="!creating" @click="creating = !creating">
            <span class="btn btn-secondary">New question.</span>
        </div>
        <div class="card" v-show="creating">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-container">
                        <div class="p-2">
                            <div class="form-group">
                                <label for="question_types">Choose the question type</label>
                                <select class="form-control" id="question_types" v-model="currentType">
                                    <option v-for="type in types">{{ type }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="question_body">Question body</label>
                                <textarea name="question_body" class="form-control" id="question_body" rows="5"
                                          placeholder="Input text here..." v-model="body">
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label for="points">Points for this question: {{ points }}/{{ maxPoints }}</label>
                                <input id="points" type="range" :max="maxPoints" min="1" value="1" class="custom-range"
                                       v-model="points">
                            </div>
                            <div>
                                <component :is="answerComponent"
                                           @ready="setAnswerData"
                                           @close="creating = !creating">
                                </component>
                                <div v-if="error" v-for="error in errors" class="small alert alert-danger">
                                    {{ error }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>

            </div>
        </div>
    </div>
</template>


<script>
    import Answers from './types/OneOrMoreAnswers'
    import InputNumber from './types/InputNumber'
    import InputString from './types/InputString'

    export default {
        components: {Answers, InputNumber, InputString},

        data() {
            return {
                creating: false,

                types: ['One or more answers', 'Input number', 'Input string'],
                currentType: 'One or more answers',
                answerComponent: 'Answers',

                errors: [],

                //question
                type: '',
                body: null,
                points: 1,

                maxPoints: 10,
                answer_data: null,
            }
        },

        watch: {
            currentType() {
                let components = ['Answers', 'InputNumber', 'InputString'];
                this.answerComponent = components[this.types.indexOf(this.currentType)]
            },
        },

        methods: {
            setAnswerData(data, type) {
                if (this.body) {
                    this.answer_data = data;
                    this.type = type;
                    this.addQuestion();
                } else {
                    this.errors = [];
                    this.errors.push('Question body is required field.');
                    setTimeout(() => this.errors = [], 10000);
                }
            },

            addQuestion() {
                // 'question_body'
                //     'question_type'
                //     'question_points'
                let data = {
                    question_body: this.body,
                    question_type: this.type,
                    question_points: this.points,
                    answer_data: this.answer_data
                };
                this.creating = !this.creating;
                this.$emit('create', data);
            }

        }
    }
</script>
