<template>
  <!-- PDF Preview Modal -->
  <div 
    v-if="show" 
    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
    @click="closePreview"
  >
    <div 
      class="bg-white rounded-lg shadow-xl max-w-5xl w-full max-h-[90vh] overflow-hidden"
      @click.stop
    >
      <!-- Modal Header -->
      <div class="bg-gray-100 px-6 py-4 border-b flex justify-between items-center">
        <div>
          <h3 class="text-lg font-semibold text-gray-900">Contract Preview</h3>
          <p class="text-sm text-gray-600">Work Order #{{ contract?.contract_number }}</p>
        </div>
        <div class="flex space-x-2">
          <a
            :href="`/contracts/${contract?.id}/pdf`"
            target="_blank"
            class="bg-red-600 text-white px-3 py-2 rounded hover:bg-red-700 transition text-sm"
          >
            Download PDF
          </a>
          <button 
            @click="closePreview"
            class="bg-gray-300 text-gray-700 px-3 py-2 rounded hover:bg-gray-400 transition text-sm"
          >
            Close
          </button>
        </div>
      </div>

      <!-- Modal Content - PDF Preview -->
      <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
        <div class="pdf-preview bg-white border border-gray-200 shadow-sm p-8" style="max-width: 210mm; margin: 0 auto;">
          
          <!-- Header Section -->
          <div class="flex justify-between items-start mb-6">
            <!-- Logo -->
            <div class="w-1/2">
              <img 
                src="/storage/imagenes/prime7.png" 
                alt="Prime Logo" 
                class="h-20 w-auto max-w-xs"
                @error="onLogoError"
              />
            </div>
            
            <!-- Title Section -->
            <div class="w-1/2 text-center">
              <h1 class="work-order-title mb-2">JOB WORK ORDER</h1>
              <p class="work-order-subtitle">"The Best Services in the Industry or Nothing at All"</p>
            </div>
          </div>

          <!-- Three Columns Section -->
          <div class="grid grid-cols-3 gap-6 mb-6">
            <!-- Work Site -->
            <div>
              <span class="label">WORK SITE:</span>
              <div class="value">
                <div v-if="contract?.client?.address?.name_account" class="font-medium">
                  {{ contract.client.address.name_account }}
                </div>
                <div v-if="contract?.client?.address?.street">
                  {{ contract.client.address.street }}
                </div>
                <div v-if="contract?.client?.address?.city || contract?.client?.address?.state">
                  {{ [contract.client.address.city, contract.client.address.state, contract.client.address.zip_code].filter(Boolean).join(', ') }}
                </div>
                <div v-if="contract?.client?.address?.country">
                  {{ contract.client.address.country }}
                </div>
                <div v-if="contract?.client?.address?.full_address && !contract?.client?.address?.street">
                  {{ contract.client.address.full_address }}
                </div>
                <div v-if="!contract?.client?.address" class="italic text-gray-500">
                  No address available
                </div>
              </div>
            </div>
            
            <!-- Bill To -->
            <div>
              <span class="label">BILL TO:</span>
              <div class="value">
                <div class="font-medium">{{ contract?.client?.name }}</div>
                <div>{{ contract?.client?.email || 'N/A' }}</div>
                <div>{{ contract?.client?.phone || 'N/A' }}</div>
                <div v-if="contract?.client?.area">{{ contract?.client?.area }}</div>
              </div>
            </div>
            
            <!-- Work Order Number -->
            <div>
              <div class="value mb-2">
                The following number must appear on all related correspondence, shipping papers, and invoices:
              </div>
              <span class="label">WORK ORDER NUMBER:</span>
              <span class="text-red-600 font-bold text-lg">{{ contract?.contract_number }}</span>
            </div>
          </div>

          <!-- Details Section -->
          <div class="grid grid-cols-5 gap-4 mb-8">
            <div>
              <span class="label">WORK DATE:</span>
              <span class="value">{{ formatDate(contract?.date) }}</span>
            </div>
            <div>
              <span class="label">REQUESTED BY:</span>
              <span class="value">{{ contract?.client?.name || 'N/A' }}</span>
            </div>
            <div>
              <span class="label">DEPARTMENT:</span>
              <span class="value">{{ contract?.department || 'N/A' }}</span>
            </div>
            <div>
              <span class="label">INVOICE:</span>
              <span class="value">{{ contract?.contract_number }}</span>
            </div>
            <div>
              <span class="label">TERMS:</span>
              <span class="value">15</span>
            </div>
          </div>

          <!-- Contract Services Table - Only show paid services -->
          <div v-if="getPaidServices(contract).length > 0" class="mb-8">
            <table class="contract-table">
              <thead>
                <tr>
                  <th>Location</th>
                  <th>Type of Service</th>
                  <th>Frequency</th>
                  <th>Qty</th>
                  <th>Rate</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <tr 
                  v-for="contractService in getPaidServices(contract)" 
                  :key="contractService.id"
                >
                  <td>
                    {{ [contract?.client?.address?.city, contract?.client?.address?.state].filter(Boolean).join(', ') || 'N/A' }}
                  </td>
                  <td>{{ contractService.service?.service || 'N/A' }}</td>
                  <td>Monthly</td>
                  <td>{{ contractService.quantity }}</td>
                  <td>${{ formatAmount(contractService.unit_price) }}</td>
                  <td>${{ formatAmount(contractService.quantity * contractService.unit_price) }}</td>
                </tr>
                <!-- Total Row -->
                <tr class="total-row">
                  <td colspan="5" style="text-align: right;">TOTAL AMOUNT:</td>
                  <td>${{ formatAmount(calculateContractTotal(contract)) }}</td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Service Specifications -->
          <div v-if="getServiceSpecifications(contract).length > 0" class="mb-6">
            <div class="section-title">SERVICE SPECIFICATIONS:</div>
            <div 
              v-for="spec in getServiceSpecifications(contract)" 
              :key="spec.id"
              class="spec-item"
            >
              {{ spec.description }}
            </div>
          </div>

          <!-- Terms & Conditions -->
          <div v-if="getTermsAndConditions(contract).length > 0" class="mb-6">
            <div class="section-title">TERMS & CONDITIONS:</div>
            
            <div 
              v-for="termsService in getTermsAndConditions(contract)" 
              :key="termsService.id"
              class="mb-4"
            >
              <div class="terms-service-title">{{ termsService.service?.service }}:</div>
              <div v-if="termsService.service?.specifications && termsService.service.specifications.length > 0">
                <div 
                  v-for="specification in termsService.service.specifications" 
                  :key="specification.id"
                  class="spec-item"
                >
                  {{ specification.description }}
                </div>
              </div>
            </div>
          </div>

          <!-- Footer -->
          <div class="mt-8 pt-4 border-t border-gray-200">
            <img 
              src="/storage/imagenes/prime8.png" 
              alt="Prime Footer" 
              class="w-full h-16 object-contain"
              @error="onFooterError"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted, onUnmounted } from 'vue'

