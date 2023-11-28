<template>
    <div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold mb-4">{{ course.title }}</h1>
        <p class="text-gray-700 mb-2">Instituição: {{ course.institution }}</p>
        <p class="text-gray-700 mb-2">Descrição: {{ course.description }}</p>
        <p class="text-gray-700 mb-2">Tecnologias: {{ course.technologies.join(', ') }}</p>
        <button @click="redirectToExternalLink" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">Acessar Curso</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            course: {} // Dados do curso selecionado
        };
    },
    methods: {
        redirectToExternalLink() {
            // Lógica para redirecionar para o link externo do curso
            window.location.href = 'URL_DO_CURSO';
        }
    },
    mounted() {
        // Lógica para carregar detalhes do curso com base no ID ou outro identificador
        // Aqui, você deve implementar a lógica para carregar os detalhes do curso com base no ID da rota.
    }
};
</script>

<style scoped>
/* Adicione estilos específicos para os detalhes do curso aqui */
</style>
