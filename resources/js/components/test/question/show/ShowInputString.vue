<template>
    <div>
        <li class="list-group-item list-group-item-success mx-4" v-for="(answer,index) in answers">
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
        }
    }
</script>
