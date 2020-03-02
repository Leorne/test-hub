<template>
    <div class="card">
        <div class="card-body">
            <div class="card-text d-flex">
                <span class="col">
                    {{ question.body }}
                </span>
                <span class="col-1">
                    <b-badge pill variant="info">{{ question.points }}</b-badge>
                </span>
            </div>
        </div>
        <b-list-group flush>
            <b-list-group-item variant="success" class="d-flex">
                <span class="col">
                    {{ question.answers.answer }}
                </span>
                <span class=" border-left col-1">
                    &plusmn; {{ question.answers.error_range }}
                </span>
            </b-list-group-item>
        </b-list-group>
    </div>
</template>

<script>
    export default {
        props: {
            question: {
                type: Object,
                required: true,
            }
        },

        data() {
            return {
            }
        },
    }
</script>
