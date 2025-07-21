<template>
  <LayoutMain>
    <div class="p-6">
      <div class="flex items-center mb-4">
        <button 
          @click="goBack" 
          class="mr-4 text-gray-600 hover:text-gray-800"
        >
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
          </svg>
        </button>
        <h1 class="text-2xl font-bold">Create New Service</h1>
      </div>

      <!-- Create Service Form -->
      <div class="bg-white shadow-md rounded p-6">
        <form @submit.prevent="createService">
          <!-- Type Selection -->
          <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
              Type *
            </label>
            <select
              id="type"
              v-model="form.type"
              required
              class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              <option value="">Select type...</option>
              <option value="service">Service</option>
              <option value="terms">Terms & Conditions</option>
            </select>
            <div v-if="errors.type" class="text-red-600 text-sm mt-1">
              {{ errors.type }}
            </div>
          </div>

          <!-- Service Name -->
          <div class="mb-4">
            <label for="service" class="block text-sm font-medium text-gray-700 mb-2">
              {{ form.type === 'terms' ? 'Terms & Conditions Name' : 'Service Name' }} *
            </label>
            <input
              id="service"
              v-model="form.service"
              type="text"
              required
              class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
              :placeholder="form.type === 'terms' ? 'e.g., Payment Terms, Cancellation Policy' : 'e.g., Cleaning Services, Maintenance Services'"
            />
            <div v-if="errors.service" class="text-red-600 text-sm mt-1">
              {{ errors.service }}
            </div>
          </div>

          <!-- Specifications Section -->
          <div class="mb-6">
            <div class="flex justify-between items-center mb-3">
              <label class="block text-sm font-medium text-gray-700">
                {{ form.type === 'terms' ? 'Terms Details' : 'Service Specifications' }}
              </label>
              <button
                @click="addSpecification"
                type="button"
                class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700 transition"
              >
                + Add {{ form.type === 'terms' ? 'Detail' : 'Specification' }}
              </button>
            </div>

            <!-- Specifications List -->
            <div class="space-y-3">
              <div v-if="form.specifications.length === 0" class="text-gray-500 italic text-sm">
                No {{ form.type === 'terms' ? 'details' : 'specifications' }} added yet. Click "Add {{ form.type === 'terms' ? 'Detail' : 'Specification' }}" to add some.
              </div>
              
              <div 
                v-for="(spec, index) in form.specifications" 
                :key="index"
                class="flex gap-2 items-center"
              >
                <div class="flex-1">
                  <input
                    v-model="spec.description"
                    type="text"
                    required
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    :placeholder="form.type === 'terms' ? `Detail ${index + 1} description` : `Specification ${index + 1} description`"
                  />
                  <div v-if="errors[`specifications.${index}.description`]" class="text-red-600 text-sm mt-1">
                    {{ errors[`specifications.${index}.description`] }}
                  </div>
                </div>
                <button
                  @click="removeSpecification(index)"
                  type="button"
                  class="bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700 transition"
                  :title="`Remove ${form.type === 'terms' ? 'detail' : 'specification'}`"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                  </svg>
                </button>
              </div>
            </div>
          </div>

          <!-- Form Actions -->
          <div class="flex justify-end space-x-3">
            <button 
              @click="goBack"
              type="button" 
              class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition"
            >
              Cancel
            </button>
            <button 
              type="submit"
              :disabled="processing"
              class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition disabled:bg-blue-300"
            >
              {{ processing ? 'Creating...' : `Create ${form.type === 'terms' ? 'Terms' : 'Service'}` }}
            </button>
          </div>
        </form>
      </div>

      <!-- Preview Section -->
      <div v-if="form.type && (form.service || form.specifications.length > 0)" class="bg-gray-50 shadow-md rounded p-6 mt-6">
        <h3 class="text-lg font-medium text-gray-900 mb-3">Preview</h3>
        <div class="bg-white rounded p-4">
          <div class="mb-2">
            <span class="text-sm font-medium text-gray-700">Type:</span>
            <span 
              :class="form.type === 'service' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800'"
              class="ml-2 px-2 py-1 rounded text-xs font-medium"
            >
              {{ form.type === 'service' ? 'Service' : 'Terms & Conditions' }}
            </span>
          </div>
          <div class="mb-2">
            <span class="text-sm font-medium text-gray-700">{{ form.type === 'terms' ? 'Terms Name:' : 'Service Name:' }}</span>
            <span class="ml-2 font-medium">{{ form.service || 'Not specified' }}</span>
          </div>
          <div>
            <span class="text-sm font-medium text-gray-700">{{ form.type === 'terms' ? 'Details:' : 'Specifications:' }}</span>
            <div v-if="validSpecifications.length > 0" class="mt-1">
              <ul class="list-disc list-inside space-y-1">
                <li 
                  v-for="(spec, index) in validSpecifications" 
                  :key="index"
                  class="text-sm text-gray-700"
                >
                  {{ spec.description }}
                </li>
              </ul>
            </div>
            <span v-else class="ml-2 text-gray-400 italic text-sm">No {{ form.type === 'terms' ? 'details' : 'specifications' }}</span>
          </div>
        </div>
      </div>
    </div>
  </LayoutMain>
</template>

<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'
import LayoutMain from "@/Layouts/LayoutMain.vue";

const props = defineProps({
  errors: Object
})

const processing = ref(false)

const form = ref({
  type: '',
  service: '',
  specifications: []
})

// Computed para especificaciones válidas (no vacías) para el preview
const validSpecifications = computed(() => {
  return form.value.specifications.filter(spec => spec.description && spec.description.trim() !== '')
})

const goBack = () => {
  router.visit(route('services.index'))
}

const addSpecification = () => {
  form.value.specifications.push({
    description: ''
  })
}

const removeSpecification = (index) => {
  form.value.specifications.splice(index, 1)
}

const createService = () => {
  // Filtrar especificaciones vacías antes de enviar
  const validSpecs = form.value.specifications.filter(spec => 
    spec.description && spec.description.trim() !== ''
  )

  processing.value = true

  router.post(route('services.store'), {
    type: form.value.type,
    service: form.value.service,
    specifications: validSpecs
  }, {
    onSuccess: () => {
      // Redirigir al index se maneja automáticamente por el controlador
      processing.value = false
    },
    onError: (errors) => {
      console.error('Error creating service:', errors)
      processing.value = false
    },
    onFinish: () => {
      processing.value = false
    }
  })
}
</script>