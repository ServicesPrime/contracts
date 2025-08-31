<template>
  <div class="contract-preview-container">
    <!-- Loading State -->
    <div v-if="isLoading" class="preview-loading">
      <div class="loading-spinner"></div>
      <p class="loading-text">Cargando preview...</p>
    </div>

    <!-- Error State -->
    <div v-else-if="hasError" class="preview-error">
      <svg class="error-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
      <h4 class="error-title">Error al cargar preview</h4>
      <p class="error-message">{{ errorMessage }}</p>
      <button @click="loadPreview" class="retry-btn">
        Reintentar
      </button>
    </div>

    <!-- Empty State -->
    <div v-else-if="!previewLoaded" class="preview-placeholder">
      <svg class="placeholder-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
      </svg>
      <p class="placeholder-text">Vista previa del contrato</p>
      <button @click="loadPreview" class="load-preview-btn">
        Cargar Preview
      </button>
    </div>

    <!-- Preview Content -->
    <div v-else class="preview-wrapper">
      <!-- Preview Controls -->
      <div class="preview-controls">
        <div class="zoom-controls">
          <button @click="zoomOut" :disabled="zoomLevel <= 50" class="zoom-btn">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
            </svg>
          </button>
          <span class="zoom-level">{{ zoomLevel }}%</span>
          <button @click="zoomIn" :disabled="zoomLevel >= 150" class="zoom-btn">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
          </button>
        </div>
        <div class="view-controls">
          <button @click="fitToWidth" class="control-btn" title="Ajustar al ancho">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V6a2 2 0 012-2h12a2 2 0 012 2v2m-16 8v2a2 2 0 002 2h12a2 2 0 002-2v-2"></path>
            </svg>
          </button>
          <button @click="refreshPreview" class="control-btn" title="Actualizar">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Preview Content Area -->
      <div class="preview-content-area" ref="previewContainer">
        <div class="preview-content" 
             :style="{ 
               transform: `scale(${zoomLevel / 100})`,
               transformOrigin: 'top center',
               width: `${100 / (zoomLevel / 100)}%`
             }">
          <div class="document-container" v-html="previewHtml"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, nextTick, onMounted } from 'vue'

