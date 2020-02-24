<template>
    <b-modal v-model="value"
             size="xl"
             id="bv-modal-example">
        <div class="d-block text-center">
            <div class="p-2">
                <div class="form-group">
                    <label for="question_types">Choose the question type</label>
                    <b-form-select id="question_types" v-model="currentTypeComponent" :options="typesComponents"/>
                </div>
                <div class="form-group">
                    <label for="question_body">Question body</label>
                    <textarea name="question_body" class="form-control" id="question_body" rows="5"
                              placeholder="Input text here..." v-model="body">
                                </textarea>
                </div>
                <div class="form-group">
                    <label for="points">Points for this question: {{ points }}/{{ maxPoints }}</label>
                    <input id="points" type="range" :max="maxPoints" min="1" value="1" class="custom-range"
                           v-model="points">
                </div>
                <div>
                    <component :is="currentTypeComponent"
                               :questions="nextQuestionOptions"
                               @set-answer="setAnswerData"
                               @close="closeModal">
                    </component>
                    <div v-if="error" v-for="error in errors" class="small alert alert-danger">
                        {{ error }}
                    </div>
                </div>
            </div>
        </div>
        <template v-slot:modal-footer>
            Disable
        </template>
    </b-modal>
</template>

<script>
    import ChooseAnswers from "./Types/ChooseAnswers";
    import InputNumber from "./Types/InputNumber";
    import InputString from "./Types/InputString";

    export default {
        components: {
            ChooseAnswers,
            InputNumber,
            InputString
        },

        props: {
            value: {
                type: Boolean,
                default: false,
            },
            questions: {
                type: Array,
                default: [],
            }
        },

        data() {
            return {
                currentTypeComponent: 'ChooseAnswers',
                errors: {},

                typesComponents: [
                    {
                        value: 'ChooseAnswers',
                        text: 'Choose answer'
                    },
                    {
                        value: 'InputString',
                        text: 'Input string',
                    },
                    {
                        value: 'InputNumber',
                        text: 'Input number',
                    }
                ],

                body: '',
                points: 0,

                maxPoints: 10,
            }
        },

        computed: {
            nextQuestionOptions() {
                let options = [];
                for(let key in this.questions){
                    options.push({
                        value: key,
                        text: this.questions[key].body
                    })
                }
                return options;
            },
        },

        methods: {
            setAnswerData(newQuestionAnswers) {
                let newQuestions = this.questions;
                let newQuestion = {
                    body: this.body,
                    points: this.points,
                    answers: newQuestionAnswers,
                };
                newQuestions.push(newQuestion);
                this.$emit('set-questions', newQuestions);
                this.closeModal();
            },

            closeModal() {
                this.body = '';
                this.points = 0;
                this.maxPoints = 10;
                this.answer_data = {};
                this.$emit('input', false)
            }
        }


    }
</script>
