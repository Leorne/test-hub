<template>
    <div>
        component
    </div>
</template>

<script>
    import ChooseAnswers from './ShowTypes/ChooseAnswers';
    import InputNumber from './ShowTypes/InputNumber';
    import InputString from './ShowTypes/InputString';

    export default {
        components: {
            ChooseAnswers,
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
            return {}
        },

        computed: {},

        methods: {}
    }
</script>
