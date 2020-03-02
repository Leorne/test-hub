<template>
    <div>
        <div class="form-group p-2">
            <div class="form-group">
                <label for="answers">Допустимые ответы</label>
                <div id="answers" v-for="(answer, index) in answers" class="form-group border p-2 my-1">
                    <div class="my-1 d-flex form-group">
                        <input type="text" class="form-control" :class="answer.correct ? 'is-valid' : ''" v-model="answer.answer">
<!--                        <input type="checkbox" class="form-check-input" v-model="answer.correct">-->
                        <div class="">
                            <input :id="index + '-answer'" type="checkbox" v-model="answer.correct">
                            <label class="small" :for="index + '-answer'">Is correct?</label>
                        </div>
                        <span @click="deleteAnswerVariant" class="m-1 btn btn-sm btn-danger">
                            &times;
                        </span>
                    </div>
                    <div class="my-1">
                        <label for="next_question">Следующий вопрос:</label>
                        <b-form-select v-model="answer.next_question" :options="questions">
                            <template v-slot:first>
                                <option id="next_question" :value="null">По списку</option>
                            </template>
                        </b-form-select>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-start m-2">
            <div @click="addNewAnswerVariant" class="btn btn-secondary btn small mx-auto">&plus;</div>
            <div class="btn btn-success" @click="answersIsReady">
                Добавить вопрос
            </div>
            <div class="btn btn-danger" @click="$emit('close')">
                Закрыть
            </div>
        </div>
        <div v-if="error" v-for="error in errors" class="small alert alert-danger">
            {{ error }}
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            questions: {
                type: Array,
                default: [],
            }
        },

        data() {
            return {
                answers: [],
                next_question: null,
                errors: [],
            }
        },

        methods: {
            addNewAnswerVariant() {
                let newAnswer = {
                    answer: '',
                    next_question: null,
                    correct: false,
                };
                this.answers.push(newAnswer);
            },

            deleteAnswerVariant(index) {
                this.answers.splice(index, 1);
            },

            answersIsReady() {
                if (this.validate()) {
                    this.$emit('set-answer', {answers: this.answers, type: 'ChooseAnswers'});
                } else {
                    setTimeout(() => this.errors = [], 10000);
                }
            },

            validate() {
                this.errors = [];
                let isValid = true;
                if(this.answers.length < 1){
                    this.errors.push('Answer field is void!');
                    isValid = false;
                }
                for(let answer of this.answers){
                    if ((answer.answer == null) || (answer.answer === '')) {
                        this.errors.push('Answer field is void!');
                        isValid = false;
                    }
                }

                return isValid;
            },
        }
    }
</script>
