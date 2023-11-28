<template>
    <div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold mb-4">Catálogo de Cursos</h1>
        <input v-model="searchQuery" @input="filterCourses" placeholder="Buscar por título ou tecnologia" class="w-full px-4 py-2 mb-4 border rounded-md">
        <div v-if="filteredCourses.length === 0" class="text-gray-600">
            <p>Nenhum curso encontrado.</p>
        </div>
        <div v-else>
            <div v-for="course in filteredCourses" :key="course.id" class="mb-4 p-4 border rounded-md">
                <router-link :to="{ name: 'course-details', params: { id: course.id } }" class="text-blue-600 hover:underline">
                    <h2 class="text-2xl font-bold mb-2">{{ course.title }}</h2>
                </router-link>
                <p class="text-gray-700">Instituição: {{ course.institution }}</p>
                <p class="text-gray-700">Descrição: {{ course.description }}</p>
                <p class="text-gray-700">Tecnologias: {{ course.technologies.join(', ') }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            courses: [
                // Adicione os links dos cursos aqui (título, instituição, descrição, tecnologias, etc.)
            ],
            filteredCourses: [],
            searchQuery: ''
        };
    },
    methods: {
        filterCourses(query) {
            // Lógica para filtrar cursos por título ou tecnologia
            // this.filteredCourses = this.courses.filter(course =>
            //     course.title.toLowerCase().includes(query.toLowerCase()) ||
            //     course.technologies.includes(query.toLowerCase())
            // );
            this.$emit('filter-courses', this.searchQuery);
        }
    },
    mounted() {
        // Inicialize a lista de cursos (pode ser carregada dinamicamente)
        this.filteredCourses = this.courses;
    },
    props: ['filteredCourses']
};
</script>

<style scoped>
/* Adicione estilos específicos para a listagem de cursos aqui */
</style>
