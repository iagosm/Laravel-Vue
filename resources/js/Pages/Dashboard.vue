<script setup>
    import { ref, onMounted, watch, computed } from 'vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link, useForm, usePage, router } from '@inertiajs/vue3';
    import axios from 'axios';
    import { vMaska} from 'maska/vue'


    const usuarios = ref([]);
    const isModalOpen = ref(false);
    const user = computed(() => usePage().props.auth.user);
    const form = useForm({
        nome: '',
        email: '',
        telefone: '',
        descricao: '',
        user_id: user.value.id
    });


    // computed e usePage vai ser para pegar o id o usuario logado
    // use form para pegar o dado que colocamos no v-model
    // ref => referencia, sempre que alterar ele irá atualizar a variavel
    // onmonted => assim que iniciar / abrir a pagina ira chamar a função
    const buscarUsuarios = async () => {
        const resposta = await axios.post('/api/pegarUsuarios', {user_id: user.value.id});
        usuarios.value = resposta.data
        console.log('resposta', usuarios)
    }

    const addUsuario = async () => {
        form.telefone = form.telefone.replace(/\D/g, '');
        try{
            const response = await axios.post('api/usuarios', {...form});
            buscarUsuarios();
            closeModal();
        } catch(error) {
            console.log('error', error)
        }
    }
    
    const openModal = () => {
        isModalOpen.value = true;
    }

    const closeModal = () => {
        form.nome = '';
        form.email = '';
        form.telefone = '';
        form.descricao = '';
        isModalOpen.value = false;
    }

    const usuarioPerfil = (id) => {
        sessionStorage.setItem('idPerfil', id);
        router.visit(route('perfil'));
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
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-2xl font-bold">Bem Vindo!</h1>
                        <button @click="openModal" class="flex items-center justify-center w-10 h-10 text-white bg-red-500 rounded-full hover:bg-red-600 focus:outline-none">
                            +
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-md" :key="index" v-for="usuario in usuarios">
                            <div>
                                <p class="text-lg font-semibold">{{ usuario.nome }}</p>
                                <p class="text-sm text-gray-600">{{ usuario.email }}</p>
                                <p class="text-sm text-gray-600">{{ usuario.telefone }}</p>
                                <p class="text-sm text-gray-600">{{ usuario.descricao }}</p>
                            </div>
                            <div>
                                <button class="p-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <Link @click.prevent="usuarioPerfil(usuario.id)">
                                        Edit
                                    </Link>
                                </button>
                                <button class="p-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                                    Excluir
                                </button>
                            </div>
                        </div>
                    </div>
                       
                    </div>
                </div>
            </div>
            <div v-if="isModalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold">Adicionar Usuário</h2>
                        <button @click="closeModal" class="p-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                            X
                        </button>
                    </div>
                    <form @submit.prevent="addUsuario">
                        <div class="space-y-4">
                            <input type="text" placeholder="Nome" v-model="form.nome" required class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <input type="email" placeholder="Email" v-model="form.email" required class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <input type="tel" placeholder="Telefone" v-maska data-maska="(##) #####-####" v-model="form.telefone" required class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <input type="text" placeholder="Descrição" v-model="form.descricao" required class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="flex justify-end mt-6">
                            <button type="button" @click="closeModal" class="px-4 py-2 mr-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 focus:outline-none">Cancelar</button>
                            <button type="submit" class="px-4 py-2 mr-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
