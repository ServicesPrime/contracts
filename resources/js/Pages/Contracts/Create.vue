<template>
  <LayoutMain>
    <!-- Organization Selector -->
    <OrganizationSelector v-if="!isEditing && !selectedOrganization"
      @organization-selected="handleOrganizationSelected" />

    <!-- Fixed Preview Layout -->
    <FixedPreviewLayout v-else
      :title="isEditing ? 'Edit Contract' : 'Create New Contract'"
      :subtitle="`Fill in the information below to ${isEditing ? 'update' : 'create'} a contract`"
      preview-title="Contract Preview"
      :is-loading="isLoadingPreview"
      :has-error="!!previewError"
      :error-message="previewError"
      :preview-html="previewHtml"
      :empty-state-text="isSchoolOrganization ? 'Selecciona páginas para ver el preview' : 'Preview del contrato'"
      :show-draft-button="!isEditing"
      :is-processing="form.processing"
      :submit-button-text="isEditing ? 'Update Contract' : 'Create Contract'"
      @refresh="refreshPreview"
      @cancel="goBack"
      @submit="submitForm">
      
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
          @update:services="val => (form.services = val)" />
        
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

    </FixedPreviewLayout>
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
import ServicesSection from "@/Pages/Contracts/partials/ServicesSection.vue"
import FixedPreviewLayout from "./partials/FixedPreviewLayout.vue"

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
const selectedPages = ref(['pagina00'])

// Timeouts
let formDebounceTimeout = null

onMounted(() => {
  // Initialize organization if editing
  if (isEditing.value && props.contract?.organization) {
    selectedOrganization.value = props.contract.organization
    form.organization = props.contract.organization
  }
  
  // Initialize pages if editing and is school organization
  if (isEditing.value && props.contract?.pages) {
    selectedPages.value = props.contract.pages
  }
  
  // Initial preview load if needed
  if (selectedOrganization.value && (!isSchoolOrganization.value || selectedPages.value.length > 0)) {
    refreshPreview()
  }
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
  organization: props.contract?.organization || null,
  pages: props.contract?.pages || [],
  schoolData: props.contract?.schoolData || {}
})

// Método centralizado para preparar datos
const prepareFormData = () => {
  return {
    contract_number: form.contract_number,
    client_id: form.client_id,
    department: form.department,
    date: form.date,
    services: form.services,
    organization: selectedOrganization.value || '',
    pages: isSchoolOrganization.value ? selectedPages.value : [],
    schoolData: {
      pages: isSchoolOrganization.value ? selectedPages.value : [],
      organization: selectedOrganization.value
    }
  }
}

// Event handlers
const handleOrganizationSelected = (organization) => {
  selectedOrganization.value = organization
  form.organization = organization
  
  if (!isSchoolOrganization.value) {
    selectedPages.value = []
  } else {
    selectedPages.value = ['pagina00']
  }
}

const onPageSelectionChange = (newPages) => {
  if (newPages.length > 0) {
    refreshPreview()
  }
}

// Preview refresh
const refreshPreview = async () => {
  if (isLoadingPreview.value) return
  if (isSchoolOrganization.value && selectedPages.value.length === 0) return

  isLoadingPreview.value = true
  previewError.value = null

  try {
    const requestData = prepareFormData()
    
    // Agregar contract_id para edición
    if (isEditing.value) {
      requestData.contract_id = props.contract.id
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
    console.error('Preview error:', error)
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
watch(() => [form.data(), selectedOrganization.value, selectedPages.value], () => {
  if (formDebounceTimeout) clearTimeout(formDebounceTimeout)
  formDebounceTimeout = setTimeout(() => {
    if (!isSchoolOrganization.value || selectedPages.value.length > 0) {
      refreshPreview()
    }
  }, 1000)
}, { deep: true })

// Form actions
const submitForm = () => {
  const formData = prepareFormData()
  
  // Actualizar el form con todos los datos preparados
  Object.keys(formData).forEach(key => {
    if (key in form) {
      form[key] = formData[key]
    }
  })
  
  // Debug: mostrar los datos que se van a enviar
  console.log('Datos a enviar al store:', formData)
  
  if (isEditing.value) {
    form.put(route('contracts.update', props.contract.id), {
      onSuccess: () => {
        console.log('Contract updated successfully')
      },
      onError: (errors) => {
        console.error('Update errors:', errors)
      }
    })
  } else {
    form.post(route('contracts.store'), {
      onSuccess: () => {
        console.log('Contract created successfully')
      },
      onError: (errors) => {
        console.error('Creation errors:', errors)
      }
    })
  }
}

const goBack = () => {
  router.visit(route('contracts.index'))
}
</script>