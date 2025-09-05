<template>
    <div class="fixed inset-0 flex flex-col bg-gray-50" style="left: 240px;">
      <!-- Header -->
      <div class="flex-shrink-0 bg-white border-b border-gray-200 px-6 py-4">
        <div class="flex items-center justify-between">
          <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ title }}</h1>
            <p class="text-sm text-gray-600 mt-1">{{ subtitle }}</p>
          </div>
          
          <!-- Header Right Content -->
          <div v-if="$slots.headerRight">
            <slot name="headerRight"></slot>
          </div>
        </div>
      </div>
  
      <!-- Main Content Area - Fixed Height with Scroll -->
      <div class="flex-1 flex overflow-hidden">
        
        <!-- Left Panel - Forms (Scrollable) -->
        <div class="w-1/2 overflow-y-auto p-6 space-y-6">
          <slot name="leftContent"></slot>
          <!-- Bottom Spacing -->
          <div class="h-20"></div>
        </div>
  
        <!-- Right Panel - Preview (Fixed) -->
        <PreviewPanel 
          :title="previewTitle"
          :is-loading="isLoading"
          :has-error="hasError"
          :error-message="errorMessage"
          :preview-html="previewHtml"
          :empty-state-text="emptyStateText"
          @refresh="$emit('refresh')">
          
          <template #badge>
            <slot name="previewBadge"></slot>
          </template>
        </PreviewPanel>
      </div>
  
      <!-- Bottom Action Bar -->
      <div class="flex-shrink-0 bg-white border-t border-gray-200 px-6 py-4">
        <slot name="actionBar">
          <div class="flex items-center justify-between">
            <button 
              @click="$emit('cancel')"
              class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
            >
              Cancel
            </button>
            
            <div class="flex items-center space-x-3">
              <button 
                v-if="showDraftButton"
                type="button"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors"
              >
                Save as Draft
              </button>
              <button 
                @click="$emit('submit')"
                :disabled="isProcessing"
                class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
              >
                {{ isProcessing ? 'Processing...' : submitButtonText }}
              </button>
            </div>
          </div>
        </slot>
      </div>
    </div>
  </template>
  
  <script setup>
  import PreviewPanel from './PreviewPanel.vue'
  
  defineProps({
    title: {
      type: String,
      default: 'Document'
    },
    subtitle: {
      type: String,
      default: ''
    },
    previewTitle: {
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
      default: ''
    },
    previewHtml: {
      type: String,
      default: ''
    },
    emptyStateText: {
      type: String,
      default: 'No content to preview'
    },
    showDraftButton: {
      type: Boolean,
      default: false
    },
    isProcessing: {
      type: Boolean,
      default: false
    },
    submitButtonText: {
      type: String,
      default: 'Submit'
    }
  })
  
  defineEmits(['refresh', 'cancel', 'submit'])
  </script>