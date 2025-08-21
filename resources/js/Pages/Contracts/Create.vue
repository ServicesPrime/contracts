<template>
  <LayoutMain>
    <!-- Organization Selector (only show when creating and no organization selected) -->
    <OrganizationSelector 
      v-if="!isEditing && !selectedOrganization"
      @organization-selected="handleOrganizationSelected"
    />

    <!-- Contract Form (show when editing or organization selected) -->
    <div v-else class="min-h-screen bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <div>
              <h1 class="text-3xl font-bold text-gray-900">{{ isEditing ? 'Edit Contract' : 'Create New Contract' }}</h1>
              <p class="text-gray-600 mt-2">Fill in the information below to {{ isEditing ? 'update' : 'create' }} a contract</p>
            </div>
            <!-- Show selected organization when creating -->
            <div v-if="!isEditing && selectedOrganization" class="text-right">
              <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium"
                   :class="selectedOrganization === 'school' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path v-if="selectedOrganization === 'school'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                  <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                {{ selectedOrganization === 'school' ? 'School' : 'JWO' }}
              </div>
              <button 
                @click="selectedOrganization = null"
                class="text-sm text-gray-500 hover:text-gray-700 mt-1 block"
              >
                Change Organization
              </button>
            </div>
          </div>
        </div>

        <!-- Toggle Preview Button (Mobile) -->
        <div class="lg:hidden mb-4">
          <button 
            @click="showPreview = !showPreview"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center justify-center space-x-2 transition-colors duration-200"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
            <span>{{ showPreview ? 'Hide Preview' : 'Show Preview' }}</span>
          </button>
        </div>

        <!-- Main Content Grid -->
        <div class="lg:grid lg:grid-cols-2 lg:gap-8">
          
          <!-- Form Section -->
          <div :class="{ 'block': !showPreview || !isMobile, 'hidden': showPreview && isMobile }">
            <ContractInformationForm
              :form="form"
              :clients="clients"
              :services="services"
              :is-editing="isEditing"
              @update:form="updateForm"
              @submit="submitForm"
              @cancel="goBack"
            />
          </div>

          <!-- Preview Section -->
          <div :class="{ 'block': !isMobile || showPreview, 'hidden': isMobile && !showPreview }">
            <div class="sticky top-8">
              <!-- Preview Header -->
              <div class="bg-white rounded-t-xl shadow-sm border border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                  <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900">Contract Preview</h3>
                  </div>
                  <!-- Desktop toggle -->
                  <button 
                    @click="showPreview = !showPreview"
                    class="hidden lg:block text-gray-400 hover:text-gray-600 p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200"
                  >
                    <svg v-if="!showPreview" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L9.878 9.878zM12.878 4.878L12.878 4.878z"/>
                    </svg>
                  </button>
                </div>
              </div>

              <!-- Preview Content -->
              <div v-show="showPreview" class="bg-gray-100 border-l border-r border-b border-gray-200 rounded-b-xl p-4 max-h-[calc(100vh-12rem)] overflow-y-auto">
                <div class="bg-white rounded-lg shadow-sm" style="transform: scale(0.8); transform-origin: top center; width: 125%; margin: -10% -12.5% 0 -12.5%;">
                  <ContractPreviewContent :contract="previewContract" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </LayoutMain>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { useForm, router } from '@inertiajs/vue3'
import LayoutMain from "@/Layouts/LayoutMain.vue"
import OrganizationSelector from "./partials/OrganizationSelector.vue"
import ContractInformationForm from "./partials/ContractInformationForm.vue"
import ContractPreviewContent from "@/Components/PDF/ContractPreviewContent.vue"

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
  },
  contractNumber: {
    type: String,
    default: ''
  }
})

// Reactive data
const showPreview = ref(true)
const isMobile = ref(false)
const selectedOrganization = ref(null)

// Mobile detection
const checkMobile = () => {
  isMobile.value = window.innerWidth < 1024
  if (isMobile.value) {
    showPreview.value = false
  }
}

onMounted(() => {
  checkMobile()
  window.addEventListener('resize', checkMobile)
})

onUnmounted(() => {
  window.removeEventListener('resize', checkMobile)
})

// Check if we're editing
const isEditing = computed(() => !!props.contract?.id)

// Initialize form services
const initializeServices = () => {
  if (isEditing.value && props.contract?.contract_services) {
    return props.contract.contract_services.map(cs => ({
      service_id: cs.service_id,
      quantity: cs.quantity,
      unit_price: cs.unit_price
    }))
  }
  return [{
    service_id: '',
    quantity: '',
    unit_price: ''
  }]
}

// Form setup
const form = useForm({
  contract_number: isEditing.value ? props.contract?.contract_number : (props.contractNumber || ''),
  client_id: props.contract?.client_id || '',
  department: props.contract?.department || '',
  date: isEditing.value ? props.contract?.date : new Date().toISOString().split('T')[0],
  services: initializeServices(),
  organization: null // New field for organization
})

// Handle organization selection
const handleOrganizationSelected = (organization) => {
  selectedOrganization.value = organization
  // Update form with selected organization
  form.organization = organization
}

// Preview contract object
const previewContract = computed(() => {
  const clientData = form.client_id ? props.clients.find(client => client.id == form.client_id) : null
  
  const contract_services = []
  
  if (form.services && Array.isArray(form.services)) {
    form.services.forEach((service, index) => {
      if (service.service_id) {
        const serviceData = props.services.find(s => s.id == service.service_id)
        if (serviceData) {
          contract_services.push({
            id: `temp-${index}`,
            service_id: service.service_id,
            quantity: service.quantity || '',
            unit_price: service.unit_price || '',
            service: {
              id: serviceData.id,
              service: serviceData.service,
              type: serviceData.type,
              specifications: serviceData.specifications || []
            }
          })
        }
      }
    })
  }

  return {
    id: 'preview',
    contract_number: form.contract_number || '',
    date: form.date || '',
    department: form.department || '',
    client_id: form.client_id || '',
    client: clientData ? {
      id: clientData.id,
      name: clientData.name,
      email: clientData.email,
      phone: clientData.phone,
      area: clientData.area,
      address: clientData.address || null
    } : null,
    contract_services: contract_services
  }
})

// Form update handler
const updateForm = (newFormData) => {
  // Update form fields
  Object.keys(newFormData).forEach(key => {
    if (key in form) {
      form[key] = newFormData[key]
    }
  })
}

// Form actions
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