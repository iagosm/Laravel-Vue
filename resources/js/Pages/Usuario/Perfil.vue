<script setup>
    import { ref, onMounted, watch, computed } from 'vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link, useForm, usePage, router } from '@inertiajs/vue3';
    import axios from 'axios';
    import { vMaska} from 'maska/vue'


    const usuario = ref([]);
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
    const buscarUsuario = async () => {
      let idPerfil = sessionStorage.getItem('idPerfil');
      console.log(idPerfil)
      if(idPerfil) {
        await axios.get(`/api/usuarioPerfil/${idPerfil}`).then(response => {
          usuario.value = response.data[0];
          console.log('usuario', usuario.value);
        });
        
      }
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

    onMounted(() => {
        buscarUsuario();
    })
</script>

<template>
    <Head title="Perfil" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Perfil Usuário
            </h2>
            <p>{{ usuario }}</p>
        </template>
    </AuthenticatedLayout>
</template>