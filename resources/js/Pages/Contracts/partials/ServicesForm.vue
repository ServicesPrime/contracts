<template>
  <!-- Dynamic Service Form Section -->
  <section class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="bg-gradient-to-r from-[rgb(3,20,58)] to-blue-800 px-6 py-4">
      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-3">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
          </svg>
          <h2 class="text-xl font-semibold text-white">Services</h2>
        </div>
        <button 
          type="button" 
          @click="addNewService"
          class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex items-center space-x-2 transform hover:scale-105"
          >
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
          </svg>
          <span>Add Service</span>
        </button>
      </div>
    </div>
    
    <div class="p-6">
      <!-- Error Messages -->
      <div v-if="errors.services" class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg">
        <p class="text-sm text-red-600">{{ errors.services }}</p>
      </div>

      <!-- Empty State -->
      <div v-if="services.length === 0" class="text-center py-8 text-gray-500">
        <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
        <p class="text-lg font-medium">No services added yet</p>
        <p class="text-sm mt-1">Click "Add Service" to start adding services</p>
      </div>

      <!-- Services List -->
      <div class="space-y-6">
        <div 
          v-for="(service, index) in services" 
          :key="`service-${index}`"
          class="bg-gray-50 rounded-lg p-4 border border-gray-200 relative transition-all duration-200 hover:shadow-md"
        >
          <!-- Remove service button -->
          <button 
            v-if="services.length > 1"
            type="button"
            @click="removeService(index)"
            class="absolute top-2 right-2 text-gray-400 hover:text-red-500 transition-colors duration-200 p-1 rounded-full hover:bg-red-50"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>

          <!-- Service header -->
          <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Service #{{ index + 1 }}</h3>
          </div>

          <!-- Service Form Fields -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Type Selection -->
            <div class="md:col-span-2">
              <label class="block text-sm font-medium text-gray-700 mb-2">
                Type *
              </label>
              <select
                :value="service.type"
                @change="handleTypeChange(index, $event.target.value)"
                required
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
              >
                <option value="">Select type...</option>
                <option value="service">Service</option>
                <option value="terms">Terms & Conditions</option>
                <option value="area">Area</option>
              </select>
              <div v-if="errors[`services.${index}.type`]" class="text-red-600 text-sm mt-1">
                {{ errors[`services.${index}.type`] }}
              </div>
            </div>

            <!-- Service Name -->
            <div class="md:col-span-2">
              <label class="block text-sm font-medium text-gray-700 mb-2">
                {{ service.type === 'terms' ? 'Terms & Conditions Name' : 'Service Name' }} *
              </label>
              <input
                :value="service.service"
                @input="updateServiceField(index, 'service', $event.target.value)"
                type="text"
                required
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                :placeholder="service.type === 'terms' ? 'e.g., Payment Terms, Cancellation Policy' : 'e.g., Cleaning Services, Maintenance Services'"
              />
              <div v-if="errors[`services.${index}.service`]" class="text-red-600 text-sm mt-1">
                {{ errors[`services.${index}.service`] }}
              </div>
            </div>

            <!-- Specifications Section -->
            <div class="md:col-span-2">
              <div class="flex justify-between items-center mb-3">
                <label class="block text-sm font-medium text-gray-700">
                  {{ service.type === 'terms' ? 'Terms Details' : 'Service Specifications' }}
                </label>
                <button
                  @click="addSpecification(index)"
                  type="button"
                  class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700 transition"
                >
                  + Add {{ service.type === 'terms' ? 'Detail' : 'Specification' }}
                </button>
              </div>

              <!-- Specifications List -->
              <div class="space-y-3">
                <div v-if="!service.specifications || service.specifications.length === 0" class="text-gray-500 italic text-sm">
                  No {{ service.type === 'terms' ? 'details' : 'specifications' }} added yet. Click "Add {{ service.type === 'terms' ? 'Detail' : 'Specification' }}" to add some.
                </div>
                
                <div 
                  v-for="(spec, specIndex) in service.specifications" 
                  :key="`spec-${index}-${specIndex}`"
                  class="flex gap-2 items-center"
                >
                  <div class="flex-1">
                    <input
                      :value="spec.description"
                      @input="updateSpecification(index, specIndex, $event.target.value)"
                      type="text"
                      required
                      class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                      :placeholder="service.type === 'terms' ? `Detail ${specIndex + 1} description` : `Specification ${specIndex + 1} description`"
                    />
                    <div v-if="errors[`services.${index}.specifications.${specIndex}.description`]" class="text-red-600 text-sm mt-1">
                      {{ errors[`services.${index}.specifications.${specIndex}.description`] }}
                    </div>
                  </div>
                  <button
                    @click="removeSpecification(index, specIndex)"
                    type="button"
                    class="bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700 transition"
                    :title="`Remove ${service.type === 'terms' ? 'detail' : 'specification'}`"
                  >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                  </button>
                </div>
              </div>
            </div>

            <!-- Terms & Conditions Notice -->
            <div v-if="service.type === 'terms'" class="md:col-span-2">
              <div class="bg-purple-50 rounded-lg p-3 border border-purple-200">
                <div class="flex items-center space-x-2">
                  <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                  <span class="text-sm font-medium text-purple-700">Terms & Conditions - No pricing required</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Service Preview -->
          <div v-if="service.type && (service.service || (service.specifications && service.specifications.length > 0))" class="mt-4">
            <div class="bg-white rounded-lg p-3 border border-gray-300">
              <h4 class="text-sm font-medium text-gray-700 mb-2">Preview:</h4>
              <div class="text-sm text-gray-600">
                <div class="mb-2">
                  <span class="text-sm font-medium text-gray-700">Type:</span>
                  <span 
                    :class="service.type === 'service' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800'"
                    class="ml-2 px-2 py-1 rounded text-xs font-medium"
                  >
                    {{ service.type === 'service' ? 'Service' : 'Terms & Conditions' }}
                  </span>
                </div>
                <div class="mb-2">
                  <span class="text-sm font-medium text-gray-700">{{ service.type === 'terms' ? 'Terms Name:' : 'Service Name:' }}</span>
                  <span class="ml-2 font-medium">{{ service.service || 'Not specified' }}</span>
                </div>
                <div v-if="service.specifications && service.specifications.length > 0">
                  <span class="text-sm font-medium text-gray-700">{{ service.type === 'terms' ? 'Details:' : 'Specifications:' }}</span>
                  <ul class="list-disc list-inside ml-2 mt-1">
                    <li v-for="spec in service.specifications.filter(s => s.description && s.description.trim())" :key="spec.description" class="text-xs">
                      {{ spec.description }}
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
const props = defineProps({
  services: {
    type: Array,
    required: true
  },
  errors: {
    type: Object,
    default: () => ({})
  }
})

