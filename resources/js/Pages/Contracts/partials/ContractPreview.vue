<template>
  <div class="contract-preview-container">
    <div v-if="!previewLoaded" class="preview-placeholder">
      <button @click="loadPreview" class="load-preview-btn">
        Load Preview
      </button>
    </div>
    <div v-else class="preview-content" v-html="previewHtml"></div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const previewLoaded = ref(false)
const previewHtml = ref('')

const loadPreview = async () => {
  try {
    const response = await fetch(route('blade.preview'))
    const html = await response.text()
    previewHtml.value = html
    previewLoaded.value = true
  } catch (error) {
    console.error('Error loading preview:', error)
    previewHtml.value = '<p class="text-red-500">Error loading preview</p>'
    previewLoaded.value = true
  }
}
</script>

<style scoped>
.contract-preview-container {
  width: 100%;
  height: 100%;
  border-radius: 8px;
  overflow: hidden;
}

.preview-placeholder {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 300px;
  background-color: #f9fafb;
  border: 2px dashed #d1d5db;
  border-radius: 8px;
}

.load-preview-btn {
  background-color: #3b82f6;
  color: white;
  padding: 12px 24px;
  border-radius: 6px;
  border: none;
  cursor: pointer;
  font-weight: 500;
  transition: background-color 0.2s;
}

.load-preview-btn:hover {
  background-color: #2563eb;
}

.preview-content {
  width: 100%;
  height: auto;
  max-height: 750px; /* Aumentado de 600px a 650px */
  overflow-y: auto;
  background: white;
  border-radius: 8px;
  border: 1px solid #e5e7eb;
  transform: scale(0.65); /* Aumentado de 0.5 a 0.65 (30% más grande) */
  transform-origin: top left;
  width: 154%; /* Ajustado para compensar el nuevo scale (100/0.65 ≈ 154) */
}

/* Ajustar el contenido para que se vea bien escalado */
.preview-content :deep(.page) {
  width: 100%;
  margin: 0;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.preview-content :deep(.content-padding) {
  padding: 60px 120px;
}

.preview-content :deep(.footer) {
  position: relative;
  margin-top: 20px;
}
</style>