<!-- /Users/chantyheras/Documents/GitHub/contracts/resources/js/Pages/Contracts/partials/ContractLayout.vue -->
<template>
    <div class="breakout-container">
      <div class="max-w-none w-screen relative left-1/2 right-1/2 -ml-[50vw] -mr-[50vw]">
        <div class="min-h-screen bg-gray-50">
          <div class="max-w-[1600px] mx-auto px-6 sm:px-8 lg:px-12 py-10">
  
            <!-- Header -->
            <div class="mb-10">
              <div class="flex items-center justify-between">
                <div>
                  <h1 class="text-4xl font-bold text-gray-900">{{ title }}</h1>
                  <p class="text-lg text-gray-600 mt-3">{{ subtitle }}</p>
                </div>
                
                <!-- Header Right Slot -->
                <div v-if="$slots.headerRight">
                  <slot name="headerRight"></slot>
                </div>
              </div>
            </div>
  
            <!-- Mobile Toggle Button -->
            <div class="lg:hidden mb-6">
              <button @click="toggleMobilePreview"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl flex items-center justify-center space-x-3 transition-colors duration-200 text-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <span>{{ showPreview ? 'Hide Preview' : 'Show Preview' }}</span>
              </button>
            </div>
  
            <div class="lg:grid lg:gap-12" :style="gridColumns">
              
              <!-- Left Section (Form/Content) -->
              <div :class="{ 'block': !showPreview || !isMobile, 'hidden': showPreview && isMobile }" class="space-y-8">
                <slot name="leftContent"></slot>
              </div>
  
              <!-- Right Section (Preview) -->
              <div :class="{ 'block': !isMobile || showPreview, 'hidden': isMobile && !showPreview }">
                <div class="sticky top-8">
                  <!-- Preview Header -->
                  <div class="bg-white rounded-t-xl shadow-sm border border-gray-200 px-8 py-6">
                    <div class="flex items-center justify-between">
                      <div class="flex items-center space-x-4">
                        <svg class="w-7 h-7 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900">{{ previewTitle }}</h3>
                        
                        <!-- Preview Badge Slot -->
                        <div v-if="$slots.previewBadge">
                          <slot name="previewBadge"></slot>
                        </div>
                      </div>
                                                 
                      <button @click="togglePreview"
                        class="hidden lg:block text-gray-400 hover:text-gray-600 p-3 rounded-xl hover:bg-gray-100 transition-colors duration-200">
                        <svg v-if="!showPreview" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L9.878 9.878zM12.878 4.878L12.878 4.878z" />
                        </svg>
                      </button>
                    </div>
                  </div>
  
                  <!-- Preview Content -->
                  <div v-show="showPreview" class="bg-gray-100 border-l border-r border-b border-gray-200 rounded-b-xl p-6 w-full"
                       :style="{ height: previewHeight }">
                    
                    <!-- Loading State -->
                    <div v-if="isLoading" class="flex items-center justify-center h-full">
                      <div class="text-center">
                        <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-blue-600 mx-auto mb-4"></div>
                        <p class="text-gray-600">{{ loadingText }}</p>
                      </div>
                    </div>
                    
                    <!-- Error State -->
                    <div v-else-if="hasError" class="p-6 bg-red-50 border border-red-200 rounded-xl text-red-700">
                      <h4 class="font-semibold mb-3 text-lg">{{ errorTitle }}</h4>
                      <p class="mb-4">{{ errorMessage }}</p>
                      <button v-if="onRetry" @click="onRetry" 
                              class="px-4 py-2 bg-red-100 hover:bg-red-200 rounded-lg transition-colors">
                        {{ retryText }}
                      </button>
                    </div>
                    
                    <!-- Content Slot -->
                    <div v-else-if="$slots.previewContent" class="overflow-y-auto h-full">
                      <slot name="previewContent"></slot>
                    </div>
                    
                    <!-- Empty State -->
                    <div v-else class="flex items-center justify-center h-full text-gray-500">
                      <div class="text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="text-lg">{{ emptyStateText }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, computed, onMounted, onUnmounted } from 'vue'
  
  const props = defineProps({
    // Layout props
    title: {
      type: String,
      default: 'Title'
    },
    subtitle: {
      type: String,
      default: 'Subtitle'
    },
    previewTitle: {
      type: String,
      default: 'Preview'
    },
    gridColumns: {
      type: String,
      default: 'grid-template-columns: 1fr 1.3fr'
    },
    previewHeight: {
      type: String,
      default: '750px'
    },
    
    // Preview states
    isLoading: {
      type: Boolean,
      default: false
    },
    hasError: {
      type: Boolean,
      default: false
    },
    errorMessage: {
      type: String,
      default: 'Ha ocurrido un error'
    },
    errorTitle: {
      type: String,
      default: 'Error'
    },
    loadingText: {
      type: String,
      default: 'Cargando...'
    },
    retryText: {
      type: String,
      default: 'Reintentar'
    },
    emptyStateText: {
      type: String,
      default: 'No hay contenido para mostrar'
    },
    
    // Preview control
    initialShowPreview: {
      type: Boolean,
      default: true
    }
  })
  
  const emit = defineEmits(['toggle-preview', 'retry'])
  
  // Estados reactivos
  const showPreview = ref(props.initialShowPreview)
  const isMobile = ref(false)
  
  // Función para detectar mobile
  const checkMobile = () => {
    isMobile.value = window.innerWidth < 1024
    if (isMobile.value) showPreview.value = false
  }
  
  onMounted(() => {
    checkMobile()
    window.addEventListener('resize', checkMobile)
  })
  
  onUnmounted(() => {
    window.removeEventListener('resize', checkMobile)
  })
  
  // Methods
  const togglePreview = () => {
    showPreview.value = !showPreview.value
    emit('toggle-preview', showPreview.value)
  }
  
  const toggleMobilePreview = () => {
    showPreview.value = !showPreview.value
    emit('toggle-preview', showPreview.value)
  }
  
  const onRetry = () => {
    emit('retry')
  }
  
  // Expose internal state
  defineExpose({
    showPreview,
    isMobile
  })
  </script>
  
  <style scoped>
  /* Breakout container para escapar de los límites del LayoutMain */
  .breakout-container {
    width: 100vw;
    position: relative;
    left: 50%;
    right: 50%;
    margin-left: -50vw;
    margin-right: -50vw;
    margin-top: -2rem;
    margin-bottom: -2rem;
  }
  
  /* Responsive: en mobile volver al comportamiento normal */
  @media (max-width: 1024px) {
    .breakout-container {
      width: 100%;
      position: static;
      left: auto;
      right: auto;
      margin-left: auto;
      margin-right: auto;
      margin-top: 0;
      margin-bottom: 0;
    }
  }
  
  /* Mejor scroll para el contenido */
  :deep(.overflow-y-auto) {
    scrollbar-width: thin;
    scrollbar-color: #cbd5e1 #f1f5f9;
  }
  
  :deep(.overflow-y-auto)::-webkit-scrollbar {
    width: 6px;
  }
  
  :deep(.overflow-y-auto)::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 3px;
  }
  
  :deep(.overflow-y-auto)::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
  }
  
  :deep(.overflow-y-auto)::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
  }
  </style>