<template>
    <div>
        <div>
        </div>
        <div class="form-group p-2">
            <div class="form-group">
                <label for="answer">Correct answer is:</label>
                <input id="answer" type="number" class="form-control" v-model="answer">
            </div>
            <div class="form-group">
                <label for="error_range">Error range:</label>
                <input id="error_range" type="number" class="form-control" v-model="error_range">
            </div>
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
                answer: null,
                error_range: null,
                errors: [],
            }
        },

        created() {
            if (this.data) {
                this.answer = this.data.answer;
                this.error_range = this.data.error_range;
            }
        },


        methods: {
            answersIsReady() {
                if (this.validate()) {
                    this.$emit('ready',
                        {answer: this.answer,
                         error_range: this.error_range},
                        'input_number');
                } else {
                    setTimeout(() => this.errors = [], 10000);
                }
            },

            validate() {
                this.errors = [];
                let isValid = true;
                if((this.answer == null) || (this.answer === '')){
                    this.errors.push('Answer field is void!');
                    isValid = false;
                }
                return isValid;
            },
        }
    }
</script>