const props = defineProps({
  show: {
    type: Boolean,
    default: false
  },
  contract: {
    type: Object,
    default: null
  }
})

const emit = defineEmits(['close'])

const closePreview = () => {
  emit('close')
}

const formatDate = (date) => {
  if (!date) return 'N/A'
  const d = new Date(date)
  return d.toLocaleDateString('en-US', { 
    month: '2-digit', 
    day: '2-digit', 
    year: 'numeric' 
  })
}

const formatAmount = (amount) => {
  if (!amount || isNaN(amount)) return '0.00'
  return parseFloat(amount).toFixed(2)
}

const calculateContractTotal = (contract) => {
  if (!contract || !contract.contract_services) return 0
  
  return contract.contract_services.reduce((total, contractService) => {
    // Only calculate total for services that are not terms
    if (contractService.service?.type !== 'terms') {
      const quantity = parseInt(contractService.quantity) || 0
      const unitPrice = parseFloat(contractService.unit_price) || 0
      return total + (quantity * unitPrice)
    }
    return total
  }, 0)
}

const getServiceSpecifications = (contract) => {
  if (!contract || !contract.contract_services) return []
  
  const specifications = []
  contract.contract_services.forEach(cs => {
    if (cs.service?.type === 'service' && cs.service?.specifications) {
      specifications.push(...cs.service.specifications)
    }
  })
  
  // Remove duplicates based on description
  return specifications.filter((spec, index, self) => 
    index === self.findIndex(s => s.description === spec.description)
  )
}

const getTermsAndConditions = (contract) => {
  if (!contract || !contract.contract_services) return []
  
  return contract.contract_services.filter(cs => cs.service?.type === 'terms')
}

const getPaidServices = (contract) => {
  if (!contract || !contract.contract_services) return []
  
  return contract.contract_services.filter(cs => 
    cs.service?.type === 'service' && cs.quantity && cs.unit_price
  )
}

const onLogoError = (e) => {
  console.warn('Logo image failed to load:', e.target.src)
}

const onFooterError = (e) => {
  console.warn('Footer image failed to load:', e.target.src)
}

// Close modal with Escape key
const handleKeydown = (e) => {
  if (e.key === 'Escape' && props.show) {
    closePreview()
  }
}

onMounted(() => {
  window.addEventListener('keydown', handleKeydown)
})

onUnmounted(() => {
  window.removeEventListener('keydown', handleKeydown)
})
</script>

<style scoped>
/* Inter Font */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

* {
  font-family: "Inter", sans-serif !important;
}

.pdf-preview {
  font-family: "Inter", sans-serif;
  line-height: 1.3;
  color: #1c2969;
}

.pdf-preview .label {
  color: #b91f32;
  font-weight: bold;
  font-size: 14px;
  display: block;
  margin-bottom: 4px;
}

.pdf-preview .value {
  color: #1c2969;
  font-size: 12px;
  line-height: 1.4;
}

.pdf-preview .work-order-title {
  color: #b91f32;
  font-size: 32px;
  font-weight: bold;
  line-height: 1;
}

.pdf-preview .work-order-subtitle {
  color: #1c2969;
  font-size: 16px;
  font-style: italic;
  line-height: 1;
}

.pdf-preview .section-title {
  color: #b91f32;
  font-weight: bold;
  font-size: 14px;
  border-bottom: 1px solid #b91f32;
  padding-bottom: 4px;
  margin-bottom: 12px;
}

.pdf-preview .spec-item {
  color: #1c2969;
  font-size: 12px;
  margin-bottom: 4px;
  padding-left: 16px;
  position: relative;
}

.pdf-preview .spec-item:before {
  content: "•";
  color: #b91f32;
  font-weight: bold;
  position: absolute;
  left: 0;
}

.pdf-preview .terms-service-title {
  color: #1c2969;
  font-weight: bold;
  font-size: 13px;
  margin-bottom: 8px;
}

.pdf-preview .contract-table {
  font-size: 12px;
  border-collapse: collapse;
  width: 100%;
  margin-top: 8px;
}

.pdf-preview .contract-table th {
  background-color: #b91f32;
  color: white;
  padding: 8px;
  text-align: center;
  font-weight: bold;
  border: 1px solid #b91f32;
  font-size: 12px;
}

.pdf-preview .contract-table td {
  border: 1px solid #b91f32;
  padding: 8px;
  text-align: center;
  background-color: white;
  font-size: 12px;
}

.pdf-preview .total-row {
  background-color: #f0f0f0;
  font-weight: bold;
}
</style>