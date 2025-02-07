<script>
  import { Link } from '@inertiajs/vue3';
  export default {
    components: {
      Link
    }
  }
</script>
<template>
  <div class="min-h-screen bg-gradient-to-b from-gray-900 to-gray-800">
    <nav class="border-b border-gray-700 bg-gray-900/50 backdrop-blur-sm">
      <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
          <div class="flex items-center">
            <div class="text-2xl font-bold text-white">
              UserFlow<span class="text-indigo-500"></span>
            </div>
          </div>
          <div class="flex items-center space-x-4">
            <Link :href="route('login')">
              <button class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:text-white">Login</button>
            </Link>
            <Link :href="route('register')">
              <button class="px-4 py-2 text-sm font-medium text-white transition-all bg-indigo-600 rounded-md hover:bg-indigo-700">Começar Agora</button>
            </Link>
          </div>
        </div>
      </div>
    </nav>

    <div class="px-4 pt-20 pb-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="text-center">
        <h1 class="mb-6 text-4xl font-bold text-white sm:text-6xl">
          Gerencie seus usuários com <span class="text-indigo-500">simplicidade</span>
        </h1>
        <p class="max-w-2xl mx-auto mb-8 text-xl text-gray-400">
          Uma plataforma morderna e intuitiva para gerenciar seus usuários, permissões e acessos em um único lugar.
        </p>
      </div>
    </div>

    <div class="px-4 py-20 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div class="p-6 transition-all border border-gray-700 bg-gray-800/50 backdrop-blur-sm rounded-xl hover:border-indigo-500">
                    <div class="flex items-center justify-center w-12 h-12 mb-4 bg-indigo-600 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-semibold text-white">Gestão Simplificada</h3>
                    <p class="text-gray-400">Interface intuitiva para adicionar, remover e gerenciar usuários com poucos cliques.</p>
                </div>

                <div class="p-6 transition-all border border-gray-700 bg-gray-800/50 backdrop-blur-sm rounded-xl hover:border-indigo-500">
                <div class="flex items-center justify-center w-12 h-12 mb-4 bg-indigo-600 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="mb-2 text-xl font-semibold text-white">Controle de Acesso</h3>
                <p class="text-gray-400">Sistema avançado de permissões e papéis para garantir a segurança dos seus dados.</p>
                </div>

                <div class="p-6 transition-all border border-gray-700 bg-gray-800/50 backdrop-blur-sm rounded-xl hover:border-indigo-500">
                <div class="flex items-center justify-center w-12 h-12 mb-4 bg-indigo-600 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="mb-2 text-xl font-semibold text-white">Análises Detalhadas</h3>
                <p class="text-gray-400">Dashboards e relatórios completos sobre o uso e atividade dos usuários.</p>
                </div>
        </div>
    </div>

    <div class="border-gray-700 bg-gray-800/30 backdrop-blur-sm border-y">
        <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 text-center md:grid-cols-3">
            <div>
                <div class="mb-2 text-4xl font-bold text-white">+10k</div>
                <div class="text-gray-400">Usuários Gerenciados</div>
            </div>
            <div>
                <div class="mb-2 text-4xl font-bold text-white">99.9%</div>
                <div class="text-gray-400">Uptime Garantido</div>
            </div>
            <div>
                <div class="mb-2 text-4xl font-bold text-white">24/7</div>
                <div class="text-gray-400">Suporte Dedicado</div>
            </div>
            </div>
        </div>
    </div>

    <div class="px-4 py-20 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-8 text-center bg-indigo-600 rounded-2xl md:p-12">
            <h2 class="mb-4 text-3xl font-bold text-white md:text-4xl">
            Pronto para começar?
            </h2>
            <p class="max-w-2xl mx-auto mb-8 text-lg text-indigo-200">
            Junte-se a milhares de empresas que já confiam em nossa plataforma para gerenciar seus usuários.
            </p>
            <Link :href="route('register')">
                <button class="px-8 py-4 text-lg font-semibold text-indigo-600 transition-all transform bg-white rounded-lg hover:bg-indigo-50 hover:scale-105">
                Criar Conta Gratuita
                </button>
            </Link>
        </div>
    </div>

    <footer class="bg-gray-900">
        <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
                <div>
                    <div class="mb-4 text-2xl font-bold text-white">
                    UserFlow<span class="text-indigo-500">.</span>
                    </div>
                    <p class="text-gray-400">
                    Simplificando a gestão de usuários para empresas modernas.
                    </p>
                </div>

                <div>
                    <h4 class="mb-4 text-lg font-semibold text-white">Produto</h4>
                    <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white">Funcionalidades</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Preços</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Cases</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-4 text-lg font-semibold text-white">Empresa</h4>
                    <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white">Sobre</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Blog</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Carreiras</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="mb-4 text-lg font-semibold text-white">Suporte</h4>
                    <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white">Documentação</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Status</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white">Contato</a></li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 mt-12 text-center text-gray-400 border-t border-gray-800">
                © 2025 UserFlow. Todos os direitos reservados.
            </div>
        </div>
    </footer>
  </div>
</template>
<style scoped></style>