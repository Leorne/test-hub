<template>
    <div>
        <li class="list-group-item mx-4">
            {{ answer }}
        </li>
    </div>
</template>

<script>
    export default {
        props: ['data'],

        data() {
            return {
                answer: null,
                error_range: null,
            }
        },

        created() {
            this.answer = this.data.answer;
            this.error_range = this.data.error_range;
        },
    }
</script>
