<script setup>
    import { ref, onMounted, watch } from 'vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import axios from 'axios';


    const usuarios = ref([]);

    // ref => referencia, sempre que alterar ele irá atualizar a variavel
    // onmonted => assim que iniciar / abrir a pagina ira chamar a função
    const buscarUsuarios = async () => {
        const resposta = await axios.get('/api/usuarios');
        usuarios.value = resposta.data
        console.log('resposta', usuarios)
    }

    onMounted(() => {
        buscarUsuarios();
    })
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg" >
                    <div class="p-6 text-gray-900">
                        Bem Vindo!
                        <div v-for="usuario in usuarios">
                            <p>{{ usuario.nome }} | {{ usuario.email }} | {{ usuario.telefone }}</p>
                            <br><hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
