<template>
    <div class="card">
        <div class="card-header">
<!--            <button class="btn btn-primary">Create</button>-->
            <router-link class="btn btn-primary" :to="{ name: 'create-test' }">Create</router-link>
        </div>
        <div class="card-body">
            Test list page
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                tests: {},
            }
        },

        beforeMount() {
            axios.get('/api/tests').then(response => {
                this.tests = response.data;
            });
        }
    }
</script>
