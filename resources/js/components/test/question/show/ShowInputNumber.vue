<template>
    <div>
        <li class="list-group-item mx-4  d-flex justify-content-between align-items-center">
            <span>
                {{ answer }}
            </span>
            <span>
                &#177 {{ error_range }}
            </span>
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
