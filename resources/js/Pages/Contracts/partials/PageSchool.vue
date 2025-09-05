<template>
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <div class="flex items-center justify-between mb-4">
      <h3 class="text-lg font-semibold text-gray-900">Seleccionar Páginas</h3>
      <div class="flex flex-wrap gap-2">
        <button 
          @click="selectAllPages" 
          class="text-xs px-3 py-1 bg-blue-100 text-blue-700 rounded-full hover:bg-blue-200 transition-colors"
        >
          Todas
        </button>
        <button 
          @click="selectNoPages" 
          class="text-xs px-3 py-1 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-colors"
        >
          Ninguna
        </button>
      </div>
    </div>
    
    <div class="space-y-2 max-h-64 overflow-y-auto">
      <!-- Página 00 -->
      <label class="flex items-center hover:bg-gray-50 p-2 rounded-lg cursor-pointer transition-colors">
        <input 
          type="checkbox" 
          value="pagina00"
          :checked="modelValue.includes('pagina00')"
          @change="onPageSelectionChange('pagina00', $event.target.checked)"
          class="h-4 w-4 text-orange-600 rounded border-gray-300 focus:ring-orange-500"
        />
        <span class="ml-3 text-sm text-gray-700">Portada</span>
      </label>

      <!-- Página 0 -->
      <label class="flex items-center hover:bg-gray-50 p-2 rounded-lg cursor-pointer transition-colors">
        <input 
          type="checkbox" 
          value="pagina0"
          :checked="modelValue.includes('pagina0')"
          @change="onPageSelectionChange('pagina0', $event.target.checked)"
          class="h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
        />
        <span class="ml-3 text-sm text-gray-700">Thanksyou</span>
      </label>

      <!-- Grupo Estructura (Páginas 1-11) -->
      <div class="border border-gray-200 rounded-lg">
        <!-- Header del grupo -->
        <div 
          @click="toggleStructureGroup" 
          class="flex items-center justify-between p-3 hover:bg-gray-50 cursor-pointer transition-colors border-b border-gray-200"
        >
          <div class="flex items-center">
            <svg 
              :class="['w-4 h-4 text-gray-500 transition-transform', { 'rotate-90': isStructureExpanded }]" 
              fill="none" 
              stroke="currentColor" 
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="ml-2 text-sm font-medium text-gray-900">Estructura</span>
            <span class="ml-2 text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">
              {{ getSelectedStructurePages().length }}/{{ structurePages.length }}
            </span>
          </div>
          <button 
            @click.stop="selectStructurePages"
            class="text-xs px-2 py-1 bg-green-50 text-green-700 rounded hover:bg-green-100 transition-colors"
          >
            Seleccionar todas
          </button>
        </div>

        <!-- Contenido del grupo (páginas 1-11) -->
        <div v-show="isStructureExpanded" class="p-2 bg-gray-50">
          <div class="space-y-1">
            <label 
              v-for="page in structurePages" 
              :key="page.id" 
              class="flex items-center hover:bg-white p-2 rounded cursor-pointer transition-colors ml-4"
            >
              <input 
                type="checkbox" 
                :value="page.id"
                :checked="modelValue.includes(page.id)"
                @change="onPageSelectionChange(page.id, $event.target.checked)"
                class="h-4 w-4 text-green-600 rounded border-gray-300 focus:ring-green-500"
              />
              <span class="ml-3 text-sm text-gray-700">{{ page.label }}</span>
            </label>
          </div>
        </div>
      </div>

      <!-- Grupo Information Services (Páginas 12-16) -->
      <div class="border border-gray-200 rounded-lg">
        <!-- Header del grupo -->
        <div 
          @click="toggleInformationGroup" 
          class="flex items-center justify-between p-3 hover:bg-gray-50 cursor-pointer transition-colors border-b border-gray-200"
        >
          <div class="flex items-center">
            <svg 
              :class="['w-4 h-4 text-gray-500 transition-transform', { 'rotate-90': isInformationExpanded }]" 
              fill="none" 
              stroke="currentColor" 
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="ml-2 text-sm font-medium text-gray-900">Information Services</span>
            <span class="ml-2 text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">
              {{ getSelectedInformationPages().length }}/{{ informationPages.length }}
            </span>
          </div>
          <button 
            @click.stop="selectInformationPages"
            class="text-xs px-2 py-1 bg-blue-50 text-blue-700 rounded hover:bg-blue-100 transition-colors"
          >
            Seleccionar todas
          </button>
        </div>

        <!-- Contenido del grupo information services -->
        <div v-show="isInformationExpanded" class="p-2 bg-gray-50">
          <div class="space-y-1">
            <label 
              v-for="page in informationPages" 
              :key="page.id" 
              class="flex items-center hover:bg-white p-2 rounded cursor-pointer transition-colors ml-4"
            >
              <input 
                type="checkbox" 
                :value="page.id"
                :checked="modelValue.includes(page.id)"
                @change="onPageSelectionChange(page.id, $event.target.checked)"
                class="h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
              />
              <span class="ml-3 text-sm text-gray-700">{{ page.label }}</span>
            </label>
          </div>
        </div>
      </div>

      <!-- Grupo Chemical (Páginas 19-21) -->
      <div class="border border-gray-200 rounded-lg">
        <!-- Header del grupo -->
        <div 
          @click="toggleChemicalGroup" 
          class="flex items-center justify-between p-3 hover:bg-gray-50 cursor-pointer transition-colors border-b border-gray-200"
        >
          <div class="flex items-center">
            <svg 
              :class="['w-4 h-4 text-gray-500 transition-transform', { 'rotate-90': isChemicalExpanded }]" 
              fill="none" 
              stroke="currentColor" 
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="ml-2 text-sm font-medium text-gray-900">Chemical</span>
            <span class="ml-2 text-xs bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full">
              {{ getSelectedChemicalPages().length }}/{{ chemicalPages.length }}
            </span>
          </div>
          <button 
            @click.stop="selectChemicalPages"
            class="text-xs px-2 py-1 bg-purple-50 text-purple-700 rounded hover:bg-purple-100 transition-colors"
          >
            Seleccionar todas
          </button>
        </div>

        <!-- Contenido del grupo chemical -->
        <div v-show="isChemicalExpanded" class="p-2 bg-gray-50">
          <div class="space-y-1">
            <label 
              v-for="page in chemicalPages" 
              :key="page.id" 
              class="flex items-center hover:bg-white p-2 rounded cursor-pointer transition-colors ml-4"
            >
              <input 
                type="checkbox" 
                :value="page.id"
                :checked="modelValue.includes(page.id)"
                @change="onPageSelectionChange(page.id, $event.target.checked)"
                class="h-4 w-4 text-purple-600 rounded border-gray-300 focus:ring-purple-500"
              />
              <span class="ml-3 text-sm text-gray-700">{{ page.label }}</span>
            </label>
          </div>
        </div>
      </div>

      <!-- Grupo Exhibit (Páginas 22-25) -->
      <div class="border border-gray-200 rounded-lg">
        <!-- Header del grupo -->
        <div 
          @click="toggleExhibitGroup" 
          class="flex items-center justify-between p-3 hover:bg-gray-50 cursor-pointer transition-colors border-b border-gray-200"
        >
          <div class="flex items-center">
            <svg 
              :class="['w-4 h-4 text-gray-500 transition-transform', { 'rotate-90': isExhibitExpanded }]" 
              fill="none" 
              stroke="currentColor" 
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="ml-2 text-sm font-medium text-gray-900">Exhibit</span>
            <span class="ml-2 text-xs bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full">
              {{ getSelectedExhibitPages().length }}/{{ exhibitPages.length }}
            </span>
          </div>
          <button 
            @click.stop="selectExhibitPages"
            class="text-xs px-2 py-1 bg-amber-50 text-amber-700 rounded hover:bg-amber-100 transition-colors"
          >
            Seleccionar todas
          </button>
        </div>

        <!-- Contenido del grupo exhibit -->
        <div v-show="isExhibitExpanded" class="p-2 bg-gray-50">
          <div class="space-y-1">
            <label 
              v-for="page in exhibitPages" 
              :key="page.id" 
              class="flex items-center hover:bg-white p-2 rounded cursor-pointer transition-colors ml-4"
            >
              <input 
                type="checkbox" 
                :value="page.id"
                :checked="modelValue.includes(page.id)"
                @change="onPageSelectionChange(page.id, $event.target.checked)"
                class="h-4 w-4 text-amber-600 rounded border-gray-300 focus:ring-amber-500"
              />
              <span class="ml-3 text-sm text-gray-700">{{ page.label }}</span>
            </label>
          </div>
        </div>
      </div>

      <!-- Página 26 - Términos de Confidencia -->
      <label class="flex items-center hover:bg-gray-50 p-2 rounded-lg cursor-pointer transition-colors">
        <input 
          type="checkbox" 
          value="pagina26"
          :checked="modelValue.includes('pagina26')"
          @change="onPageSelectionChange('pagina26', $event.target.checked)"
          class="h-4 w-4 text-red-600 rounded border-gray-300 focus:ring-red-500"
        />
        <span class="ml-3 text-sm text-gray-700">Página 26 - Términos de Confidencia</span>
      </label>
    </div>
  </div>
