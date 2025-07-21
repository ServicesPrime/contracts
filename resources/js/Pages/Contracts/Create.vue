<template>
  <LayoutMain>
    <div class="min-h-screen bg-gray-50">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="mb-8">
          <h1 class="text-3xl font-bold text-gray-900">{{ isEditing ? 'Edit Contract' : 'Create New Contract' }}</h1>
          <p class="text-gray-600 mt-2">Fill in the information below to {{ isEditing ? 'update' : 'create' }} a contract</p>
        </div>

        <form @submit.prevent="submitForm" class="space-y-8">
          
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
                    v-model="form.contract_number" 
                    placeholder="Enter contract number" 
                    inputmode="numeric"
                    @input="e => form.contract_number = e.target.value.replace(/\D/g, '')"
                  />
                </FormField>

                <FormField label="Date" required :error="form.errors.date">
                  <FormControl 
                    v-model="form.date" 
                    type="date"
                  />
                </FormField>

                <div class="md:col-span-2">
                  <FormField label="Department" required :error="form.errors.department">
                    <FormControl 
                      v-model="form.department" 
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
                  v-model="form.client_id" 
                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
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

          <!-- Service Selection Section -->
          <section class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-[rgb(3,20,58)] to-blue-800 px-6 py-4">
              <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <h2 class="text-xl font-semibold text-white">Service Information</h2>
              </div>
            </div>
            <div class="p-6">
              <FormField label="Select Service" required :error="form.errors.service_id">
                <select 
                  v-model="form.service_id" 
                  class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                  <option value="">Select a service...</option>
                  <option v-for="service in services" :key="service.id" :value="service.id">
                    {{ service.service }} ({{ service.type === 'service' ? 'Service' : 'Terms & Conditions' }})
                  </option>
                </select>
              </FormField>

              <!-- Selected Service Preview -->
              <div v-if="selectedService" class="mt-4 bg-gray-50 rounded-lg p-4 border border-gray-200">
                <h4 class="text-sm font-medium text-gray-700 mb-2">Selected Service:</h4>
                <div class="text-sm text-gray-600">
                  <div><strong>Service:</strong> {{ selectedService.service }}</div>
                  <div><strong>Type:</strong> 
                    <span 
                      :class="selectedService.type === 'service' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800'"
                      class="inline-block px-2 py-1 rounded text-xs font-medium ml-1"
                    >
                      {{ selectedService.type === 'service' ? 'Service' : 'Terms & Conditions' }}
                    </span>
                  </div>
                  <div v-if="selectedService.specifications && selectedService.specifications.length > 0" class="mt-2">
                    <strong>Specifications:</strong>
                    <ul class="list-disc list-inside ml-2 mt-1">
                      <li v-for="spec in selectedService.specifications" :key="spec.id" class="text-xs">
                        {{ spec.description }}
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <!-- Product Details Section -->
          <section class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-[rgb(3,20,58)] to-blue-800 px-6 py-4">
              <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                <h2 class="text-xl font-semibold text-white">Product Details</h2>
              </div>
            </div>
            <div class="p-6">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <FormField label="Quantity" required :error="form.errors.product_quantity">
                  <FormControl 
                    v-model="form.product_quantity" 
                    placeholder="Enter quantity" 
                    inputmode="numeric"
                    @input="e => form.product_quantity = e.target.value.replace(/\D/g, '')"
                  />
                </FormField>

                <FormField label="Cost" required :error="form.errors.product_cost">
                  <div class="relative">
                    <span class="absolute left-3 top-2 text-gray-500">$</span>
                    <FormControl 
                      v-model="form.product_cost" 
                      placeholder="0.00" 
                      inputmode="decimal"
                      class="pl-8"
                      @input="formatCurrency"
                    />
                  </div>
                </FormField>

                <!-- Total Preview -->
                <div v-if="form.product_quantity && form.product_cost" class="md:col-span-2">
                  <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                    <div class="flex justify-between items-center">
                      <span class="text-sm font-medium text-blue-700">Total Amount:</span>
                      <span class="text-lg font-bold text-blue-900">
                        ${{ calculateTotal() }}
                      </span>
                    </div>
                    <div class="text-xs text-blue-600 mt-1">
                      {{ form.product_quantity }} × ${{ form.product_cost }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <!-- Form Actions -->
          <div class="flex justify-end space-x-4 pt-6">
            <button 
              type="button" 
              @click="goBack"
              class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
            >
              Cancel
            </button>
            <button 
              type="submit" 
              :disabled="form.processing"
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
      </div>
    </div>
  </LayoutMain>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useForm, router } from '@inertiajs/vue3'
import LayoutMain from "@/Layouts/LayoutMain.vue"
import FormField from "@/Components/FormField.vue"
import FormControl from "@/Components/FormControl.vue"

const props = defineProps({
  contract: {
    type: Object,
    default: () => ({})
  },
  clients: {
    type: Array,
    default: () => []
  },
  services: {
    type: Array,
    default: () => []
  }
})

const isEditing = computed(() => !!props.contract?.id)

const form = useForm({
  contract_number: props.contract?.contract_number || '',
  client_id: props.contract?.client_id || '',
  department: props.contract?.department || '',
  service_id: props.contract?.service_id || '',
  product_quantity: props.contract?.product_quantity || '',
  product_cost: props.contract?.product_cost || '',
  date: props.contract?.date || new Date().toISOString().split('T')[0]
})

const selectedClient = computed(() => {
  return props.clients.find(client => client.id == form.client_id)
})

const selectedService = computed(() => {
  return props.services.find(service => service.id == form.service_id)
})

const formatCurrency = (e) => {
  let value = e.target.value.replace(/[^\d.]/g, '')
  // Allow only one decimal point
  const parts = value.split('.')
  if (parts.length > 2) {
    value = parts[0] + '.' + parts[1]
  }
  // Limit decimal places to 2
  if (parts[1] && parts[1].length > 2) {
    value = parts[0] + '.' + parts[1].substring(0, 2)
  }
  form.product_cost = value
}

const calculateTotal = () => {
  const quantity = parseInt(form.product_quantity) || 0
  const cost = parseFloat(form.product_cost) || 0
  return (quantity * cost).toFixed(2)
}

const submitForm = () => {
  if (isEditing.value) {
    form.put(route('contracts.update', props.contract.id))
  } else {
    form.post(route('contracts.store'))
  }
}

const goBack = () => {
  router.visit(route('contracts.index'))
}
</script>