<style>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }

    .modal-container {
        width: 70%;
        height: 90%;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
        overflow-y: scroll;
    }
</style>
<!--START MOADL-->
<template>
    <div class="card">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">
                    <div class="p-2">
                        <div class="form-group">
                            <label for="question_types">Choose the question type</label>
                            <select class="form-control" id="question_types" v-model="currentTypeName">
                                <option v-for="(value, name) in typesComponent">{{ value }}</option>
                            </select>
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
                            <component :is="answerComponent"
                                       :data="answer_data"
                                       @ready="setAnswerData"
                                       @close="$emit('close')">
                            </component>
                            <div v-if="error" v-for="error in errors" class="small alert alert-danger">
                                {{ error }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import EditAnswers from './edit/EditOneOrMoreAnswers'
    import EditInputNumber from './edit/EditInputNumber'
    import EditInputString from './edit/EditInputString'

    export default {
        components: {EditAnswers, EditInputNumber, EditInputString},

        props: ['data'],

        data() {
            return {
                editing: false,
                types: ['One or more answers', 'Input number', 'Input string'],
                editTypesComponent: {
                    'one_answer': 'EditAnswers',
                    'many_answers': 'EditAnswers',
                    'input_number': 'EditInputNumber',
                    'input_string': 'EditInputString'
                },
                typesComponent: {
                    'EditAnswers': 'One or more answers',
                    'EditInputNumber': 'Input number',
                    'EditInputString': 'Input string'
                },
                currentTypeName: 'One or more answers',
                answerComponent: 'EditAnswers',

                errors: [],

                //question
                type: '',
                body: null,
                points: 1,

                maxPoints: 10,
                answer_data: null,
            }
        },

        created() {
            if (this.data) {
                this.body = this.data.question_body;
                this.points = this.data.question_points;
                this.type = this.data.question_type;
                this.answer_data = this.data.answer_data;
                this.editing = true;
                this.answerComponent = this.editTypesComponent[this.data.question_type];
                this.currentTypeName = this.typesComponent[this.answerComponent];
            }
        },

        watch: {
            currentTypeName() {
                let components = ['EditAnswers', 'EditInputNumber', 'EditInputString'];
                this.answerComponent = components[this.types.indexOf(this.currentTypeName)];
                if(this.editing){
                    if(this.editTypesComponent[this.data.question_type] === this.answerComponent){
                        this.answer_data = this.data.answer_data;
                    }else{
                        this.answer_data = null;
                    }
                }
            },
        },

        methods: {
            setAnswerData(data, type) {
                if (this.body) {
                    this.answer_data = data;
                    this.type = type;
                    this.sendData();
                } else {
                    this.errors = [];
                    this.errors.push('Question body is required field.');
                    setTimeout(() => this.errors = [], 10000);
                }
            },

            sendData() {
                let data = {
                    question_body: this.body,
                    question_type: this.type,
                    question_points: this.points,
                    answer_data: this.answer_data
                };
                this.editing ? this.$emit('edit', data) : this.$emit('create', data);


            },
        }
    }
</script>
