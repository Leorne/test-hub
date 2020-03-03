<template>
    <b-modal v-model="showModal"
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
                    <input v-model="points"
                           :max="maxPoints"
                           id="points"
                           type="range"
                           min="1"
                           class="custom-range">
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
    import ChooseAnswer from "./CreateTypes/ChooseAnswer";
    import InputNumber from "./CreateTypes/InputNumber";
    import InputString from "./CreateTypes/InputString";

    export default {
        components: {
            ChooseAnswer,
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
                currentTypeComponent: 'ChooseAnswer',
                errors: {},

                typesComponents: [
                    {
                        value: 'ChooseAnswer',
                        text: 'Выбор ответа'
                    },
                    {
                        value: 'InputString',
                        text: 'Ответ строкой',
                    },
                    {
                        value: 'InputNumber',
                        text: 'Ответ числом',
                    }
                ],

                body: '',
                points: 1,

                maxPoints: 10,
            }
        },

        computed: {
            showModal: {
                set(value) {
                    this.$emit('input', value);
                },
                get() {
                    return this.value;
                }
            },
            nextQuestionOptions() {
                let options = [];
                for (let key in this.questions) {
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
                    type: newQuestionAnswers.type,
                    answers: newQuestionAnswers.answers,
                };
                newQuestions.push(newQuestion);
                this.$emit('set-questions', newQuestions);
                this.closeModal();
            },

            closeModal() {
                this.body = '';
                this.points = 1;
                this.maxPoints = 10;
                this.answer_data = {};
                this.$emit('input', false)
            }
        }


    }
</script>
