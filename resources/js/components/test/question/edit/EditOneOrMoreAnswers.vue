<template>
    <div>
        <div class="form-group p-2">
            <div class="form-group" v-for="(answer, index) in answers">
                <label :for="answer" class="align-content-start">Answer №{{index+1}}</label>
                <div class="form-row">
                    <div class="col-9">
                        <input class="form-control" :class="answer.correct ? 'is-valid' : ''" :id="answer" type="text"
                               v-model="answer.body">
                    </div>
                    <div class="col-2">
                        <input :id="index" type="checkbox" v-model="answer.correct" @click="setCorrect(index)">
                        <label class="small" :for="index">Is correct?</label>
                    </div>
                    <div class="col-1 text-right">
                        <span class="btn btn-danger" @click="removeAnswer(index)">
                            X
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn btn-outline-secondary" v-if="countAnswers < maxCountAnswers" @click="addAnswer">
            +
        </div>
        <div class="d-flex justify-content-between align-items-start m-2">
            <div class="btn btn-primary" v-if="this.$parent.editing" @click="answersIsReady">
                Edit
            </div>
            <div class="btn btn-success" v-else @click="answersIsReady">
                Add question
            </div>
            <div class="btn btn-danger" @click="$emit('close')">
                Close
            </div>
        </div>
        <div v-if="error" v-for="error in errors" class="small alert alert-danger">
            {{ error }}
        </div>

    </div>
</template>

<script>
    export default {
        props: ['data'],

        data() {
            return {
                answers: [],

                maxCountAnswers: 10,
                countAnswers: 0,
                countCorrect: 0,
                errors: [],
            }
        },

        created() {
            if (this.data) {
                this.answers = JSON.parse(JSON.stringify(this.data));
                this.countAnswers = this.data.length;
                this.data.forEach((answer) => {
                    if (answer.correct) {
                        this.countCorrect++;
                    }
                });
            }
        },

        methods: {
            addAnswer() {
                if (this.countAnswers < 10) {
                    let answer = {};
                    answer.body = '';
                    answer.correct = null;
                    this.answers.push(answer);
                    this.countAnswers++;
                }
            },

            removeAnswer(index) {
                this.answers.splice(index, 1);
                this.countAnswers--;
            },

            setCorrect(index) {
                this.answers[index].correct ? this.countCorrect-- : this.countCorrect++;
            },

            answersIsReady() {
                if (this.validate()) {
                    let type = this.countCorrect > 1 ? 'many_answers' : 'one_answer';
                    this.$emit('ready', this.answers, type);

                } else {
                    setTimeout(() => this.errors = [], 10000);
                }
            },

            validate() {
                this.errors = [];
                let isValid = true;
                if (this.countCorrect === 0) {
                    this.errors.push('There must be at least 1 correct answer!');
                    isValid = false;
                }
                if ((this.countAnswers === 0) || this.countAnswers === 1) {
                    this.errors.push('There must be at least 2 answers!');
                    isValid = false;
                }
                for (let answer of this.answers) {
                    if (answer.body === '') {
                        this.errors.push('There is an empty answer');
                        isValid = false;
                        break;
                    }
                }
                return isValid;
            },
        }
    }
</script>
