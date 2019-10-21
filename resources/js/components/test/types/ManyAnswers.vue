<template>
    <div>
        <div>
        </div>
        <div class="form-group p-2">
            <div class="form-group" v-for="key in answers">
                <label :for="key" class="">Answer №{{key}}</label>
                <div class="form-row">
                    <div class="col-8">
                        <input class="form-control" :id="key" type="text" v-model="key.body">
                    </div>
                    <div class="col-2">
                        <input name="correct" type="checkbox" v-model="key.correct">
                    </div>
                    <div class="col-2 text-right">
                        <span class="btn btn-danger" @click="removeAnswer(answers.indexOf(key))">
                            Delete
                        </span>
                    </div>
                </div>
            </div>
            <div class="btn btn-secondary" v-if="countAnswers < maxCountAnswers" @click="addAnswer">
                +
            </div>
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
                this.answers.splice(index,1);
                this.countAnswers--;
            },
        }
    }
</script>