</template>

<script setup>
import { defineEmits, defineProps, ref, computed } from 'vue'

const props = defineProps({
  modelValue: {
    type: Array,
    default: () => ['pagina00']
  }
})

const emit = defineEmits(['update:modelValue', 'pages-changed'])

// Estado para controlar si los grupos están expandidos
const isStructureExpanded = ref(true)
const isInformationExpanded = ref(true)
const isChemicalExpanded = ref(true)
const isExhibitExpanded = ref(true)

// Páginas de estructura (1-11)
const structurePages = [
  { id: 'pagina1', label: 'Página 1 - Services Agreement (1)' },
  { id: 'pagina2', label: 'Página 2 - Services Agreement (2)' },
  { id: 'pagina3', label: 'Página 3 - Services Agreement (3)' },
  { id: 'pagina4', label: 'Página 4 - Indemnification' },
  { id: 'pagina5', label: 'Página 5 - Notices' },
  { id: 'pagina6', label:'Página 6 - Miscellaneous' },
  { id: 'pagina7', label: 'Página 7 - Terms Of Agreement' },
  { id: 'pagina8', label: 'Página 8 - Optional Provision (1)' },
  { id: 'pagina9', label: 'Página 9 - Optional Provision (2)' },
  { id: 'pagina10', label: 'Página 10 - Optional Provision (3)' },
  { id: 'pagina11', label: 'Página 11 - Optional Provision (4)' }
]

