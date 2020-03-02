<template>
    <div>
        <div class="form-group">
            <div v-for="(answer, index) in answers">
                <div class="custom-control custom-checkbox">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" :id="index" v-model="userAnswer[index]">
                        <label class="custom-control-label" :for="index">{{ answer.body }}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button @click="$emit('next')" class="btn btn-primary">Next</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['data'],

        computed: {
          answers: {
              get(){
                  return this.data
              },
          }
        },

        data() {
            return {
                userAnswer: [],
            }
        },

        methods: {
            nextQuestion(){
                this.$emit('next', {answer: this.userAnswer});
            }
        }
    }
</script>
