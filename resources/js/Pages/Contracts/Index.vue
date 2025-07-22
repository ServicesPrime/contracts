<template>
  <LayoutMain>
    <div class="p-6">
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Contracts</h1>
        <button 
          @click="addNewContract" 
          class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition"
        >
          Add New Contract
        </button>
      </div>

      <!-- Search Bar -->
      <form @submit.prevent="searchContracts" class="mb-4">
        <input
          type="text"
          v-model="filters.search"
          placeholder="Search by client name or contract number"
          class="border border-gray-300 rounded px-3 py-2 mr-2"
        />
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
          Search
        </button>
      </form>

      <!-- Contracts Table -->
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded">
          <thead>
            <tr class="bg-gray-200 text-left">
              <th class="py-2 px-4">Contract #</th>
              <th class="py-2 px-4">Client</th>
              <th class="py-2 px-4">Address</th>
              <th class="py-2 px-4">Department</th>
              <th class="py-2 px-4">Services</th>
              <th class="py-2 px-4">Total Amount</th>
              <th class="py-2 px-4">Date</th>
              <th class="py-2 px-4">Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- Empty State -->
            <tr v-if="!contracts || contracts.length === 0">
              <td colspan="8" class="py-8 px-4 text-center text-gray-500">
                No contracts found. 
                <button 
                  @click="addNewContract"
                  class="text-green-600 hover:text-green-700 font-medium ml-1"
                >
                  Add your first contract
                </button>
              </td>
            </tr>
            
            <!-- Contract Rows -->
            <tr v-for="contract in contracts" :key="contract.id" class="border-t hover:bg-gray-50">
              <td class="py-2 px-4">{{ contract.contract_number }}</td>
              <td class="py-2 px-4">
                <div>
                  <div class="font-medium">{{ contract.client?.name }}</div>
                  <div class="text-sm text-gray-500">{{ contract.client?.email }}</div>
                  <div class="text-sm text-gray-500">{{ contract.client?.phone }}</div>
                </div>
              </td>
              <td class="py-2 px-4">
                <div v-if="contract.client?.address" class="text-sm">
                  <div v-if="contract.client.address.street" class="font-medium">
                    {{ contract.client.address.street }}
                  </div>
                  <div v-if="contract.client.address.city || contract.client.address.state" class="text-gray-500">
                    {{ [contract.client.address.city, contract.client.address.state, contract.client.address.zip_code].filter(Boolean).join(', ') }}
                  </div>
                  <div v-if="contract.client.address.country" class="text-gray-500">
                    {{ contract.client.address.country }}
                  </div>
                </div>
                <span v-else class="text-gray-400 italic text-sm">No address</span>
              </td>
              <td class="py-2 px-4">{{ contract.department }}</td>
              <td class="py-2 px-4">
                <div v-if="contract.contract_services && contract.contract_services.length > 0">
                  <!-- Show first service with summary -->
                  <div class="font-medium">{{ contract.contract_services[0].service?.service }}</div>
                  <span 
                    :class="contract.contract_services[0].service?.type === 'service' ? 'bg-green-100 text-green-800' : 'bg-purple-100 text-purple-800'"
                    class="inline-block px-2 py-1 rounded text-xs font-medium mt-1"
                  >
                    {{ contract.contract_services[0].service?.type === 'service' ? 'Service' : 'Terms & Conditions' }}
                  </span>
                  <!-- Show additional services count if more than 1 -->
                  <div v-if="contract.contract_services.length > 1" class="text-xs text-gray-500 mt-1">
                    +{{ contract.contract_services.length - 1 }} more service{{ contract.contract_services.length - 1 > 1 ? 's' : '' }}
                  </div>
                </div>
                <span v-else class="text-gray-400 italic text-sm">No services</span>
              </td>
              <td class="py-2 px-4">
                <div class="font-medium">
                  <span v-if="getPaidServicesFromContract(contract) > 0">
                    ${{ formatAmount(contract.total_amount || calculateContractTotal(contract)) }}
                  </span>
                  <span v-else class="text-gray-400 italic">No charges</span>
                </div>
                <div class="text-xs text-gray-500">
                  {{ getPaidServicesFromContract(contract) }} paid service{{ getPaidServicesFromContract(contract) !== 1 ? 's' : '' }}
                  <span v-if="getTermsServicesFromContract(contract) > 0">
                    + {{ getTermsServicesFromContract(contract) }} terms
                  </span>
                </div>
              </td>
              <td class="py-2 px-4">{{ formatDate(contract.date) }}</td>
              <td class="py-2 px-4">
                <div class="flex space-x-2">
                  <a
                    :href="`/contracts/${contract.id}/pdf`"
                    target="_blank"
                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm"
                  >
                    Print PDF
                  </a>
                  <button 
                    @click="viewContract(contract)"
                    class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition text-sm"
                  >
                    Preview
                  </button>
                  <button 
                    @click="editContract(contract.id)"
                    class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700 transition text-sm"
                  >
                    Edit
                  </button>
                  <button 
                    @click="deleteContract(contract.id)"
                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm"
                  >
                    Delete
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- PDF Preview Modal -->
    <div 
      v-if="showPreview" 
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4"
      @click="closePreview"
    >
      <div 
        class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-hidden"
        @click.stop
      >
        <!-- Modal Header -->
        <div class="bg-gray-100 px-6 py-4 border-b flex justify-between items-center">
          <div>
            <h3 class="text-lg font-semibold text-gray-900">Contract Preview</h3>
            <p class="text-sm text-gray-600">Work Order #{{ previewContract?.contract_number }}</p>
          </div>
          <div class="flex space-x-2">
            <a
              :href="`/contracts/${previewContract?.id}/pdf`"
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
          <div class="pdf-preview bg-white border border-gray-200 shadow-sm">
            <!-- PDF Header -->
            <div class="text-center border-b-2 border-red-600 pb-3 mb-5">
              <h1 class="text-2xl font-bold text-red-600 mb-1">JOB WORK ORDER</h1>
              <p class="text-xs text-gray-600">"The Best Services in the Industry or Nothing at All"</p>
            </div>

            <!-- Three Columns Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
              <div>
                <span class="text-red-600 font-bold text-sm block mb-1">WORK SITE:</span>
                <div class="text-xs text-gray-700">
                  <div v-if="previewContract?.client?.address?.name_account">
                    <strong>{{ previewContract.client.address.name_account }}</strong>
                  </div>
                  <div v-if="previewContract?.client?.address?.street">
                    {{ previewContract.client.address.street }}
                  </div>
                  <div v-if="previewContract?.client?.address?.city || previewContract?.client?.address?.state">
                    {{ [previewContract.client.address.city, previewContract.client.address.state, previewContract.client.address.zip_code].filter(Boolean).join(', ') }}
                  </div>
                  <div v-if="previewContract?.client?.address?.country">
                    {{ previewContract.client.address.country }}
                  </div>
                  <div v-if="previewContract?.client?.address?.full_address && !previewContract?.client?.address?.street">
                    {{ previewContract.client.address.full_address }}
                  </div>
                </div>
              </div>
              
              <div>
                <span class="text-red-600 font-bold text-sm block mb-1">BILL TO:</span>
                <div class="text-xs text-gray-700">
                  <div class="font-medium">{{ previewContract?.client?.name }}</div>
                  <div><strong>Email:</strong> {{ previewContract?.client?.email }}</div>
                  <div><strong>Phone:</strong> {{ previewContract?.client?.phone }}</div>
                  <div v-if="previewContract?.client?.area"><strong>Area:</strong> {{ previewContract?.client?.area }}</div>
                </div>
              </div>
              
              <div>
                <div class="text-xs text-gray-700 mb-2">
                  The following number must appear on all related correspondence, shipping papers, and invoices:
                </div>
                <span class="text-red-600 font-bold text-sm block mb-1">WORK ORDER NUMBER:</span>
                <span class="text-red-600 font-bold text-sm">{{ previewContract?.contract_number }}</span>
              </div>
            </div>

            <!-- Details Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
              <div>
                <span class="text-red-600 font-bold text-sm block mb-1">WORK DATE:</span>
                <span class="text-xs text-gray-700">{{ formatDate(previewContract?.date) }}</span>
              </div>
              <div>
                <span class="text-red-600 font-bold text-sm block mb-1">REQUESTED BY:</span>
                <span class="text-xs text-gray-700">{{ previewContract?.client?.name }}</span>
              </div>
              <div>
                <span class="text-red-600 font-bold text-sm block mb-1">DEPARTMENT:</span>
                <span class="text-xs text-gray-700">{{ previewContract?.department }}</span>
              </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
              <div>
                <span class="text-red-600 font-bold text-sm block mb-1">INVOICE # FOR BILL:</span>
                <span class="text-xs text-gray-700">{{ previewContract?.contract_number }}</span>
              </div>
              <div>
                <span class="text-red-600 font-bold text-sm block mb-1">TERMS:</span>
                <span class="text-xs text-gray-700">15</span>
              </div>
            </div>

            <!-- Contract Services Table - Only show paid services -->
            <div v-if="getPaidServices(previewContract).length > 0" class="overflow-x-auto mb-6">
              <table class="w-full border-collapse border border-gray-300 text-xs">
                <thead>
                  <tr class="bg-red-600 text-white">
                    <th class="border border-gray-300 p-2 text-center font-bold">Location</th>
                    <th class="border border-gray-300 p-2 text-center font-bold">Type of Service</th>
                    <th class="border border-gray-300 p-2 text-center font-bold">Frequency</th>
                    <th class="border border-gray-300 p-2 text-center font-bold">Qty</th>
                    <th class="border border-gray-300 p-2 text-center font-bold">Rate</th>
                    <th class="border border-gray-300 p-2 text-center font-bold">Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr 
                    v-for="contractService in getPaidServices(previewContract)" 
                    :key="contractService.id"
                  >
                    <td class="border border-gray-300 p-2 text-center">
                      {{ [previewContract?.client?.address?.city, previewContract?.client?.address?.state].filter(Boolean).join(', ') }}
                    </td>
                    <td class="border border-gray-300 p-2 text-center">{{ contractService.service?.service }}</td>
                    <td class="border border-gray-300 p-2 text-center">Monthly</td>
                    <td class="border border-gray-300 p-2 text-center">{{ contractService.quantity }}</td>
                    <td class="border border-gray-300 p-2 text-center">${{ formatAmount(contractService.unit_price) }}</td>
                    <td class="border border-gray-300 p-2 text-center">${{ formatAmount(contractService.quantity * contractService.unit_price) }}</td>
                  </tr>
                  <!-- Total Row -->
                  <tr class="bg-gray-100 font-bold">
                    <td colspan="5" class="border border-gray-300 p-2 text-right">TOTAL AMOUNT:</td>
                    <td class="border border-gray-300 p-2 text-center">${{ formatAmount(calculateContractTotal(previewContract)) }}</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Services Details Section -->
            <div class="mb-6" v-if="previewContract?.contract_services && previewContract.contract_services.length > 0">
              <!-- Service Specifications -->
              <div v-if="getServiceSpecifications(previewContract).length > 0" class="mb-6">
                <div class="text-red-600 font-bold text-sm mb-4 border-b border-red-200 pb-2">SERVICE SPECIFICATIONS:</div>
                <ul class="list-disc list-inside space-y-1">
                  <li 
                    v-for="spec in getServiceSpecifications(previewContract)" 
                    :key="spec.id"
                    class="text-xs text-gray-700"
                  >
                    {{ spec.description }}
                  </li>
                </ul>
              </div>

              <!-- Terms & Conditions -->
              <div v-if="getTermsAndConditions(previewContract).length > 0" class="mb-6">
                <div class="text-red-600 font-bold text-sm mb-4 border-b border-red-200 pb-2">TERMS & CONDITIONS:</div>
                
                <div 
                  v-for="termsService in getTermsAndConditions(previewContract)" 
                  :key="termsService.id"
                  class="mb-4"
                >
                  <div class="text-gray-800 font-medium text-sm mb-2">{{ termsService.service?.service }}:</div>
                  <div v-if="termsService.service?.specifications && termsService.service.specifications.length > 0">
                    <ul class="list-disc list-inside space-y-1 ml-2">
                      <li 
                        v-for="specification in termsService.service.specifications" 
                        :key="specification.id"
                        class="text-xs text-gray-700"
                      >
                        {{ specification.description }}
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </LayoutMain>
</template>

