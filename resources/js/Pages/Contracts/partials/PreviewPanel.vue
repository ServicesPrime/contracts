<template>
    <div class="w-1/2 flex flex-col border-l border-gray-200 bg-white">
      <!-- Preview Header -->
      <div class="flex-shrink-0 px-6 py-4 border-b border-gray-200 bg-gray-50">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-3">
            <h2 class="text-lg font-semibold text-gray-900">{{ title }}</h2>
            <slot name="badge"></slot>
          </div>
          
          <!-- Refresh Button -->
          <button 
            @click="$emit('refresh')"
            :disabled="isLoading"
            class="flex items-center px-3 py-1.5 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
          >
            <svg class="w-4 h-4 mr-2" :class="{ 'animate-spin': isLoading }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            {{ isLoading ? 'Loading...' : 'Refresh' }}
          </button>
        </div>
      </div>
  
      <!-- Preview Content Area -->
      <div class="flex-1 overflow-y-auto">
        <!-- Loading State -->
        <div v-if="isLoading" class="flex items-center justify-center h-full">
          <div class="text-center">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
            <p class="mt-4 text-sm text-gray-600">Loading preview...</p>
          </div>
        </div>
  
        <!-- Error State -->
        <div v-else-if="hasError" class="flex items-center justify-center h-full">
          <div class="text-center max-w-md px-6">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L3.351 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
              </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Error loading preview</h3>
            <p class="text-sm text-gray-600 mb-4">{{ errorMessage }}</p>
            <button 
              @click="$emit('refresh')"
              class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors"
            >
              Retry
            </button>
          </div>
        </div>
  
        <!-- Empty State -->
        <div v-else-if="!previewHtml" class="flex items-center justify-center h-full">
          <div class="text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
            </div>
            <p class="text-sm text-gray-600">{{ emptyStateText }}</p>
          </div>
        </div>
  
        <!-- Preview Content -->
        <div v-else class="p-6">
          <div class="preview-content bg-white rounded-xl border p-6" v-html="previewHtml"></div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  defineProps({
    title: {
      type: String,
      default: 'Preview'
    },
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
      default: 'An error occurred'
    },
    previewHtml: {
      type: String,
      default: ''
    },
    emptyStateText: {
      type: String,
      default: 'No content to preview'
    }
  })
  
  defineEmits(['refresh'])
  </script>
  
  <style scoped>
  .preview-content {
    line-height: 1.6;
    font-size: 14px;
  }
  
  .preview-content :deep(*) {
    box-sizing: border-box;
  }
  
  .preview-content :deep(h1),
  .preview-content :deep(h2),
  .preview-content :deep(h3) {
    margin-top: 1.5rem;
    margin-bottom: 1rem;
    font-weight: 600;
  }
  
  .preview-content :deep(p) {
    margin-bottom: 1rem;
  }
  
  /* Custom scrollbar styling */
  .overflow-y-auto::-webkit-scrollbar {
    width: 8px;
  }
  
  .overflow-y-auto::-webkit-scrollbar-track {
    background: #f1f5f9;
  }
  
  .overflow-y-auto::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
  }
  
  .overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
  }
  </style>