<template>
    <div>
        <div class="form-group">
            <input type="number" class="form-control" v-model="userAnswer">
        </div>
        <div class="small text-danger" v-if="!$v.userAnswer.required && $v.userAnswer.$error">
            Введите ответ
        </div>
        <div class="text-center">
            <button @click="nextQuestion" class="btn btn-primary">Next</button>
        </div>

    </div>
</template>

<script>
    import {required} from 'vuelidate/lib/validators'

    export default {
        props: ['data'],


        data() {
            return {
                userAnswer: undefined,
            }
        },

        validations: {
            userAnswer: {
                required,
            },
        },

        methods: {
            nextQuestion() {
                if (!this.$v.$invalid) {
                    this.$emit('next', {answer: this.userAnswer});
                }
                this.$v.userAnswer.$touch();
            }
        }
    }
</script>
