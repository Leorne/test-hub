<template>
    <div>
        <NavBar/>
        <div class="container my-3">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    import NavBar from "./NavBar/NavBar";
    export default {
        components: {
            NavBar,
        },
    }
</script>