// Páginas information services (12-16)
const informationPages = [
  { id: 'pagina12', label: 'Página 12 - Services Areas' },
  { id: 'pagina13', label: 'Página 13 - Services Scope' },
  { id: 'pagina14', label: 'Página 14 - Services Scope' },
  { id: 'pagina16', label: 'Página 16 - Facturación' }
]

// Páginas chemical (19-21)
const chemicalPages = [
  { id: 'pagina19', label: 'Página 19 - Chemical' },
  { id: 'pagina20', label: 'Página 20 - Chemical (2)' },
  { id: 'pagina21', label: 'Página 21 - Chemical (3)' }
]

// Páginas exhibit (22-25)
const exhibitPages = [
  { id: 'pagina22', label: 'Página 22 - Exhibit (A)' },
  { id: 'pagina23', label: 'Página 23 - Exhibit (B)' },
  { id: 'pagina24', label: 'Página 24 - Exhibit (C)' },
  { id: 'pagina25', label: 'Página 25 - Exhibit (D)' }
]

// Todas las páginas combinadas (incluyendo páginas 00, 0 y 26)
const allPages = [
  { id: 'pagina00', label: 'Página 00 - Portada' },
  { id: 'pagina0', label: 'Página 0 - Introducción' },
  ...structurePages,
  ...informationPages,
  ...chemicalPages,
  ...exhibitPages,
  { id: 'pagina26', label: 'Página 26 - Términos de Confidencia' }
]

const onPageSelectionChange = (pageId, isChecked) => {
  let newValue = [...props.modelValue]
  
  if (isChecked) {
    if (!newValue.includes(pageId)) {
      newValue.push(pageId)
    }
  } else {
    newValue = newValue.filter(id => id !== pageId)
  }
  
  // Ordenar según el orden original de las páginas
  const orderedValue = sortPagesByOriginalOrder(newValue)
  
  emit('update:modelValue', orderedValue)
  emit('pages-changed', orderedValue)
}

const selectAllPages = () => {
  const allPageIds = allPages.map(p => p.id)
  emit('update:modelValue', allPageIds)
  emit('pages-changed', allPageIds)
}

const selectNoPages = () => {
  emit('update:modelValue', [])
  emit('pages-changed', [])
}

// Función para seleccionar solo las páginas de estructura (1-11)
const selectStructurePages = () => {
  const structureIds = structurePages.map(p => p.id)
  const otherSelectedPages = props.modelValue.filter(id => !structureIds.includes(id))
  const newValue = [...structureIds, ...otherSelectedPages]
  
  // Ordenar según el orden original
  const orderedValue = sortPagesByOriginalOrder(newValue)
  
  emit('update:modelValue', orderedValue)
  emit('pages-changed', orderedValue)
}

