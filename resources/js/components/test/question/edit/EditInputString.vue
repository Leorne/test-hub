<template>
    <div>
        <div class="form-group p-2">
            <div id="answers" class="form-group" v-for="(answer, index) in answers">
                <label :for="answer" class="">Possible answer №{{index+1}}</label>
                <div class="form-row">
                    <div class="col-9">
                        <input class="form-control" :id="answer" type="text"
                               v-model="answer.body">
                    </div>
                    <div class="col-3 text-right">
                        <span class="btn btn-danger" @click="removeAnswer(index)">
                            X
                        </span>
                    </div>
                </div>
            </div>
            <div class="btn btn-outline-secondary" v-if="countAnswers < maxCountAnswers" @click="addAnswer">
                +
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-start m-2">
            <div class="btn btn-success" @click="answersIsReady">
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

        data() {
            return {
                answers: [],
                countAnswers: 0,
                maxCountAnswers: 10,
                errors: [],
            }
        },

        methods: {
            addAnswer() {
                if (this.countAnswers < 10) {
                    let answer = {};
                    answer.body = '';
                    // answer.correct = null;
                    this.answers.push(answer);
                    this.countAnswers++;
                }
            },

            removeAnswer(index) {
                this.answers.splice(index, 1);
                this.countAnswers--;
            },

            answersIsReady() {
                if (this.validate()) {
                    this.$emit('ready', this.answers, 'input_string');

                    this.answers = [];
                    this.countAnswers = 0;
                    this.maxCountAnswers = 10;
                    this.errors = [];

                } else {
                    setTimeout(() => this.errors = [], 10000);
                }
            },

            validate() {
                this.errors = [];
                let isValid = true;
                if (this.countAnswers === 0) {
                    this.errors.push('There must be at least 1 answer!');
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