<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import LayoutMain from "@/Layouts/LayoutMain.vue"

const props = defineProps({
  contracts: Array,
  filters: Object
})

const filters = ref({
  search: props.filters?.search || ''
})

const showPreview = ref(false)
const previewContract = ref(null)

const addNewContract = () => {
  router.visit(route('contracts.create'))
}

const searchContracts = () => {
  router.get(route('contracts.index'), { search: filters.value.search })
}

const viewContract = (contract) => {
  previewContract.value = contract
  showPreview.value = true
}

const closePreview = () => {
  showPreview.value = false
  previewContract.value = null
}

const editContract = (contractId) => {
  router.visit(route('contracts.edit', contractId))
}

const deleteContract = (contractId) => {
  if (confirm('Are you sure you want to delete this contract? This action cannot be undone.')) {
    router.delete(route('contracts.destroy', contractId))
  }
}

const formatDate = (date) => {
  if (!date) return ''
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

const getPaidServicesFromContract = (contract) => {
  if (!contract || !contract.contract_services) return 0
  
  return contract.contract_services.filter(cs => 
    cs.service?.type === 'service' && cs.quantity && cs.unit_price
  ).length
}

const getTermsServicesFromContract = (contract) => {
  if (!contract || !contract.contract_services) return 0
  
  return contract.contract_services.filter(cs => cs.service?.type === 'terms').length
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
  
  return contract.contract_services.filter(cs => cs.service?.type === 'service')
}

// Close modal with Escape key
const handleKeydown = (e) => {
  if (e.key === 'Escape' && showPreview.value) {
    closePreview()
  }
}
  
// Add event listener for escape key
if (typeof window !== 'undefined') {
  window.addEventListener('keydown', handleKeydown)
}
</script>