<template>
    <div>
        <label for="tags-state-event">Enter tags</label>
        <b-form-tags
            input-id="tags-state-event"
            v-model="tags"
            :tag-validator="validator"
            placeholder="Enter tags (3-15 characters) separated by space"
            separator=" "
            @tag-state="onTagState"/>
        <small class="form-text text-muted">Test must include at least one tag.</small>
    </div>
</template>

<script>
    export default {
        props: {
            value: Array,
        },

        computed: {
            tags: {
                get() {
                    return this.value;
                },
                set(newTags) {
                    this.$emit('input', newTags);
                }
            }
        },

        data() {
            return {
                validTags: [],
                invalidTags: [],
                duplicateTags: []
            }
        },
        methods: {
            onTagState(valid, invalid, duplicate) {
                this.validTags = valid;
                this.invalidTags = invalid;
                this.duplicateTags = duplicate;
            },
            validator(tag) {
                return tag.length > 2 && tag.length < 16
            }
        }
    }
</script>
