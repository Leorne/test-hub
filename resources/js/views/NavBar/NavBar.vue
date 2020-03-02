<template>
    <div>
        <b-navbar type="dark" variant="dark">
            <b-navbar-nav>
                <b-nav-item href="#"><router-link :to="{ name: 'list' }">List</router-link></b-nav-item>
                <b-nav-item href="#"><router-link :to="{ name: 'create-test' }">Create</router-link></b-nav-item>

            </b-navbar-nav>
        </b-navbar>
    </div>
</template>


<script>
    export default {

    }
</script>
