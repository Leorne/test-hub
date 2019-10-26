<template>
    <tags-input v-model="tags"
                element-id="tags"
                :existing-tags="existingTags"
                :typeahead="true"
                :limit="10"
                :add-tags-on-blur="false"
                :add-tags-on-comma="true">
    </tags-input>
</template>

<script>

    import TagsInput from '@voerro/vue-tagsinput'
    import styleTags from '@voerro/vue-tagsinput/dist/style.css'

    export default {
        components: {TagsInput},

        props: ['value'],

        mounted() {
            this.tags = this.value;
            axios.get('/catalog/tags.json')
                .then(this.setExistTags);
        },

        watch: {
            tags() {
                this.$emit('input', this.tags);
            },
            value() {
                this.tags = this.value;
            }
        },

        data() {
            return {
                tags: null,
                existingTags: null,
            }
        },

        methods: {
            setExistTags(response) {
                this.existingTags = response.data;
            }
        }

    }
</script>
