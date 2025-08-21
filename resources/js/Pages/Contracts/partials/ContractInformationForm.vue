
<script setup>
import { computed } from 'vue'
import FormField from "@/Components/FormField.vue"
import FormControl from "@/Components/FormControl.vue"

const props = defineProps({
  form: {
    type: Object,
    required: true
  },
  clients: {
    type: Array,
    default: () => []
  },
  services: {
    type: Array,
    default: () => []
  },
  isEditing: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(['update:form', 'submit', 'cancel'])

// Selected client computed
const selectedClient = computed(() => {
  if (!props.form.client_id) return null
  return props.clients.find(client => client.id == props.form.client_id) || null
})

// Validation helpers
const hasValidServices = computed(() => {
  return props.form.services.some(service => {
    if (isTermsService(service.service_id)) {
      return service.service_id
    }
    return service.service_id && service.quantity && service.unit_price
  })
})

// Service type checking
const isTermsService = (serviceId) => {
  const service = getServiceById(serviceId)
  return service && service.type === 'terms'
}

// Service count for payment
const getPaidServicesCount = () => {
  return props.form.services.filter(service => 
    service.service_id && !isTermsService(service.service_id) && service.quantity && service.unit_price
  ).length
}

// Service management
const addService = () => {
  const newServices = [...props.form.services, {
    service_id: '',
    quantity: '',
    unit_price: ''
  }]
  emit('update:form', { ...props.form, services: newServices })
}

const removeService = (index) => {
  if (props.form.services.length > 1) {
    const newServices = [...props.form.services]
    newServices.splice(index, 1)
    emit('update:form', { ...props.form, services: newServices })
  }
}

const getServiceById = (serviceId) => {
  if (!serviceId) return null
  return props.services.find(service => service.id == serviceId) || null
}

const handleServiceChange = (index, serviceId) => {
  const newServices = [...props.form.services]
  newServices[index].service_id = serviceId
  
  if (isTermsService(serviceId)) {
    newServices[index].quantity = ''
    newServices[index].unit_price = ''
  }
  
  emit('update:form', { ...props.form, services: newServices })
}

const updateServiceField = (index, field, value) => {
  const newServices = [...props.form.services]
  newServices[index][field] = value
  emit('update:form', { ...props.form, services: newServices })
}

// Currency formatting
const formatServiceCurrency = (e, index) => {
  let value = e.target.value.replace(/[^\d.]/g, '')
  const parts = value.split('.')
  if (parts.length > 2) {
    value = parts[0] + '.' + parts[1]
  }
  if (parts[1] && parts[1].length > 2) {
    value = parts[0] + '.' + parts[1].substring(0, 2)
  }
  updateServiceField(index, 'unit_price', value)
}

// Calculations
const calculateServiceSubtotal = (service) => {
  const quantity = parseInt(service.quantity) || 0
  const unitPrice = parseFloat(service.unit_price) || 0
  return (quantity * unitPrice).toFixed(2)
}

const calculateContractTotal = () => {
  return props.form.services.reduce((total, service) => {
    if (!isTermsService(service.service_id)) {
      const quantity = parseInt(service.quantity) || 0
      const unitPrice = parseFloat(service.unit_price) || 0
      return total + (quantity * unitPrice)
    }
    return total
  }, 0).toFixed(2)
}
</script>
<template>
  <form @submit.prevent="$emit('submit')" class="space-y-8">
    
    <!-- Contract Information Section -->
    <section class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
      <div class="bg-gradient-to-r from-[rgb(3,20,58)] to-blue-800 px-6 py-4">
        <div class="flex items-center space-x-3">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
          <h2 class="text-xl font-semibold text-white">Contract Information</h2>
        </div>
      </div>
      <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <FormField label="Contract Number" required :error="form.errors.contract_number">                   
            <FormControl                      
              :model-value="form.contract_number"
              @update:model-value="$emit('update:form', { ...form, contract_number: $event })"
              placeholder="Enter contract number"                      
              inputmode="numeric"                     
              @input="e => $emit('update:form', { ...form, contract_number: e.target.value.replace(/\D/g, '') })"                   
            />                 
          </FormField>

          <FormField label="Date" required :error="form.errors.date">
            <FormControl 
              :model-value="form.date"
              @update:model-value="$emit('update:form', { ...form, date: $event })"
              type="date"
            />
          </FormField>

          <div class="md:col-span-2">
            <FormField label="Department" required :error="form.errors.department">
              <FormControl 
                :model-value="form.department"
                @update:model-value="$emit('update:form', { ...form, department: $event })"
                placeholder="Enter department (e.g., Food and Beverage)" 
              />
            </FormField>
          </div>
        </div>
      </div>
    </section>

    <!-- Client Selection Section -->
    <section class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
      <div class="bg-gradient-to-r from-[rgb(3,20,58)] to-blue-800 px-6 py-4">
        <div class="flex items-center space-x-3">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
          </svg>
          <h2 class="text-xl font-semibold text-white">Client Information</h2>
        </div>
      </div>
      <div class="p-6">
        <FormField label="Select Client" required :error="form.errors.client_id">
          <select 
            :value="form.client_id"
            @change="$emit('update:form', { ...form, client_id: $event.target.value })"
            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
          >
            <option value="">Select a client...</option>
            <option v-for="client in clients" :key="client.id" :value="client.id">
              {{ client.name }} - {{ client.email }}
            </option>
          </select>
        </FormField>

        <!-- Selected Client Preview -->
        <div v-if="selectedClient" class="mt-4 bg-gray-50 rounded-lg p-4 border border-gray-200">
          <h4 class="text-sm font-medium text-gray-700 mb-2">Selected Client:</h4>
          <div class="text-sm text-gray-600">
            <div><strong>Name:</strong> {{ selectedClient.name }}</div>
            <div><strong>Email:</strong> {{ selectedClient.email }}</div>
            <div><strong>Phone:</strong> {{ selectedClient.phone }}</div>
            <div><strong>Area:</strong> {{ selectedClient.area }}</div>
            <div v-if="selectedClient.address" class="mt-2">
              <strong>Address:</strong> 
              <div class="ml-2">
                <div v-if="selectedClient.address.street">{{ selectedClient.address.street }}</div>
                <div v-if="selectedClient.address.city || selectedClient.address.state || selectedClient.address.zip_code">
                  {{ [selectedClient.address.city, selectedClient.address.state, selectedClient.address.zip_code].filter(Boolean).join(', ') }}
                </div>
                <div v-if="selectedClient.address.country">{{ selectedClient.address.country }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Services Selection Section -->
    <section class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
      <div class="bg-gradient-to-r from-[rgb(3,20,58)] to-blue-800 px-6 py-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-3">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <h2 class="text-xl font-semibold text-white">Services ({{ form.services.length }})</h2>
          </div>
          <button 
            type="button" 
            @click="addService"
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
        
        <!-- Error message for services -->
        <div v-if="form.errors.services" class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg">
          <p class="text-sm text-red-600">{{ form.errors.services }}</p>
        </div>

        <!-- No services message -->
        <div v-if="form.services.length === 0" class="text-center py-8 text-gray-500">
          <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012 2v2M7 7h10"/>
          </svg>
          <p class="text-lg font-medium">No services added yet</p>
          <p class="text-sm mt-1">Click "Add Service" to start adding services to this contract</p>
        </div>

        <!-- Services List -->
        <div class="space-y-6">
          <div 
            v-for="(service, index) in form.services" 
            :key="`service-${index}`"
            class="bg-gray-50 rounded-lg p-4 border border-gray-200 relative transition-all duration-200 hover:shadow-md"
          >
            <!-- Remove service button -->
            <button 
              type="button"
              @click="removeService(index)"
              class="absolute top-2 right-2 text-gray-400 hover:text-red-500 transition-colors duration-200 p-1 rounded-full hover:bg-red-50"
              :disabled="form.services.length === 1"
              :class="{ 'opacity-50 cursor-not-allowed': form.services.length === 1 }"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>

            <!-- Service header -->
            <div class="mb-4">
              <h3 class="text-lg font-semibold text-gray-800">Service #{{ index + 1 }}</h3>
            </div>

            <!-- Service form fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <!-- Service Selection -->
              <div class="md:col-span-2">
                <FormField :label="`Select Service ${index + 1}`" required :error="form.errors[`services.${index}.service_id`]">
                  <select 
                    :value="service.service_id"
                    @change="handleServiceChange(index, $event.target.value)"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                  >
                    <option value="">Select a service...</option>
                    <option v-for="availableService in services" :key="availableService.id" :value="availableService.id">
                      {{ availableService.service }} ({{ availableService.type === 'service' ? 'Service' : 'Terms & Conditions' }})
                    </option>
                  </select>
                </FormField>
              </div>

              <!-- Show Quantity and Unit Price only for 'service' type -->
              <template v-if="!isTermsService(service.service_id)">
                <!-- Quantity -->
                <FormField :label="`Quantity ${index + 1}`" required :error="form.errors[`services.${index}.quantity`]">
                  <FormControl 
                    :model-value="service.quantity"
                    @update:model-value="updateServiceField(index, 'quantity', $event)"
                    placeholder="Enter quantity" 
                    inputmode="numeric"
                    @input="e => updateServiceField(index, 'quantity', e.target.value.replace(/\D/g, ''))"
                  />
                </FormField>

                <!-- Unit Price -->
                <FormField :label="`Unit Price ${index + 1}`" required :error="form.errors[`services.${index}.unit_price`]">
                  <div class="relative">
                    <span class="absolute left-3 top-2 text-gray-500">$</span>
                    <FormControl 
                      :model-value="service.unit_price"
                      @update:model-value="updateServiceField(index, 'unit_price', $event)"
                      placeholder="0.00" 
                      inputmode="decimal"
                      class="pl-8"
                      @input="e => formatServiceCurrency(e, index)"
                    />
                  </div>
                </FormField>

                <!-- Subtotal Preview -->
                <div v-if="service.quantity && service.unit_price" class="md:col-span-2">
                  <div class="bg-blue-50 rounded-lg p-3 border border-blue-200">
                    <div class="flex justify-between items-center">
                      <span class="text-sm font-medium text-blue-700">Subtotal Service {{ index + 1 }}:</span>
                      <span class="text-lg font-bold text-blue-900">
                        ${{ calculateServiceSubtotal(service) }}
                      </span>
                    </div>
                    <div class="text-xs text-blue-600 mt-1">
                      {{ service.quantity }} × ${{ service.unit_price }}
                    </div>
                  </div>
                </div>
              </template>

              <!-- Terms & Conditions Notice -->
              <div v-if="isTermsService(service.service_id)" class="md:col-span-2">
                <div class="bg-purple-50 rounded-lg p-3 border border-purple-200">
                  <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="text-sm font-medium text-purple-700">Terms & Conditions - No pricing required</span>
                  </div>
                </div>
              </div>

              <!-- Selected Service Preview -->
              <div v-if="getServiceById(service.service_id)" class="md:col-span-2">
                <div class="bg-white rounded-lg p-3 border border-gray-300">
                  <h4 class="text-sm font-medium text-gray-700 mb-2">Service Details:</h4>
                  <div class="text-sm text-gray-600">
                    <div><strong>Service:</strong> {{ getServiceById(service.service_id).service }}</div>
                    <div><strong>Type:</strong> 
                      <span 
                        :class="getServiceById(service.service_id).type === 'service' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800'"
                        class="inline-block px-2 py-1 rounded text-xs font-medium ml-1"
                      >
                        {{ getServiceById(service.service_id).type === 'service' ? 'Service' : 'Terms & Conditions' }}
                      </span>
                    </div>
                    <div v-if="getServiceById(service.service_id).specifications && getServiceById(service.service_id).specifications.length > 0" class="mt-2">
                      <strong>Available Specifications:</strong>
                      <ul class="list-disc list-inside ml-2 mt-1">
                        <li v-for="spec in getServiceById(service.service_id).specifications" :key="spec.id" class="text-xs">
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

        <!-- Contract Total -->
        <div v-if="form.services.length > 0 && hasValidServices" class="mt-6">
          <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-lg p-6 border border-green-200">
            <div class="flex justify-between items-center">
              <div>
                <span class="text-lg font-semibold text-gray-800">Contract Total:</span>
                <div class="text-sm text-gray-600 mt-1">{{ getPaidServicesCount() }} paid service(s)</div>
              </div>
              <span class="text-2xl font-bold text-green-700">
                ${{ calculateContractTotal() }}
              </span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Form Actions -->
    <div class="flex justify-end space-x-4 pt-6">
      <button 
        type="button" 
        @click="$emit('cancel')"
        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
      >
        Cancel
      </button>
      <button 
        type="submit" 
        :disabled="form.processing || form.services.length === 0"
        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
      >
        <span v-if="form.processing" class="flex items-center">
          <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          {{ isEditing ? 'Updating...' : 'Creating...' }}
        </span>
        <span v-else>
          {{ isEditing ? 'Update Contract' : 'Create Contract' }}
        </span>
      </button>
    </div>
  </form>
</template>
