<template>
    <footer class="bg-gray-800 text-white p-4">
        <div class="container mx-auto text-center">
            <!-- Adicione conteúdo ou links do rodapé conforme necessário -->
            <p class="mb-2">&copy; {{ currentYear }} Catálogo de Cursos. Todos os direitos reservados.</p>
            <p>Desenvolvido por [Seu Nome]</p>
        </div>
    </footer>
</template>

<script>
export default {
    data() {
        return {
            currentYear: new Date().getFullYear()
        };
    }
    // ... (mantenha o resto igual)
};
</script>

<style scoped>
/* Estilos específicos para o rodapé aqui */
</style>