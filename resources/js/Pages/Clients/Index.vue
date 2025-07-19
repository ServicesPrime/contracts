<template>
  <LayoutMain>
    <div class="min-h-screen bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8 overflow-hidden">
          <div class="bg-gradient-to-r from-[rgb(3,20,58)] to-blue-800 px-6 py-4">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
              <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <div>
                  <h1 class="text-2xl font-bold text-white">Clients Management</h1>
                  <p class="text-blue-100 text-sm mt-1">Manage your client database</p>
                </div>
              </div>
              
              <!-- Add New Client Button -->
              <button 
                @click="addNewClient" 
                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add New Client
              </button>
            </div>
          </div>
          
          <!-- Search Section -->
          <div class="px-6 py-4 bg-gray-50 border-t">
            <form @submit.prevent="searchClients" class="flex flex-col sm:flex-row gap-3">
              <div class="flex-1">
                <label for="search" class="sr-only">Search clients</label>
                <div class="relative">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                  </div>
                  <input
                    id="search"
                    type="text"
                    v-model="filters.search"
                    placeholder="Search by name, email, phone, or area..."
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm bg-white"
                  />
                </div>
              </div>
              <button 
                type="submit" 
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
              >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Search
              </button>
            </form>
          </div>
        </div>
        
        <!-- Clients Table Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
          <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <div class="flex items-center justify-between">
              <div class="flex items-center space-x-2">
                <h2 class="text-lg font-semibold text-gray-900">Client Directory</h2>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                  {{ clients?.total || 0 }} total
                </span>
              </div>
              <div class="flex items-center space-x-2 text-sm text-gray-500">
                <span>Page {{ clients?.current_page || 1 }} of {{ clients?.last_page || 1 }}</span>
              </div>
            </div>
          </div>
          
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Client Information
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Contact
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Area
                  </th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Address
                  </th>
                  <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <!-- Empty State -->
                <tr v-if="!clients || !clients.data || clients.data.length === 0">
                  <td colspan="5" class="px-6 py-12 text-center">
                    <div class="flex flex-col items-center">
                      <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                      </svg>
                      <h3 class="mt-2 text-sm font-medium text-gray-900">No clients found</h3>
                      <p class="mt-1 text-sm text-gray-500">Get started by adding your first client.</p>
                      <div class="mt-6">
                        <button 
                          @click="addNewClient"
                          class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow-sm transition-colors duration-200"
                        >
                          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                          </svg>
                          Add New Client
                        </button>
                      </div>
                    </div>
                  </td>
                </tr>
                
                <!-- Client Rows -->
                <tr 
                  v-for="client in clients.data" 
                  :key="client.id" 
                  class="hover:bg-gray-50 transition-colors duration-150"
                >
                  <!-- Client Information -->
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-10 w-10">
                        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center">
                          <span class="text-sm font-medium text-white">
                            {{ client.name?.charAt(0)?.toUpperCase() || '?' }}
                          </span>
                        </div>
                      </div>
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                          {{ client.name }}
                        </div>
                        <div class="text-sm text-gray-500">
                          ID: #{{ client.id }}
                        </div>
                      </div>
                    </div>
                  </td>
                  
                  <!-- Contact Information -->
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ client.email }}</div>
                    <div class="text-sm text-gray-500">{{ client.phone }}</div>
                  </td>
                  
                  <!-- Area -->
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                      {{ client.area }}
                    </span>
                  </td>
                  
                  <!-- Address -->
                  <td class="px-6 py-4">
                    <div class="text-sm text-gray-900">
                      <div v-if="client.address && (client.address.street || client.address.city)">
                        <div v-if="client.address.street" class="font-medium">{{ client.address.street }}</div>
                        <div v-if="client.address.city || client.address.state || client.address.zip_code" class="text-gray-500">
                          {{ [client.address.city, client.address.state, client.address.zip_code].filter(Boolean).join(', ') }}
                        </div>
                      </div>
                      <div v-else class="text-gray-400 italic text-xs">
                        No address provided
                      </div>
                    </div>
                  </td>
                  
                  <!-- Actions -->
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end space-x-2">
                      <button 
                        @click="viewClient(client.id)"
                        class="inline-flex items-center p-2 text-gray-400 hover:text-blue-600 transition-colors duration-150"
                        title="View Client"
                      >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                      </button>
                      <button 
                        @click="editClient(client.id)"
                        class="inline-flex items-center p-2 text-gray-400 hover:text-blue-600 transition-colors duration-150"
                        title="Edit Client"
                      >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                      </button>
                      <button 
                        @click="deleteClient(client.id)"
                        class="inline-flex items-center p-2 text-gray-400 hover:text-red-600 transition-colors duration-150"
                        title="Delete Client"
                      >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          
          <!-- Pagination (if needed) -->
          <div v-if="clients && clients.last_page > 1" class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            <div class="flex items-center justify-between">
              <div class="text-sm text-gray-700">
                Showing {{ clients.from }} to {{ clients.to }} of {{ clients.total }} results
              </div>
              <div class="flex space-x-2">
                <button 
                  v-if="clients.prev_page_url"
                  @click="router.get(clients.prev_page_url)"
                  class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50"
                >
                  Previous
                </button>
                <button 
                  v-if="clients.next_page_url"
                  @click="router.get(clients.next_page_url)"
                  class="px-3 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50"
                >
                  Next
                </button>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </LayoutMain> 
</template>  

<script setup> 
import { ref } from 'vue' 
import { router } from '@inertiajs/vue3'  
import LayoutMain from "@/Layouts/LayoutMain.vue";

// Props corregidos - debe ser clients (plural) no client (singular)
const props = defineProps({   
  clients: Object,  // Esto viene de la paginación de Laravel
  filters: Object 
})  

const filters = ref({   
  search: props.filters?.search || '' 
})      

// Función para redirigir a la página de crear cliente
const addNewClient = () => {
  router.visit(route('client.create'))
}

// Función para buscar clientes (nombre corregido)
const searchClients = () => {
  router.get(route('client.index'), { search: filters.value.search })
}

// Función para ver cliente
const viewClient = (clientId) => {
  router.visit(route('client.show', clientId))
}

// Función para editar cliente
const editClient = (clientId) => {
  router.visit(route('client.edit', clientId))
}

// Función para eliminar cliente
const deleteClient = (clientId) => {
  if (confirm('Are you sure you want to delete this client? This action cannot be undone.')) {
    router.delete(route('client.destroy', clientId))
  }
}
</script>