<template>
    <div class="main-app">
        <Navbar/>
        <router-view></router-view>
        <Footer/>
    </div>
</template>

<script>
import Navbar from "../components/layout/Navbar";
import Footer from "../components/layout/Footer";

    export default {
        components: {Navbar, Footer},
        mounted() {
            console.log("Component app mounted ...")
        }
    }
</script>
