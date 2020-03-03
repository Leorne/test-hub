<template>
    <div>
        <component :is="componentType"
                   :question="question"/>
    </div>
</template>

<script>
    import ChooseAnswer from './ShowTypes/ChooseAnswer';
    import InputNumber from './ShowTypes/InputNumber';
    import InputString from './ShowTypes/InputString';

    export default {
        components: {
            ChooseAnswer,
            InputNumber,
            InputString,
        },

        props: {
            question: {
                type: Object,
                default: {},
            },
            index: {
                type: Number,
                default: 0,
            },
        },

        data() {
            return {
            }
        },

        computed: {
            componentType() {
                return this.question.type;
            },
        },

        methods: {}
    }
</script>
