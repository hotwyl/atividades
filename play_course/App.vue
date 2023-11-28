<template>
    <div>
        <Header/>
        <router-view @filter-courses="filterCourses"></router-view>
        <Footer/>
    </div>
</template>

<script>
import Header from './components/Header.vue';
import Footer from './components/Footer.vue';

export default {
    components: {
        Header,
        Footer
    },
    methods: {
        filterCourses(query) {
            this.$router.push({ path: '/', query: { search: query } });
        }
    }
};
</script>

<style>
/* Estilos globais aqui, se necessário */
</style>