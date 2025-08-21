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

    <!-- Services Section Component (only show for JWO) -->
    <ServicesSection
      v-if="showServicesSection"
      :services="form.services"
      :available-services="services"
      :errors="form.errors"
      @update:services="updateServices"
    />

    <!-- School Form Section (only show for School) -->
    <SchoolForm
      v-if="showSchoolForm"
      :school-data="form.schoolData || {}"
      :errors="form.errors"
      @update:school-data="updateSchoolData"
    />

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
        :disabled="form.processing || !canSubmitForm"
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

<script setup>
import { computed } from 'vue'
import FormField from "@/Components/FormField.vue"
import FormControl from "@/Components/FormControl.vue"
import ServicesSection from "./ServicesSection.vue"
import SchoolForm from "./SchoolForm.vue"

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
  },
  selectedOrganization: {
    type: String,
    default: null
  }
})

const emit = defineEmits(['update:form', 'submit', 'cancel'])

// Selected client computed
const selectedClient = computed(() => {
  if (!props.form.client_id) return null
  return props.clients.find(client => client.id == props.form.client_id) || null
})

// Show school form when organization is school
const showSchoolForm = computed(() => {
  return props.selectedOrganization === 'school' || props.form.organization === 'school'
})

// Show services section when organization is JWO
const showServicesSection = computed(() => {
  return props.selectedOrganization === 'jwo' || props.form.organization === 'jwo'
})

// Check if form can be submitted
const canSubmitForm = computed(() => {
  if (showServicesSection.value) {
    // For JWO: require at least one service
    return props.form.services && props.form.services.length > 0
  } else if (showSchoolForm.value) {
    // For School: require basic fields (you can adjust these requirements)
    return true // or add specific validation for school form
  }
  return false
})

// Update services handler
const updateServices = (newServices) => {
  emit('update:form', { ...props.form, services: newServices })
}

// Update school data handler
const updateSchoolData = (newSchoolData) => {
  console.log('updateSchoolData called with:', newSchoolData)
  console.log('Current form.schoolData:', props.form.schoolData)
  
  const updatedForm = { ...props.form, schoolData: newSchoolData }
  console.log('Emitting updated form:', updatedForm)
  
  emit('update:form', updatedForm)
}
</script>