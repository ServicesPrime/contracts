// Preview refresh function
const refreshPreview = async () => {
if (isLoadingPreview.value) return

isLoadingPreview.value = true
previewError.value = null

try {
const formData = {
...form.data(),
contract_id: isEditing.value ? props.contract.id : null,
organization: selectedOrganization.value
}

const response = await axios.post(route('contracts.preview'), formData, {
headers: {
'Content-Type': 'application/json',
'Accept': 'text/html'
}
})

previewHtml.value = response.data
} catch (error) {
console.error('Error loading preview:', error)
previewError.value = error.response?.data?.message || 'Failed to load preview'
} finally {
isLoadingPreview.value = false
}
}

// Watch for form changes and auto-refresh preview
let debounceTimeout = null
watch(() => [form.data(), selectedOrganization.value], () => {
// Debounce the preview refresh to avoid too many requests
if (debounceTimeout) {
clearTimeout(debounceTimeout)
}
debounceTimeout = setTimeout(() => {
if (showPreview.value) {
refreshPreview()
}
}, 1000) // 1 second debounce
}, { deep: true })<template>
  <LayoutMain>
    <!-- Organization Selector (only show when creating and no organization selected) -->
    <OrganizationSelector v-if="!isEditing && !selectedOrganization"
      @organization-selected="handleOrganizationSelected" />

    <!-- Contract Form (show when editing or organization selected) -->
    <div v-else class="min-h-screen bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header -->
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <div>
              <h1 class="text-3xl font-bold text-gray-900">{{ isEditing ? 'Edit Contract' : 'Create New Contract' }}
              </h1>
              <p class="text-gray-600 mt-2">Fill in the information below to {{ isEditing ? 'update' : 'create' }} a
                contract</p>
            </div>
            <div v-if="!isEditing && selectedOrganization" class="text-right">
              <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium" :class="{
                'bg-blue-100 text-blue-800': selectedOrganization === 'school',
                'bg-green-100 text-green-800': selectedOrganization === 'jwo',
                'bg-purple-100 text-purple-800': selectedOrganization === 'general'
              }">
                <!-- Ícono School -->
                <svg v-if="selectedOrganization === 'school'" class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>

                <!-- Ícono JWO -->
                <svg v-else-if="selectedOrganization === 'jwo'" class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>

                <!-- Ícono General -->
                <svg v-else class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>

                <!-- Texto -->
                {{
                  selectedOrganization === 'school'
                    ? 'School'
                    : selectedOrganization === 'jwo'
                      ? 'JWO'
                      : 'General Contract'
                }}
              </div>

              <button @click="selectedOrganization = null" class="text-sm text-gray-500 hover:text-gray-700 mt-1 block">
                Change Organization
              </button>
            </div>
          </div>
        </div>

        <!-- Toggle Preview Button (Mobile) -->
        <div class="lg:hidden mb-4">
          <button @click="showPreview = !showPreview"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center justify-center space-x-2 transition-colors duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <span>{{ showPreview ? 'Hide Preview' : 'Show Preview' }}</span>
          </button>
        </div>
<!-- Main Content Grid 50%-70% with custom fractions -->
<div class="lg:grid lg:gap-8" style="grid-template-columns: 4.3fr 9fr;">
  
  <!-- Form Section (5fr ≈ 42%) -->
  <div :class="{ 'block': !showPreview || !isMobile, 'hidden': showPreview && isMobile }">
    <ContractInformationForm :form="form" :clients="clients" :services="services" :is-editing="isEditing"
      :selected-organization="selectedOrganization" @update:form="updateForm" @submit="submitForm"
      @cancel="goBack" />
  </div>

  <!-- Preview Section (7fr ≈ 58%) -->
  <div :class="{ 'block': !isMobile || showPreview, 'hidden': isMobile && !showPreview }">
    <div class="sticky top-8">
      <!-- Preview Header -->
      <div class="bg-white rounded-t-xl shadow-sm border border-gray-200 px-6 py-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-3">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <h3 class="text-lg font-semibold text-gray-900">Contract Preview</h3>
          </div>
                                     
          <!-- Refresh Preview Button -->
          <div class="flex items-center space-x-2">
                                         
            <!-- Desktop toggle -->
            <button @click="showPreview = !showPreview"
              class="hidden lg:block text-gray-400 hover:text-gray-600 p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
              <svg v-if="!showPreview" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L9.878 9.878zM12.878 4.878L12.878 4.878z" />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <!-- Preview Content -->
      <div v-show="showPreview"
        class="bg-gray-100 border-l border-r border-b border-gray-200 rounded-b-xl p-4 h-[600px] overflow-hidden w-full">
        <ContractPreview />
      </div>
    </div>
  </div>
</div>
      </div>
    </div>
  </LayoutMain>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from 'vue'
import { useForm, router } from '@inertiajs/vue3'
import LayoutMain from "@/Layouts/LayoutMain.vue"
import OrganizationSelector from "./partials/OrganizationSelector.vue"
import ContractInformationForm from "./partials/ContractInformationForm.vue"
import ContractPreview from "./partials/ContractPreview.vue"

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
  organization: null,
  schoolData: {}
})

// Handle organization selection
const handleOrganizationSelected = (organization) => {
  selectedOrganization.value = organization
  form.organization = organization
}

// Preview refresh function
const refreshPreview = async () => {
  if (isLoadingPreview.value) return

  isLoadingPreview.value = true
  previewError.value = null

  try {
    const formData = {
      ...form.data(),
      contract_id: isEditing.value ? props.contract.id : null,
      organization: selectedOrganization.value
    }

    const response = await axios.post(route('contracts.preview'), formData, {
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'text/html'
      }
    })

    previewHtml.value = response.data
  } catch (error) {
    console.error('Error loading preview:', error)
    previewError.value = error.response?.data?.message || 'Failed to load preview'
  } finally {
    isLoadingPreview.value = false
  }
}

// Watch for form changes and auto-refresh preview
let debounceTimeout = null
watch(() => [form.data(), selectedOrganization.value], () => {
  // Debounce the preview refresh to avoid too many requests
  if (debounceTimeout) {
    clearTimeout(debounceTimeout)
  }
  debounceTimeout = setTimeout(() => {
    if (showPreview.value) {
      refreshPreview()
    }
  }, 1000) // 1 second debounce
}, { deep: true })

// Form update handler
const updateForm = (newFormData) => {
  console.log('updateForm called with:', newFormData)

  Object.keys(newFormData).forEach(key => {
    if (key in form) {
      form[key] = newFormData[key]
    }
  })

  console.log('Form state after update:', {
    organization: form.organization,
    schoolData: form.schoolData,
    services: form.services
  })
}

// Form actions
const submitForm = () => {
  console.log('submitForm called with form data:', {
    organization: form.organization,
    schoolData: form.schoolData,
    services: form.services,
    allFormData: form.data()
  })

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

<style>
/* Estilos específicos para el contenido del preview */
.contract-preview-content {
  /* Asegurar que el contenido del blade se muestre correctamente */
  line-height: 1.5;
}

.contract-preview-content * {
  /* Reset de estilos que puedan interferir */
  box-sizing: border-box;
}

/* Si tu blade usa estilos específicos, puedes agregarlos aquí */
.contract-preview-content .contract-header {
  /* Estilos para headers */
}

.contract-preview-content .contract-body {
  /* Estilos para el cuerpo del contrato */
}
</style>