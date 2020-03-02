<template>
    <div>
        <div class="card">
            <div class="card-header">
                <div class="col-11">
                    {{ question.question_body }}
                </div>
                <div class="col-1">
                    <span class="badge badge-primary">{{ question.question_points + ' points' }}</span>
                </div>
            </div>
            <div class="card-body">
                <div>
                </div>
                <component :is="questionComponent"
                           :data="question.answers.answer_data"
                           @next="nextQuestion">
                </component>
            </div>
        </div>

    </div>
</template>

<script>
    import OneOrMoreAnswers from "./types/OneOrMoreAnswers";
    import InputNumber from "./types/InputNumber";
    import InputString from "./types/InputString";

    export default {
        components: {
            OneOrMoreAnswers,
            InputString,
            InputNumber
        },

        props: ['question', 'questionAnswers', 'testHistoryId'],

        data() {
            return {
                questionTypeComponents: {
                    'one_answer': 'OneOrMoreAnswers',
                    'many_answers': 'OneOrMoreAnswers',
                    'input_number': 'InputNumber',
                    'input_string': 'InputString'
                },
            }
        },

        computed: {
            questionComponent() {
                return this.questionTypeComponents[this.question.question_type]
            }
        },

        methods: {
            nextQuestion(userAnswer){
                let data = {
                    test_history_id: this.testHistoryId,
                    question_id: this.question.id,
                    answer: userAnswer,
                };
                console.log(userAnswer);
                axios.post('/api/test/question/pass', data).then(response => {
                    if(response.status === 201){
                        this.$emit('next', userAnswer);
                    }
                });
            }
        }
    }
</script>
