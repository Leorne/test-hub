<template>
    <div>
        <div v-if="!testStarted">
            <div class="card my-2">
                <div class="card-header">
                    {{ test.title }}
                </div>
                <div class="card-body">
                    {{ test.about }}
                </div>
                <div class="card-footer text-muted">
                    Таймер: {{ !!test.timer ? test.timer + ' min' : 'отсутствует' }}
                </div>
            </div>
            <div class=" my-2 card">
                <div class="card-body text-center">
                    <button class="btn btn-primary mx-auto" @click="startTestPass">Начать прохождение теста</button>
                </div>
            </div>
        </div>
        <div v-if="testCompleted">
            <button class="btn btn-primary" @click="endTestPass">result</button>
        </div>
        <div class="card my-3" v-if="isCurrentQuestion(index)" v-for="(question, index) in test.version.questions">
            <TestQuestion @next="nextQuestion(index, $event)" :questionAnswers="userAnswers[index]"
                          :question="question"
                          :testHistoryId="testHistoryId"></TestQuestion>
        </div>
    </div>
</template>

<script>
    import TestQuestion from "./PassTest/TestQuestion";

    export default {
        components: {
            TestQuestion
        },

        props: ['test_id'],

        data() {
            return {
                test: {
                    version: {},
                },
                testHistoryId: null,
                userAnswers: [],
                currentQuestion: null,
                testStarted: false,
                testCompleted: false,
            }
        },

        beforeMount() {
            axios.get('/api/test/' + this.test_id).then(response => {
                this.test = response.data;
            });
        },

        watch: {
            currentQuestion() {
                if (this.currentQuestion === this.test.version.questions.length) {
                    this.testCompleted = true;
                }
            }
        },

        methods: {
            startTestPass() {
                axios.post('/api/test/start/' + this.test_id + '/' + this.test.version.id)
                    .then(response => {
                        this.testHistoryId = response.data;
                        this.currentQuestion = 0;
                        this.testStarted = true;
                    });
            },
            endTestPass() {
                axios.post('/api/test/end/' + this.test_id + '/' + this.test.version.id)
                    .then(response => {

                    });
            },
            isCurrentQuestion(index) {
                return this.currentQuestion === index
            },
            nextQuestion(index, userAnswer) {
                this.userAnswers.push(userAnswer);
                if (index !== this.test.version.questions.length) {
                    this.currentQuestion = index + 1;
                }
            }
        },
    }
</script>