// Función para seleccionar solo las páginas information services
const selectInformationPages = () => {
  const informationIds = informationPages.map(p => p.id)
  const otherSelectedPages = props.modelValue.filter(id => !informationIds.includes(id))
  const newValue = [...informationIds, ...otherSelectedPages]
  
  // Ordenar según el orden original
  const orderedValue = sortPagesByOriginalOrder(newValue)
  
  emit('update:modelValue', orderedValue)
  emit('pages-changed', orderedValue)
}

// Función para seleccionar/deseleccionar las páginas chemical
const selectChemicalPages = () => {
  const chemicalIds = chemicalPages.map(p => p.id)
  const selectedChemicalPages = getSelectedChemicalPages()
  
  // Si todas están seleccionadas, deseleccionar todas
  if (selectedChemicalPages.length === chemicalPages.length) {
    const newValue = props.modelValue.filter(id => !chemicalIds.includes(id))
    const orderedValue = sortPagesByOriginalOrder(newValue)
    emit('update:modelValue', orderedValue)
    emit('pages-changed', orderedValue)
  } else {
    // Si no todas están seleccionadas, seleccionar todas
    const otherSelectedPages = props.modelValue.filter(id => !chemicalIds.includes(id))
    const newValue = [...chemicalIds, ...otherSelectedPages]
    const orderedValue = sortPagesByOriginalOrder(newValue)
    emit('update:modelValue', orderedValue)
    emit('pages-changed', orderedValue)
  }
}

// Función para seleccionar/deseleccionar las páginas exhibit
const selectExhibitPages = () => {
  const exhibitIds = exhibitPages.map(p => p.id)
  const selectedExhibitPages = getSelectedExhibitPages()
  
  // Si todas están seleccionadas, deseleccionar todas
  if (selectedExhibitPages.length === exhibitPages.length) {
    const newValue = props.modelValue.filter(id => !exhibitIds.includes(id))
    const orderedValue = sortPagesByOriginalOrder(newValue)
    emit('update:modelValue', orderedValue)
    emit('pages-changed', orderedValue)
  } else {
    // Si no todas están seleccionadas, seleccionar todas
    const otherSelectedPages = props.modelValue.filter(id => !exhibitIds.includes(id))
    const newValue = [...exhibitIds, ...otherSelectedPages]
    const orderedValue = sortPagesByOriginalOrder(newValue)
    emit('update:modelValue', orderedValue)
    emit('pages-changed', orderedValue)
  }
}

// Función para ordenar las páginas según su orden original
const sortPagesByOriginalOrder = (selectedIds) => {
  const pageOrder = allPages.map(p => p.id)
  
  return selectedIds.sort((a, b) => {
    const indexA = pageOrder.indexOf(a)
    const indexB = pageOrder.indexOf(b)
    return indexA - indexB
  })
}

// Función para alternar la expansión del grupo estructura
const toggleStructureGroup = () => {
  isStructureExpanded.value = !isStructureExpanded.value
}

// Función para alternar la expansión del grupo information services
const toggleInformationGroup = () => {
  isInformationExpanded.value = !isInformationExpanded.value
}

// Función para alternar la expansión del grupo chemical
const toggleChemicalGroup = () => {
  isChemicalExpanded.value = !isChemicalExpanded.value
}

// Función para alternar la expansión del grupo exhibit
const toggleExhibitGroup = () => {
  isExhibitExpanded.value = !isExhibitExpanded.value
}

// Función para obtener las páginas de estructura seleccionadas
const getSelectedStructurePages = () => {
  const structureIds = structurePages.map(p => p.id)
  return props.modelValue.filter(id => structureIds.includes(id))
}

// Función para obtener las páginas information services seleccionadas
const getSelectedInformationPages = () => {
  const informationIds = informationPages.map(p => p.id)
  return props.modelValue.filter(id => informationIds.includes(id))
}

// Función para obtener las páginas chemical seleccionadas
const getSelectedChemicalPages = () => {
  const chemicalIds = chemicalPages.map(p => p.id)
  return props.modelValue.filter(id => chemicalIds.includes(id))
}

// Función para obtener las páginas exhibit seleccionadas
const getSelectedExhibitPages = () => {
  const exhibitIds = exhibitPages.map(p => p.id)
  return props.modelValue.filter(id => exhibitIds.includes(id))
}
</script>