const emit = defineEmits(['update:services'])

// Helper Functions
const addNewService = () => {
  const newServices = [...props.services, {
    type: '',
    service: '',
    specifications: []
  }]
  emit('update:services', newServices)
}

const removeService = (index) => {
  if (props.services.length > 1) {
    const newServices = [...props.services]
    newServices.splice(index, 1)
    emit('update:services', newServices)
  }
}

const handleTypeChange = (index, type) => {
  const newServices = [...props.services]
  newServices[index].type = type
  emit('update:services', newServices)
}

const updateServiceField = (index, field, value) => {
  const newServices = [...props.services]
  newServices[index][field] = value
  emit('update:services', newServices)
}

const addSpecification = (serviceIndex) => {
  const newServices = [...props.services]
  if (!newServices[serviceIndex].specifications) {
    newServices[serviceIndex].specifications = []
  }
  newServices[serviceIndex].specifications.push({
    description: ''
  })
  emit('update:services', newServices)
}

const removeSpecification = (serviceIndex, specIndex) => {
  const newServices = [...props.services]
  newServices[serviceIndex].specifications.splice(specIndex, 1)
  emit('update:services', newServices)
}

const updateSpecification = (serviceIndex, specIndex, value) => {
  const newServices = [...props.services]
  newServices[serviceIndex].specifications[specIndex].description = value
  emit('update:services', newServices)
}
</script>