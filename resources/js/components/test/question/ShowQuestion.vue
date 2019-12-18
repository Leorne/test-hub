<template>
    <div>
        <div class="list-group m-3">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>{{ questionBody }}</span>
                <div>
                    <span class="badge badge-primary badge-pill">{{ questionPoints }}</span>
                    <span class="btn btn-primary btn-sm" @click="editing = true">Edit</span>
                    <span class="btn btn-danger btn-sm" @click="deleteQuestion">X</span>
                </div>
            </li>
            <component :is="this.typesComponent[this.questionType]" :data="answerData"></component>
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

        props: ['question', 'index'],

        data() {
            return {
                editing: false,
                typesComponent: {
                    'one_answer': 'ShowAnswers',
                    'many_answers': 'ShowAnswers',
                    'input_number': 'ShowInputNumber',
                    'input_string': 'ShowInputString'
                },

                questionBody: this.question.question_body,
                questionPoints: this.question.question_points,
                questionType: this.question.question_type,
                answerData: this.question.answer_data,
            }
        },


        watch: {
            question(changed){
                this.questionBody = changed.question_body;
                this.questionPoints = changed.question_points;
                this.questionType = changed.question_type;
                this.answerData = changed.answer_data;
            },
        },

        methods: {
            editQuestion(editedQuestion) {
                this.$emit('edit', editedQuestion, this.index);
                this.editing = false;
            },

            deleteQuestion(){
                this.$emit('delete', this.index);
            }
        }
    }
</script>
