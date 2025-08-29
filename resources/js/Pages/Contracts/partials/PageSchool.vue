<template>
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
            :checked="modelValue.includes(page.id)"
            @change="onPageSelectionChange(page.id, $event.target.checked)"
            class="h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
          />
          <span class="ml-3 text-sm text-gray-700">{{ page.label }}</span>
        </label>
      </div>
      
      <div v-if="modelValue.length > 0" class="mt-4 p-3 bg-blue-50 rounded-lg">
        <p class="text-sm text-blue-800">
          <span class="font-medium">{{ modelValue.length }}</span> página(s) seleccionada(s)
        </p>
      </div>
    </div>
  </template>
  
  <script setup>
  import { defineEmits, defineProps } from 'vue'
  
  const props = defineProps({
    modelValue: {
      type: Array,
      default: () => ['pagina1']
    }
  })
  
  const emit = defineEmits(['update:modelValue', 'pages-changed'])
  
  // Páginas disponibles específicas para School
  const availablePages = [

    { id: 'pagina1', label: 'Página 1 - Services Agreement (1)' },
    { id: 'pagina2', label: 'Página 2 - Services Agreement (2)' },
    { id: 'pagina3', label: 'Página 3 - Services Agreement (3) ' },
    { id: 'pagina4', label: 'Página 4 - Indemnification' },
    { id: 'pagina5', label: 'Página 5 - Notices' },
    { id: 'pagina6', label: 'Página 6 - Miscellaneous' },
    { id: 'pagina7', label: 'Página 7 - Terms Of Agreement' },
    { id: 'pagina8', label: 'Página 8 - Optional Provision (1)' },
    { id: 'pagina9', label: 'Página 9 - Optional Provision (2)' },
    { id: 'pagina10', label: 'Página 10 - Optional Provision (3)' },
    { id: 'pagina11', label: 'Página 11 - Optional Provision (4)' },
    { id: 'pagina12', label: 'Página 12 - Services Areas' },
    { id: 'pagina13', label: 'Página 13 - Services Scope' },
    { id: 'pagina16', label: 'Página 16 - Facturación' },
    { id: 'pagina19', label: 'Página 19 - Anexos' },
    { id: 'pagina20', label: 'Página 20 - Firmas' }
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
    
    emit('update:modelValue', newValue)
    emit('pages-changed', newValue)
  }
  
  const selectAllPages = () => {
    const allPageIds = availablePages.map(p => p.id)
    emit('update:modelValue', allPageIds)
    emit('pages-changed', allPageIds)
  }
  
  const selectNoPages = () => {
    emit('update:modelValue', [])
    emit('pages-changed', [])
  }
  </script>