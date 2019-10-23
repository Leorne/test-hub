<template>
    <div>
        <div class="list-group m-3">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ questionBody }}</span>
                <div>
                    <span class="badge badge-primary badge-pill">{{ questionPoints }}</span>
                    <span class="btn btn-primary btn-sm" @click="editing = true">Edit</span>
                    <span class="btn btn-danger btn-sm" @click="$emit('delete')">X</span>
                </div>
            </li>
            <component :is="this.typesComponent[this.questionType]" :showData="answerData"></component>
        </div>
        <edit-question v-if="editing"
                       :data="this.question"
                       @edit="editQuestion"
                       @close="editing = false"></edit-question>
    </div>
</template>

<script>

    import ShowAnswers from './show/ShowOneOrMoreAnswers'
    import ShowInputNumber from './show/ShowInputNumber'
    import ShowInputString from './show/ShowInputString'

    import EditQuestion from "./EditQuestion";

    export default {
        components: {ShowAnswers, ShowInputNumber, ShowInputString, EditQuestion},

        props: ['question'],

        data() {
            return {
                editing: false,
                typesComponent: {
                    'one_answer': 'ShowAnswers',
                    'many_answers': 'ShowAnswers',
                    'input_number': 'ShowInputNumber',
                    'input_string': 'ShowInputString'
                },

                questionType: '',
                questionPoints: null,
                questionBody: null,
                answerData: [],

            }
        },

        created() {
            this.questionBody = this.question.question_body;
            this.questionPoints = this.question.question_points;
            this.questionType = this.question.question_type;
            this.answerData = this.question.answer_data;
        },

        methods: {
            editQuestion(editedQuestion) {
                this.editing = false;
                this.$emit('edit', editedQuestion);
            },
        }
    }
</script>
