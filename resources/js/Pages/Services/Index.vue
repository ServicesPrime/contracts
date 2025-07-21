<template>
  <LayoutMain>
    <div class="p-6">
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Services</h1>
        <button 
          @click="addNewService" 
          class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition"
        >
          Add New Service
        </button>
      </div>

      <!-- Search Bar -->
      <form @submit.prevent="searchServices" class="mb-4">
        <input
          type="text"
          v-model="filters.search"
          placeholder="Search by service type or description"
          class="border border-gray-300 rounded px-3 py-2 mr-2"
        />
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
          Search
        </button>
      </form>

      <!-- Services Table -->
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded">
          <thead>
            <tr class="bg-gray-200 text-left">
              <th class="py-2 px-4">ID</th>
              <th class="py-2 px-4">Service Type</th>
              <th class="py-2 px-4">Specifications</th>
              <th class="py-2 px-4">Total Specs</th>
              <th class="py-2 px-4">Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- Empty State -->
            <tr v-if="!services || services.length === 0">
              <td colspan="5" class="py-8 px-4 text-center text-gray-500">
                No services found. 
                <button 
                  @click="addNewService"
                  class="text-green-600 hover:text-green-700 font-medium ml-1"
                >
                  Add your first service
                </button>
              </td>
            </tr>
            
            <!-- Service Rows -->
            <template v-for="service in services" :key="service.id">
              <!-- Normal Row View -->
              <tr v-if="editingService !== service.id" class="border-t hover:bg-gray-50">
                <td class="py-2 px-4">#{{ service.id }}</td>
                <td class="py-2 px-4">
                  <span class="font-medium">{{ service.type }}</span>
                </td>
                <td class="py-2 px-4">
                  <div v-if="service.specifications && service.specifications.length > 0">
                    <div class="flex flex-wrap gap-1">
                      <span 
                        v-for="spec in service.specifications.slice(0, 3)" 
                        :key="spec.id"
                        class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs"
                      >
                        {{ spec.description }}
                      </span>
                      <span 
                        v-if="service.specifications.length > 3"
                        class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs"
                      >
                        +{{ service.specifications.length - 3 }} more
                      </span>
                    </div>
                  </div>
                  <span v-else class="text-gray-400 italic text-sm">No specifications</span>
                </td>
                <td class="py-2 px-4">
                  <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-sm font-medium">
                    {{ service.specifications ? service.specifications.length : 0 }}
                  </span>
                </td>
                <td class="py-2 px-4">
                  <div class="flex space-x-2">
                    <button 
                      @click="toggleEdit(service.id)"
                      class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700 transition text-sm"
                    >
                      Edit
                    </button>
                    <button 
                      @click="deleteService(service.id)"
                      class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm"
                    >
                      Delete
                    </button>
                  </div>
                </td>
              </tr>

              <!-- Edit Row View -->
              <tr v-else class="border-t bg-blue-50">
                <td class="py-4 px-4">#{{ service.id }}</td>
                <td class="py-4 px-4">
                  <input
                    v-model="editForm.type"
                    type="text"
                    class="w-full border border-gray-300 rounded px-2 py-1 text-sm"
                    placeholder="Service type"
                  />
                </td>
                <td colspan="2" class="py-4 px-4">
                  <div class="space-y-2">
                    <div class="flex justify-between items-center mb-2">
                      <span class="text-sm font-medium text-gray-700">Specifications:</span>
                      <button
                        @click="addSpecification"
                        type="button"
                        class="bg-green-600 text-white px-2 py-1 rounded text-xs hover:bg-green-700"
                      >
                        + Add Spec
                      </button>
                    </div>
                    <div v-for="(spec, index) in editForm.specifications" :key="index" class="flex gap-2 items-center">
                      <input
                        v-model="spec.description"
                        type="text"
                        class="flex-1 border border-gray-300 rounded px-2 py-1 text-sm"
                        placeholder="Specification description"
                      />
                      <button
                        @click="removeSpecification(index)"
                        type="button"
                        class="bg-red-600 text-white px-2 py-1 rounded text-xs hover:bg-red-700"
                      >
                        Remove
                      </button>
                    </div>
                  </div>
                </td>
                <td class="py-4 px-4">
                  <div class="flex space-x-2">
                    <button 
                      @click="saveService(service.id)"
                      class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700 transition text-sm"
                    >
                      Save
                    </button>
                    <button 
                      @click="cancelEdit"
                      class="bg-gray-400 text-white px-3 py-1 rounded hover:bg-gray-500 transition text-sm"
                    >
                      Cancel
                    </button>
                  </div>
                </td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
    </div>
  </LayoutMain>
</template>

<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import LayoutMain from "@/Layouts/LayoutMain.vue";

const props = defineProps({
  services: Array,
  filters: Object
})

const filters = ref({
  search: props.filters?.search || '',
  type: props.filters?.type || ''
})

const editingService = ref(null)
const editForm = ref({
  type: '',
  service: '',
  specifications: []
})

const addNewService = () => {
  router.visit(route('services.create'))
}

const searchServices = () => {
  router.get(route('services.index'), {
    search: filters.value.search,
    type: filters.value.type
  })
}

const toggleEdit = (serviceId) => {
  // Encontrar el servicio a editar
  const service = props.services.find(s => s.id === serviceId)
  
  // Configurar el formulario de edición
  editForm.value = {
    type: service.type,
    service: service.service,
    specifications: service.specifications ? 
      service.specifications.map(spec => ({ 
        id: spec.id, 
        description: spec.description 
      })) : []
  }
  
  // Activar modo edición
  editingService.value = serviceId
}

const cancelEdit = () => {
  editingService.value = null
  editForm.value = {
    type: '',
    service: '',
    specifications: []
  }
}

const addSpecification = () => {
  editForm.value.specifications.push({
    id: null, // null significa que es nuevo
    description: ''
  })
}

const removeSpecification = (index) => {
  editForm.value.specifications.splice(index, 1)
}

const saveService = (serviceId) => {
  // Filtrar especificaciones vacías
  const validSpecifications = editForm.value.specifications.filter(spec => 
    spec.description && spec.description.trim() !== ''
  )

  const data = {
    type: editForm.value.type,
    service: editForm.value.service,
    specifications: validSpecifications
  }

  router.put(route('services.update', serviceId), data, {
    onSuccess: () => {
      cancelEdit()
    },
    onError: (errors) => {
      console.error('Error updating service:', errors)
    }
  })
}

const deleteService = (serviceId) => {
  if (confirm('Are you sure you want to delete this service? This action cannot be undone.')) {
    router.delete(route('services.destroy', serviceId))
  }
}
</script>