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
      <!-- Página 0 -->
      <label class="flex items-center hover:bg-gray-50 p-2 rounded-lg cursor-pointer transition-colors">
        <input 
          type="checkbox" 
          value="pagina0"
          :checked="modelValue.includes('pagina0')"
          @change="onPageSelectionChange('pagina0', $event.target.checked)"
          class="h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
        />
        <span class="ml-3 text-sm text-gray-700">Página 0 - Introducción</span>
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

      <!-- Páginas restantes (12, 13, 16, 19, 20) -->
      <div class="pt-2">
        <label 
          v-for="page in otherPages" 
          :key="page.id" 
          class="flex items-center hover:bg-gray-50 p-2 rounded-lg cursor-pointer transition-colors"
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
</template>

<script setup>
import { defineEmits, defineProps, ref, computed } from 'vue'

const props = defineProps({
  modelValue: {
    type: Array,
    default: () => ['pagina1']
  }
})

const emit = defineEmits(['update:modelValue', 'pages-changed'])

// Estado para controlar si el grupo estructura está expandido
const isStructureExpanded = ref(true)

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

// Páginas restantes
const otherPages = [
  { id: 'pagina12', label: 'Página 12 - Services Areas' },
  { id: 'pagina13', label: 'Página 13 - Services Scope' },
  { id: 'pagina14', label: 'Página 14 - Services Scope' },
  { id: 'pagina16', label: 'Página 16 - Facturación' },
  { id: 'pagina19', label: 'Página 19 - Anexos' },
  { id: 'pagina20', label: 'Página 20 - Firmas' }
]

// Todas las páginas combinadas (incluyendo página 0)
const allPages = [
  { id: 'pagina0', label: 'Página 0 - Introducción' },
  ...structurePages,
  ...otherPages
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

// Función para obtener las páginas de estructura seleccionadas
const getSelectedStructurePages = () => {
  const structureIds = structurePages.map(p => p.id)
  return props.modelValue.filter(id => structureIds.includes(id))
}
</script>