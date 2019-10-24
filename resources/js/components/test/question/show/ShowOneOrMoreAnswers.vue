<template>
    <div>
        <li class="list-group-item mx-4" :class=" answer.correct ? 'list-group-item-success' : 'list-group-item-danger'" v-for="(answer,index) in answers">
        {{ answer.body }}
        </li>
    </div>
</template>

<script>
    export default {
        props: ['data'],

        data() {
            return {
                answers: [],
            }
        },

        created() {
            this.answers = this.data;
        },

        watch: {
            data(changed) {
                this.answers = changed;
            }
        }
    }
</script>