const props = defineProps({
  previewData: {
    type: Object,
    default: () => ({})
  },
  autoLoad: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(['preview-loaded', 'preview-error'])

// Estados reactivos
const previewLoaded = ref(false)
const previewHtml = ref('')
const isLoading = ref(false)
const hasError = ref(false)
const errorMessage = ref('')
const zoomLevel = ref(75) // Zoom inicial más cómodo
const previewContainer = ref(null)

// Métodos de zoom
const zoomIn = () => {
  if (zoomLevel.value < 150) {
    zoomLevel.value += 10
  }
}

const zoomOut = () => {
  if (zoomLevel.value > 50) {
    zoomLevel.value -= 10
  }
}

const fitToWidth = () => {
  zoomLevel.value = 75 // Zoom óptimo para ancho
  nextTick(() => {
    if (previewContainer.value) {
      previewContainer.value.scrollTop = 0
    }
  })
}

// Limpiar estilos problemáticos del HTML
const cleanHtmlStyles = (html) => {
  // Crear un elemento temporal para manipular el HTML
  const tempDiv = document.createElement('div')
  tempDiv.innerHTML = html
  
  // Encontrar y limpiar elementos con positioning problemático
  const problematicElements = tempDiv.querySelectorAll('*')
  problematicElements.forEach(el => {
    const style = el.getAttribute('style')
    if (style) {
      // Remover estilos de posicionamiento problemáticos
      let cleanStyle = style
        .replace(/position:\s*(absolute|fixed)[^;]*/gi, '')
        .replace(/bottom:\s*[^;]*/gi, '')
        .replace(/top:\s*[^;]*/gi, '')
        .replace(/left:\s*[^;]*/gi, '')
        .replace(/right:\s*[^;]*/gi, '')
        .replace(/transform:\s*[^;]*/gi, '')
        .replace(/z-index:\s*[^;]*/gi, '')
        .replace(/;;+/g, ';')
        .replace(/^;|;$/g, '')
      
      if (cleanStyle.trim()) {
        el.setAttribute('style', cleanStyle)
      } else {
        el.removeAttribute('style')
      }
    }
    
    // Remover clases que puedan tener CSS problemático
    const classList = el.className
    if (typeof classList === 'string') {
      const cleanClasses = classList
        .split(' ')
        .filter(cls => !cls.includes('absolute') && !cls.includes('fixed') && !cls.includes('bottom'))
        .join(' ')
      
      if (cleanClasses) {
        el.className = cleanClasses
      } else {
        el.removeAttribute('class')
      }
    }
  })
  
  return tempDiv.innerHTML
}

// Cargar preview
const loadPreview = async () => {
  if (isLoading.value) return
  
  isLoading.value = true
  hasError.value = false
  errorMessage.value = ''
  
  try {
    // Aquí puedes usar tus datos del props o hacer fetch
    const response = await fetch(route('blade.preview'), {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
        'Accept': 'text/html',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: JSON.stringify(props.previewData)
    })
    
    if (!response.ok) {
      throw new Error(`Error ${response.status}: ${response.statusText}`)
    }
    
    const html = await response.text()
    // Limpiar estilos problemáticos antes de asignar
    previewHtml.value = cleanHtmlStyles(html)
    previewLoaded.value = true
    
    // Forzar limpieza adicional después del render
    await nextTick()
    forceCleanLayout()
    
    emit('preview-loaded', previewHtml.value)
    
  } catch (error) {
    console.error('Error loading preview:', error)
    errorMessage.value = error.message || 'Error al cargar el preview'
    hasError.value = true
    
    emit('preview-error', error)
    
  } finally {
    isLoading.value = false
  }
}

const refreshPreview = () => {
  previewLoaded.value = false
  previewHtml.value = ''
  loadPreview()
}

// Función para forzar layout correcto después del render
const forceCleanLayout = () => {
  const container = previewContainer.value
  if (!container) return
  
  // Buscar y corregir elementos problemáticos
  const allElements = container.querySelectorAll('*')
  allElements.forEach(el => {
    const computedStyle = window.getComputedStyle(el)
    
    // Si tiene position absolute o fixed, cambiarlo a static
    if (computedStyle.position === 'absolute' || computedStyle.position === 'fixed') {
      el.style.position = 'static'
      el.style.bottom = 'auto'
      el.style.top = 'auto'
      el.style.left = 'auto'
      el.style.right = 'auto'
    }
    
    // Si es un footer, asegurar que fluya normalmente
    if (el.classList.contains('footer') || 
        el.tagName.toLowerCase() === 'footer' ||
        el.className.toLowerCase().includes('footer')) {
      el.style.position = 'static'
      el.style.marginTop = '40px'
      el.style.width = '100%'
      el.style.clear = 'both'
    }
  })
}

// Auto-load si está habilitado
if (props.autoLoad) {
  loadPreview()
}

// Exponer métodos para uso externo
defineExpose({
  loadPreview,
  refreshPreview,
  zoomIn,
  zoomOut,
  fitToWidth
})
</script>

<style scoped>
.contract-preview-container {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  background: #f8fafc;
  border-radius: 12px;
  overflow: hidden;
}

/* Loading State */
.preview-loading {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 400px;
  color: #6b7280;
}

.loading-spinner {
  width: 40px;
  height: 40px;
  border: 3px solid #e5e7eb;
  border-top: 3px solid #3b82f6;
  border-radius: 50%;
  animation: spin 1s linear infinite;
  margin-bottom: 16px;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.loading-text {
  font-size: 14px;
  font-weight: 500;
}

/* Error State */
.preview-error {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 400px;
  padding: 32px;
  text-align: center;
  color: #ef4444;
}

.error-icon {
  width: 48px;
  height: 48px;
  margin-bottom: 16px;
  opacity: 0.8;
}

.error-title {
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 8px;
  color: #dc2626;
}

.error-message {
  font-size: 14px;
  margin-bottom: 20px;
  color: #7f1d1d;
  max-width: 300px;
}

.retry-btn {
  background: #ef4444;
  color: white;
  padding: 8px 16px;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  font-weight: 500;
  transition: all 0.2s;
}

.retry-btn:hover {
  background: #dc2626;
  transform: translateY(-1px);
}

/* Empty State */
.preview-placeholder {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 400px;
  color: #6b7280;
}

.placeholder-icon {
  width: 64px;
  height: 64px;
  margin-bottom: 16px;
  opacity: 0.5;
}

.placeholder-text {
  font-size: 16px;
  font-weight: 500;
  margin-bottom: 20px;
}

.load-preview-btn {
  background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
  color: white;
  padding: 12px 24px;
  border-radius: 10px;
  border: none;
  cursor: pointer;
  font-weight: 600;
  transition: all 0.3s;
  box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
}

.load-preview-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 15px -3px rgba(59, 130, 246, 0.4);
}

/* Preview Content */
.preview-wrapper {
  display: flex;
  flex-direction: column;
  height: 100%;
  flex: 1;
}

.preview-controls {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 16px;
  background: white;
  border-bottom: 1px solid #e5e7eb;
  flex-shrink: 0;
}

.zoom-controls {
  display: flex;
  align-items: center;
  gap: 8px;
}

.zoom-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 32px;
  height: 32px;
  background: #f3f4f6;
  border: 1px solid #d1d5db;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.2s;
}

.zoom-btn:hover:not(:disabled) {
  background: #e5e7eb;
  border-color: #9ca3af;
}

.zoom-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.zoom-level {
  font-size: 12px;
  font-weight: 600;
  color: #374151;
  min-width: 40px;
  text-align: center;
}

.view-controls {
  display: flex;
  gap: 4px;
}

.control-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 32px;
  height: 32px;
  background: #f9fafb;
  border: 1px solid #e5e7eb;
  border-radius: 6px;
  cursor: pointer;
  transition: all 0.2s;
  color: #6b7280;
}

