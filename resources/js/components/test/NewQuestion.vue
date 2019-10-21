<style>
</style>

<template>
    <div>
        <div class="card text-center" v-if="!creating" @click="creating = !creating">
            <span class="btn btn-secondary">New question.</span>
        </div>
        <div class="card" v-show="creating">
            <div>

            </div>
            <div>
                <div class="p-2">
                    <div class="form-group">
                        <label for="question_types">Choose the question type</label>
                        <select class="form-control" id="question_types" v-model="currentType">
                            <option v-for="type in types">{{ type }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="question_body">Question body</label>
                        <textarea name="question_body" class="form-control" id="question_body" rows="5"
                                  placeholder="Input text here..." required>
                        </textarea>
                    </div>
                    <div>
                        <one-answer v-if="currentType === 'One answer'"></one-answer>
                        <many-answers v-else-if="currentType === 'Many answers'"></many-answers>
                        <input-number v-else-if="currentType === 'Input number'"></input-number>
                        <input-string v-else></input-string>
                    </div>
                </div>
                <div class="btn btn-success">
                    Add question
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import OneAnswer from './types/OneAnswer'
    import ManyAnswers from './types/ManyAnswers'
    import InputNumber from './types/InputNumber'
    import InputString from './types/InputString'

    export default {
        components: { OneAnswer, ManyAnswers, InputNumber, InputString },

        data() {
            return {
                creating: false,
                typesss: ['one_answer', 'many_answers', 'input_number', 'input string'],
                types: ['One answer', 'Many answers', 'Input number', 'Input string'],
                currentType: 'One answer',
            }
        },
    }
</script>
