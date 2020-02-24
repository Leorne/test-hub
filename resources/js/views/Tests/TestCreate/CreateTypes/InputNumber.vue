<template>
    <div>
        <div class="form-group p-2">
            <div class="form-group">
                <label for="answer">Correct answer is:</label>
                <input id="answer" type="number" class="form-control" v-model="answer">
            </div>
            <div class="form-group">
                <label for="error_range">Error range:</label>
                <input id="error_range" type="number" class="form-control" v-model="error_range">
            </div>
            <div class="form-group">
                <label for="next_question">Next question:</label>
                <b-form-select id="question_types" v-model="next_question" :options="questions">
                    <template v-slot:first>
                        <option :value="null">By list</option>
                    </template>
                </b-form-select>
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
        props: {
            questions: {
                type: Array,
                default: [],
            }
        },

        data() {
            return {
                answer: null,
                error_range: null,
                next_question: null,
                errors: [],
            }
        },

        methods: {
            answersIsReady() {
                if (this.validate()) {
                    let data = {
                        answer: this.answer,
                        error_range: this.error_range,
                        next_question: this.next_question,
                        type: 'InputNumber',
                    };
                    this.$emit('set-answer', data);
                } else {
                    setTimeout(() => this.errors = [], 10000);
                }
            },

            validate() {
                this.errors = [];
                let isValid = true;
                if ((this.answer == null) || (this.answer === '')) {
                    this.errors.push('Answer field is void!');
                    isValid = false;
                }
                return isValid;
            },
        }
    }
</script>