.control-btn:hover {
  background: #f3f4f6;
  color: #374151;
}

.preview-content-area {
  flex: 1;
  overflow: auto;
  background: #e5e7eb;
  position: relative;
}

.preview-content {
  transition: transform 0.3s ease;
  margin: 20px auto;
  background: white;
  box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  border-radius: 8px;
  overflow: hidden;
}

.document-container {
  position: relative;
  background: white;
}

/* Estilos para el contenido del documento - MÁS ESPECÍFICOS */
.document-container {
  position: relative !important;
  overflow: hidden !important;
  background: white !important;
}

.document-container :deep(*) {
  position: static !important;
  transform: none !important;
}

.document-container :deep(.page),
.document-container :deep([class*="page"]) {
  width: 100% !important;
  min-height: auto !important;
  height: auto !important;
  margin: 0 !important;
  padding: 60px 80px !important;
  background: white !important;
  position: relative !important;
  overflow: visible !important;
  box-sizing: border-box !important;
}

.document-container :deep(.footer),
.document-container :deep([class*="footer"]),
.document-container :deep(footer) {
  position: static !important;
  bottom: auto !important;
  left: auto !important;
  right: auto !important;
  margin-top: 40px !important;
  margin-bottom: 0 !important;
  padding: 20px 0 40px 0 !important;
  border-top: 1px solid #e5e7eb !important;
  background: transparent !important;
  width: 100% !important;
  clear: both !important;
}

.document-container :deep(.content-padding) {
  padding: 0 !important;
  position: relative !important;
  z-index: 1 !important;
}

/* Resetear cualquier positioning absoluto o fijo */
.document-container :deep([style*="position: absolute"]),
.document-container :deep([style*="position: fixed"]) {
  position: static !important;
}

/* Asegurar que el contenido fluya correctamente */
.document-container :deep(body),
.document-container :deep(html) {
  width: 100% !important;
  height: auto !important;
  margin: 0 !important;
  padding: 0 !important;
  overflow: visible !important;
}

/* Estilos específicos para contratos */
.document-container :deep(.contract-content) {
  position: relative !important;
  width: 100% !important;
  height: auto !important;
  padding-bottom: 100px !important; /* Espacio para el footer */
}

.document-container :deep(.contract-header) {
  margin-bottom: 30px !important;
}

.document-container :deep(.contract-body) {
  margin-bottom: 50px !important;
}

/* Forzar que todos los elementos de bloque fluyan normalmente */
.document-container :deep(div),
.document-container :deep(section),
.document-container :deep(article),
.document-container :deep(main) {
  position: static !important;
  float: none !important;
  clear: both !important;
}

/* Responsive */
@media (max-width: 640px) {
  .preview-controls {
    padding: 8px 12px;
    flex-wrap: wrap;
    gap: 8px;
  }
  
  .zoom-controls {
    order: 2;
    flex: 1;
    justify-content: center;
  }
  
  .view-controls {
    order: 1;
  }
}

/* Custom scrollbar */
.preview-content-area {
  scrollbar-width: thin;
  scrollbar-color: #cbd5e1 #f1f5f9;
}

.preview-content-area::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

.preview-content-area::-webkit-scrollbar-track {
  background: #f1f5f9;
}

.preview-content-area::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 4px;
}

.preview-content-area::-webkit-scrollbar-thumb:hover {
  background: #94a3b8;
}
</style>