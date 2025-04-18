<script setup>
    import { ref, onMounted, watch, computed } from 'vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link, useForm, usePage, router } from '@inertiajs/vue3';
    import axios from 'axios';
    import { vMaska} from 'maska/vue'
    import { PlusCircle, FileText, Paperclip, Trash2, Edit, Save, X, Download } from 'lucide-vue-next';
    import Swal from 'sweetalert2';

    const user = computed(() => usePage().props.auth.user);
    const props = defineProps({
        cliente: Object
    });

    const usuario = ref([]);
    const anotacoes = ref([]);
    const arquivos = ref([]);
    const activeTab = ref('info');
    const editingNoteId = ref(null);
    const showAddNote = ref(false);
    const isUploading = ref(false);
    const isModalOpen = ref(false);
    
    const form = useForm({
        nome: '',
        email: '',
        telefone: '',
        descricao: '',
        user_id: user.value.id
    });

    const buscarUsuario = async (id) => {
        try {
            const response = await axios.get(`/api/usuarioPerfil/${id}`);
            usuario.value = response.data[0]
        } catch (error) {
            console.error("Erro ao buscar usuario: ", error)
        }
    }

    const editarUsuario = async () => {
        usuario.value.telefone = usuario.value.telefone.replace(/\D/g, '');
        try{
            const response = await axios.put(`api/usuarios/${usuario.value.id}`, {...usuario.value});
            await Swal.fire({
                title: 'Sucesso',
                text: 'Usuário atualizado',
                icon: 'success',
                confirmButtonText: 'Ok'
            })
        } catch(error) {
            alert('Erro ao atualizar')
            console.log('error', error)
        }
    }

    onMounted(() => {
        const idPerfil = sessionStorage.getItem('idPerfil');
        if(idPerfil) {
            buscarUsuario(idPerfil)
        } else {
            router.visit(route('dashboard'));
        }
    })
</script>

