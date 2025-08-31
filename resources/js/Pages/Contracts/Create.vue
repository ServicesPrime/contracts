<template>
  <LayoutMain>
    <!-- Organization Selector -->
    <OrganizationSelector v-if="!isEditing && !selectedOrganization"
      @organization-selected="handleOrganizationSelected" />

    <!-- Contract Form with Expanded Layout -->
    <ContractLayout v-else
      :title="isEditing ? 'Edit Contract' : 'Create New Contract'"
      :subtitle="`Fill in the information below to ${isEditing ? 'update' : 'create'} a contract`"
      preview-title="Contract Preview"
      :is-loading="isLoadingPreview"
      :has-error="!!previewError"
      :error-message="previewError"
      error-title="Error al cargar preview:"
      loading-text="Cargando preview..."
      retry-text="Reintentar"
      :empty-state-text="isSchoolOrganization ? 'Selecciona páginas para ver el preview' : 'Preview del contrato'"
      @toggle-preview="onTogglePreview"
      @retry="refreshPreview">
      
      <!-- Header Right Content -->
      <template #headerRight>
        <div v-if="!isEditing && selectedOrganization" class="text-right">
          <div class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium" :class="getOrganizationBadgeClass(selectedOrganization)">
            <component :is="getOrganizationIcon(selectedOrganization)" class="w-5 h-5 mr-2" />
            {{ getOrganizationLabel(selectedOrganization) }}
          </div>
          <button @click="selectedOrganization = null" class="text-sm text-gray-500 hover:text-gray-700 mt-2 block">
            Change Organization
          </button>
        </div>
      </template>

      <!-- Left Content (Forms) -->
      <template #leftContent>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
          <ContractInformationForm 
            :form="form" 
            :clients="clients" 
            :services="form.services"
            :is-editing="isEditing"
            :selected-organization="selectedOrganization" 
            @update:form="updateForm" 
            @submit="submitForm"
            @cancel="goBack" />
        </div>
        
        <ServicesSection
    :services="form.services"
  :available-services="services"
    :errors="form.errors"
    @update:services="val => (form.services = val)"
  />
        <!-- PageSchool Component - Only show for School organization -->
        <div v-if="isSchoolOrganization" class="bg-white rounded-xl shadow-sm border border-gray-200 p-8">
          <PageSchool 
            v-model="selectedPages"
            @pages-changed="onPageSelectionChange" />
        </div>
      </template>

      <!-- Preview Badge -->
      <template #previewBadge>
        <div v-if="isSchoolOrganization && selectedPages.length > 0" 
             class="flex items-center text-sm text-blue-600 bg-blue-50 px-3 py-1.5 rounded-full font-medium">
          {{ selectedPages.length }} página(s)
        </div>
      </template>

      <!-- Preview Content -->
      <template #previewContent>
        <div v-if="previewHtml" class="contract-preview-content bg-white rounded-xl border p-6" v-html="previewHtml"></div>
      </template>

    </ContractLayout>
  </LayoutMain>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, watch } from 'vue'
import { useForm, router } from '@inertiajs/vue3'
import axios from 'axios'
import LayoutMain from "@/Layouts/LayoutMain.vue"
import OrganizationSelector from "./partials/OrganizationSelector.vue"
import ContractInformationForm from "./partials/ContractInformationForm.vue"
import PageSchool from "./partials/PageSchool.vue"
import ContractLayout from "./partials/ContractLayout.vue"
import ServicesSection from "@/Pages/Contracts/partials/ServicesSection.vue"



const props = defineProps({
  contract: { type: Object, default: () => ({}) },
  clients: { type: Array, default: () => [] },
  services: { type: Array, default: () => [] },
  contractNumber: { type: String, default: '' }
})

// Estados reactivos
const selectedOrganization = ref(null)
const isLoadingPreview = ref(false)
const previewError = ref(null) 
const previewHtml = ref('')
const selectedPages = ref(['pagina1'])

// Timeouts
let formDebounceTimeout = null

onMounted(() => {
  // Initial preview load if needed
})

onUnmounted(() => {
  if (formDebounceTimeout) clearTimeout(formDebounceTimeout)
})

// Computed
const isEditing = computed(() => !!props.contract?.id)
const isSchoolOrganization = computed(() => {
  return selectedOrganization.value === 'janitorial-school' || 
         selectedOrganization.value === 'school'
})

// Organization helper functions
const getOrganizationBadgeClass = (org) => {
  if (org === 'jwo') return 'bg-green-100 text-green-800'
  if (org === 'janitorial-school' || org === 'school') return 'bg-blue-100 text-blue-800'
  if (org === 'staffing-hospitality') return 'bg-orange-100 text-orange-800'
  return 'bg-gray-100 text-gray-800'
}

const getOrganizationLabel = (org) => {
  switch (org) {
    case 'jwo': return 'JWO'
    case 'janitorial-school': return 'Janitorial - School'
    case 'staffing-hospitality': return 'Staffing - Hospitality'
    case 'school': return 'School'
    default: return org
  }
}

const getOrganizationIcon = (org) => {
  return 'svg' // Placeholder
}

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
  
  if (!isSchoolOrganization.value) {
    selectedPages.value = []
  } else {
    selectedPages.value = ['pagina1']
  }
}

const onPageSelectionChange = (newPages) => {
  if (newPages.length > 0) {
    refreshPreview()
  }
}

const onTogglePreview = (isVisible) => {
  if (isVisible) {
    if (!isSchoolOrganization.value || selectedPages.value.length > 0) {
      refreshPreview()
    }
  }
}

// Preview refresh
const refreshPreview = async () => {
  if (isLoadingPreview.value) return
  if (isSchoolOrganization.value && selectedPages.value.length === 0) return

  isLoadingPreview.value = true
  previewError.value = null

  try {
    const requestData = {
      pages: isSchoolOrganization.value ? selectedPages.value : [],
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
    if (!isSchoolOrganization.value || selectedPages.value.length > 0) {
      refreshPreview()
    }
  }, 1000)
}, { deep: true })


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
  line-height: 1.6;
  font-size: 14px;
}

.contract-preview-content * {
  box-sizing: border-box;
}

.contract-preview-content h1,
.contract-preview-content h2,
.contract-preview-content h3 {
  margin-top: 1.5rem;
  margin-bottom: 1rem;
  font-weight: 600;
}

.contract-preview-content p {
  margin-bottom: 1rem;
}
</style>