<template>
  <LayoutMain>
    <!-- Organization Selector -->
    <OrganizationSelector v-if="!isEditing && !selectedOrganization"
      @organization-selected="handleOrganizationSelected" />

    <!-- Contract Form -->
    <div v-else class="min-h-screen bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header -->
        <div class="mb-8">
          <div class="flex items-center justify-between">
            <div>
              <h1 class="text-3xl font-bold text-gray-900">{{ isEditing ? 'Edit Contract' : 'Create New Contract' }}</h1>
              <p class="text-gray-600 mt-2">Fill in the information below to {{ isEditing ? 'update' : 'create' }} a contract</p>
            </div>
            <div v-if="!isEditing && selectedOrganization" class="text-right">
              <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium" :class="{
                'bg-blue-100 text-blue-800': selectedOrganization === 'school',
                'bg-green-100 text-green-800': selectedOrganization === 'jwo',
                'bg-purple-100 text-purple-800': selectedOrganization === 'general'
              }">
                <svg v-if="selectedOrganization === 'school'" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <svg v-else-if="selectedOrganization === 'jwo'" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <svg v-else class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                {{
                  selectedOrganization === 'school' ? 'School' :
                  selectedOrganization === 'jwo' ? 'JWO' : 'General Contract'
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
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <span>{{ showPreview ? 'Hide Preview' : 'Show Preview' }}</span>
          </button>
        </div>

        <div class="lg:grid lg:gap-8" style="grid-template-columns: 4.3fr 9fr;">
          
          <!-- Form Section -->
          <div :class="{ 'block': !showPreview || !isMobile, 'hidden': showPreview && isMobile }">
            <ContractInformationForm 
              :form="form" 
              :clients="clients" 
              :services="services" 
              :is-editing="isEditing"
              :selected-organization="selectedOrganization" 
              @update:form="updateForm" 
              @submit="submitForm"
              @cancel="goBack" />
            
            <!-- Page Selector Component -->
            <div class="mt-6">
              <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                  <h3 class="text-lg font-semibold text-gray-900">Seleccionar Páginas</h3>
                  <div class="flex space-x-2">
                    <button @click="selectAllPages" class="text-xs px-3 py-1 bg-blue-100 text-blue-700 rounded-full hover:bg-blue-200 transition-colors">
                      Todas
                    </button>
                    <button @click="selectNoPages" class="text-xs px-3 py-1 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-colors">
                      Ninguna
                    </button>
                  </div>
                </div>
                
                <div class="space-y-2 max-h-64 overflow-y-auto">
                  <label v-for="page in availablePages" :key="page.id" class="flex items-center hover:bg-gray-50 p-2 rounded-lg cursor-pointer">
                    <input 
                      type="checkbox" 
                      :value="page.id"
                      v-model="selectedPages"
                      @change="onPageSelectionChange"
                      class="h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                    />
                    <span class="ml-3 text-sm text-gray-700">{{ page.label }}</span>
                  </label>
                </div>
                
                <div v-if="selectedPages.length > 0" class="mt-4 p-3 bg-blue-50 rounded-lg">
                  <p class="text-sm text-blue-800">
                    <span class="font-medium">{{ selectedPages.length }}</span> página(s) seleccionada(s)
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- Preview Section -->
          <div :class="{ 'block': !isMobile || showPreview, 'hidden': isMobile && !showPreview }">
            <div class="sticky top-8">
              <!-- Preview Header -->
              <div class="bg-white rounded-t-xl shadow-sm border border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                  <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900">Contract Preview</h3>
                    <div v-if="selectedPages.length > 0" class="flex items-center text-sm text-blue-600 bg-blue-50 px-2 py-1 rounded-full">
                      {{ selectedPages.length }} página(s)
                    </div>
                  </div>
                                         
                  <button @click="showPreview = !showPreview"
                    class="hidden lg:block text-gray-400 hover:text-gray-600 p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <svg v-if="!showPreview" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L9.878 9.878zM12.878 4.878L12.878 4.878z" />
                    </svg>
                  </button>
                </div>
              </div>

              <!-- Preview Content -->
              <div v-show="showPreview" class="bg-gray-100 border-l border-r border-b border-gray-200 rounded-b-xl p-4 h-[600px] overflow-y-auto w-full">
                <div v-if="isLoadingPreview" class="flex items-center justify-center h-full">
                  <div class="text-center">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto mb-2"></div>
                    <p class="text-gray-600 text-sm">Cargando preview...</p>
                  </div>
                </div>
                
                <div v-else-if="previewError" class="p-4 bg-red-50 border border-red-200 rounded-lg text-red-700">
                  <h4 class="font-semibold mb-2">Error al cargar preview:</h4>
                  <p class="text-sm">{{ previewError }}</p>
                  <button @click="refreshPreview" class="mt-2 px-3 py-1 bg-red-100 hover:bg-red-200 rounded text-sm">
                    Reintentar
                  </button>
                </div>
                
                <div v-else-if="previewHtml" class="contract-preview-content bg-white rounded border" v-html="previewHtml"></div>
                
                <div v-else class="flex items-center justify-center h-full text-gray-500">
                  <p>Selecciona páginas para ver el preview</p>
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
import { ref, computed, onMounted, onUnmounted, watch } from 'vue'
import { useForm, router } from '@inertiajs/vue3'
import axios from 'axios'
import LayoutMain from "@/Layouts/LayoutMain.vue"
import OrganizationSelector from "./partials/OrganizationSelector.vue"
import ContractInformationForm from "./partials/ContractInformationForm.vue"

const props = defineProps({
  contract: { type: Object, default: () => ({}) },
  clients: { type: Array, default: () => [] },
  services: { type: Array, default: () => [] },
  contractNumber: { type: String, default: '' }
})

// Estados reactivos
const showPreview = ref(true)
const isMobile = ref(false)
const selectedOrganization = ref(null)
const isLoadingPreview = ref(false)
const previewError = ref(null) 
const previewHtml = ref('')

// Páginas disponibles
const availablePages = [
  { id: 'pagina1', label: 'Página 1 - Introducción' },
  { id: 'pagina2', label: 'Página 2 - Términos' },
  { id: 'pagina3', label: 'Página 3 - Servicios' },
  { id: 'pagina4', label: 'Página 4 - Precios' },
  { id: 'pagina5', label: 'Página 5 - Condiciones' },
  { id: 'pagina6', label: 'Página 6 - Responsabilidades' },
  { id: 'pagina7', label: 'Página 7 - Horarios' },
  { id: 'pagina8', label: 'Página 8 - Equipamiento' },
  { id: 'pagina9', label: 'Página 9 - Personal' },
  { id: 'pagina10', label: 'Página 10 - Calidad' },
  { id: 'pagina11', label: 'Página 11 - Seguridad' },
  { id: 'pagina12', label: 'Página 12 - Emergencias' },
  { id: 'pagina13', label: 'Página 13 - Comunicación' },
  { id: 'pagina16', label: 'Página 16 - Facturación' },
  { id: 'pagina19', label: 'Página 19 - Anexos' },
  { id: 'pagina20', label: 'Página 20 - Firmas' }
]

// Estado de páginas seleccionadas
const selectedPages = ref(['pagina1'])

// Timeouts
let formDebounceTimeout = null

// Mobile detection
const checkMobile = () => {
  isMobile.value = window.innerWidth < 1024
  if (isMobile.value) showPreview.value = false
}

onMounted(() => {
  checkMobile()
  window.addEventListener('resize', checkMobile)
  if (showPreview.value) refreshPreview()
})

onUnmounted(() => {
  window.removeEventListener('resize', checkMobile)
  if (formDebounceTimeout) clearTimeout(formDebounceTimeout)
})

// Computed
const isEditing = computed(() => !!props.contract?.id)

// Form setup
const initializeServices = () => {
  if (isEditing.value && props.contract?.contract_services) {
    return props.contract.contract_services.map(cs => ({
      service_id: cs.service_id,
      quantity: cs.quantity,
      unit_price: cs.unit_price
    }))
  }
  return [{ service_id: '', quantity: '', unit_price: '' }]
}

const form = useForm({
  contract_number: isEditing.value ? props.contract?.contract_number : (props.contractNumber || ''),
  client_id: props.contract?.client_id || '',
  department: props.contract?.department || '',
  date: isEditing.value ? props.contract?.date : new Date().toISOString().split('T')[0],
  services: initializeServices(),
  organization: null,
  schoolData: {}
})

// Event handlers
const handleOrganizationSelected = (organization) => {
  selectedOrganization.value = organization
  form.organization = organization
}

const onPageSelectionChange = () => {
  if (showPreview.value && selectedPages.value.length > 0) {
    refreshPreview()
  }
}

const selectAllPages = () => {
  selectedPages.value = availablePages.map(p => p.id)
  onPageSelectionChange()
}

const selectNoPages = () => {
  selectedPages.value = []
  onPageSelectionChange()
}

// Preview refresh
const refreshPreview = async () => {
  if (isLoadingPreview.value || selectedPages.value.length === 0) return

  isLoadingPreview.value = true
  previewError.value = null

  try {
    const requestData = {
      pages: selectedPages.value,
      contract_number: form.contract_number,
      client_id: form.client_id,
      department: form.department,
      date: form.date,
      services: form.services,
      organization: selectedOrganization.value || '',
      contract_id: isEditing.value ? props.contract.id : ''
    }

    const response = await axios.post('/blade-preview', requestData, {
      headers: {
        'Accept': 'text/html',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
        'X-Requested-With': 'XMLHttpRequest'
      }
    })

    previewHtml.value = response.data

  } catch (error) {
    previewError.value = error.response?.data?.message || error.message || 'Error al cargar preview'
  } finally {
    isLoadingPreview.value = false
  }
}

const updateForm = (newFormData) => {
  Object.keys(newFormData).forEach(key => {
    if (key in form) form[key] = newFormData[key]
  })
}

// Watchers
watch(() => [form.data(), selectedOrganization.value], () => {
  if (formDebounceTimeout) clearTimeout(formDebounceTimeout)
  formDebounceTimeout = setTimeout(() => {
    if (showPreview.value && selectedPages.value.length > 0) {
      refreshPreview()
    }
  }, 1000)
}, { deep: true })

watch(showPreview, (newValue) => {
  if (newValue && selectedPages.value.length > 0) {
    refreshPreview()
  }
})

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

<style>
.contract-preview-content {
  line-height: 1.5;
}

.contract-preview-content * {
  box-sizing: border-box;
}
</style>