<template>
    <Head title="Perfil do Usuário" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2
                    class="text-xl font-semibold leading-tight text-gray-800"
                >
                    Perfil Usuário
                </h2>
                <Link :href="route('dashboard')" class="px-4 py-2 text-gray-700 transition bg-gray-200 rounded-md hover:bg-gray-300"> 
                    Voltar
                </Link>
            </div>
        </template>
        
        
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div v-if="usuario" class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex flex-col items-start justify-between md:flex-row md:items-center">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-800">{{ usuario.nome }}</h1>
                            </div>
                            <div class="mt-4 md:mt-0">
                                <p @click="editarUsuario()" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-800 focus:ring ring-blue-300 disabled:opacity-25">
                                    <!-- Função de editar dados do usuario -->
                                    <Edit class="w-4 h-4 mr-2" />
                                    Editar Usuario
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="border-b border-gray-200">
                        <nav class="flex -mb-px">
                            <button 
                                @click="activeTab = 'info'" 
                                :class="[
                                    'py-4 px-6 font-medium text-sm border-b-2 focus:outline-none',
                                    activeTab === 'info' 
                                        ? 'border-blue-500 text-blue-600' 
                                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                                ]"
                            >
                                Informações
                            </button>
                            <button 
                                @click="activeTab = 'anotacoes'" 
                                :class="[
                                    'py-4 px-6 font-medium text-sm border-b-2 focus:outline-none',
                                    activeTab === 'anotacoes' 
                                        ? 'border-blue-500 text-blue-600' 
                                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                                ]"
                            >
                                Anotações
                            </button>
                            <button 
                                @click="activeTab = 'arquivos'" 
                                :class="[
                                    'py-4 px-6 font-medium text-sm border-b-2 focus:outline-none',
                                    activeTab === 'arquivos' 
                                        ? 'border-blue-500 text-blue-600' 
                                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                                ]"
                            >
                                Arquivos
                            </button>
                        </nav>
                    </div>

                    <div class="p-6">
                        <div v-if="activeTab === 'info'" class="space-y-6">
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div class="space-y-4">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-500">Informações de Contato</h3>
                                        <div class="p-4 mt-2 rounded-md bg-gray-50">
                                            <div class="grid grid-cols-1 gap-3">
                                                <div>
                                                    <p class="text-xs text-gray-500">Email</p>
                                                    <input class="text-sm font-medium" v-model="usuario.email" type="text">
                                                </div>
                                                <div>
                                                    <p class="text-xs text-gray-500">Telefone</p>
                                                    <input v-model="usuario.telefone" class="text-sm font-medium" v-maska data-maska="(##) #####-####"/>
                                                </div>
                                                <div v-if="usuario.descricao">
                                                    <p class="text-xs text-gray-500">Descrição</p>
                                                    <input class="text-sm font-medium" v-model="usuario.descricao" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-500">Documentos</h3>
                                        <div class="p-4 mt-2 rounded-md bg-gray-50">
                                            <div class="grid grid-cols-1 gap-3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-if="activeTab === 'anotacoes'" class="space-y-6">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-medium text-gray-900">Anotações</h3>
                                <button 
                                    v-if="!showAddNote"
                                    @click="showAddNote = true" 
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                >
                                    <PlusCircle class="w-4 h-4 mr-2" />
                                    Nova Anotação
                                </button>
                            </div>

                            <!-- Formulário para adicionar anotação -->
                            <div v-if="showAddNote" class="p-4 rounded-md bg-gray-50">
                                <textarea 
                                    v-model="noteForm.conteudo" 
                                    rows="4" 
                                    class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Digite sua anotação aqui..."
                                ></textarea>
                                <div class="flex justify-end mt-3 space-x-2">
                                    <button 
                                        @click="showAddNote = false" 
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                    >
                                        <X class="w-4 h-4 mr-2" />
                                        Cancelar
                                    </button>
                                    <button 
                                        @click="adicionarAnotacao" 
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                        :disabled="!noteForm.conteudo"
                                    >
                                        <Save class="w-4 h-4 mr-2" />
                                        Salvar
                                    </button>
                                </div>
                            </div>

                            <!-- Lista de anotações -->
                            <div v-if="anotacoes.length > 0" class="space-y-4">
                                <div v-for="anotacao in anotacoes" :key="anotacao.id" class="p-4 bg-white border rounded-md shadow-sm">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-center text-sm text-gray-500">
                                            <FileText class="w-4 h-4 mr-2" />
                                            <span>{{ formatarData(anotacao.created_at) }}</span>
                                        </div>
                                        <div class="flex space-x-2">
                                            <button 
                                                @click="editarAnotacao(anotacao)" 
                                                class="text-gray-500 hover:text-blue-600"
                                                v-if="editingNoteId !== anotacao.id"
                                            >
                                                <Edit class="w-4 h-4" />
                                            </button>
                                            <button 
                                                @click="excluirAnotacao(anotacao.id)" 
                                                class="text-gray-500 hover:text-red-600"
                                                v-if="editingNoteId !== anotacao.id"
                                            >
                                                <Trash2 class="w-4 h-4" />
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Visualização da anotação -->
                                    <div v-if="editingNoteId !== anotacao.id" class="mt-2">
                                        <p class="text-gray-700 whitespace-pre-line">{{ anotacao.conteudo }}</p>
                                    </div>
                                    
                                    <!-- Edição da anotação -->
                                    <div v-else class="mt-2">
                                        <textarea 
                                            v-model="editNoteForm.conteudo" 
                                            rows="4" 
                                            class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        ></textarea>
                                        <div class="flex justify-end mt-3 space-x-2">
                                            <button 
                                                @click="cancelarEdicaoAnotacao" 
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                            >
                                                <X class="w-4 h-4 mr-2" />
                                                Cancelar
                                            </button>
                                            <button 
                                                @click="salvarEdicaoAnotacao" 
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                            >
                                                <Save class="w-4 h-4 mr-2" />
                                                Salvar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Mensagem quando não há anotações -->
                            <div v-else-if="!showAddNote" class="py-8 text-center">
                                <FileText class="w-12 h-12 mx-auto text-gray-400" />
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhuma anotação</h3>
                                <p class="mt-1 text-sm text-gray-500">Comece adicionando uma nova anotação para este usuario.</p>
                            </div>
                        </div>

                        <!-- Aba de Arquivos -->
                        <div v-if="activeTab === 'arquivos'" class="space-y-6">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-medium text-gray-900">Arquivos</h3>
                                <label class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-white bg-blue-600 border border-transparent rounded-md cursor-pointer hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <Paperclip class="w-4 h-4 mr-2" />
                                    Anexar Arquivo
                                    <input type="file" class="hidden" @change="uploadArquivo" />
                                </label>
                            </div>

                            <!-- Progresso de upload -->
                            <div v-if="isUploading" class="p-4 rounded-md bg-gray-50">
                                <div class="flex items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full" :style="{ width: uploadProgress + '%' }"></div>
                                    </div>
                                    <span class="ml-2 text-sm text-gray-500">{{ uploadProgress }}%</span>
                                </div>
                            </div>

                            <!-- Lista de arquivos -->
                            <div v-if="arquivos.length > 0" class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nome</th>
                                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tamanho</th>
                                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Data</th>
                                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="arquivo in arquivos" :key="arquivo.id">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <Paperclip class="flex-shrink-0 w-4 h-4 mr-2 text-gray-400" />
                                                    <div class="text-sm font-medium text-gray-900">{{ arquivo.nome }}</div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ formatarTamanho(arquivo.tamanho || 0) }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-500">{{ formatarData(arquivo.created_at) }}</div>
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                                <div class="flex space-x-2">
                                                    <a :href="arquivo.url" download class="text-blue-600 hover:text-blue-900">
                                                        <Download class="w-4 h-4" />
                                                    </a>
                                                    <button @click="excluirArquivo(arquivo.id)" class="text-red-600 hover:text-red-900">
                                                        <Trash2 class="w-4 h-4" />
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div v-else class="py-8 text-center">
                                <Paperclip class="w-12 h-12 mx-auto text-gray-400" />
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum arquivo</h3>
                                <p class="mt-1 text-sm text-gray-500">Comece anexando arquivos para este usuario.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-else class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="flex items-center justify-center h-64">
                        <div class="w-12 h-12 border-b-2 border-blue-500 rounded-full animate-spin"></div>
                    </div>
                </div>
            </div>
        </div>

            <p>{{ usuario }}</p>
    </AuthenticatedLayout>
</template>