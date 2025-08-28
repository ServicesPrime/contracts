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
              <th class="py-2 px-4">Type</th>
              <th class="py-2 px-4">Contract #</th>
              <th class="py-2 px-4">Client</th>
              <th class="py-2 px-4">Address</th>
              <th class="py-2 px-4">Services/Details</th>
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
              <!-- Contract Type Column -->
              <td class="py-2 px-4">
                <span 
                  :class="contract.contract_type === 'school' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800'"
                  class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium uppercase tracking-wide"
                >
                  <!-- Icon for School -->
                  <svg v-if="contract.contract_type === 'school'" class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                  </svg>
                  <!-- Icon for JWO -->
                  <svg v-else class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm0 2h12v8H4V6z" clip-rule="evenodd"/>
                  </svg>
                  {{ contract.contract_type === 'school' ? 'School' : 'JWO' }}
                </span>
              </td>
              
              <td class="py-2 px-4 font-mono">{{ contract.contract_number }}</td>
              
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
            
              <td class="py-2 px-4">
                <!-- Show different content based on contract type -->
                <div v-if="contract.contract_type === 'school'">
                  <!-- School Contract Details -->
                  <div class="font-medium text-blue-700">School Contract</div>
                  <div class="text-sm text-gray-600">{{ contract.description }}</div>
                  <div v-if="contract.contract_school" class="text-xs text-gray-500 mt-1">
                    <div>Work Days: {{ contract.contract_school.work_days }}</div>
                    <div>Percentage: {{ contract.contract_school.percentage }}%</div>
                  </div>
                </div>
                
                <div v-else-if="contract.contract_services && contract.contract_services.length > 0">
                  <!-- JWO Contract Services -->
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
                
                <span v-else class="text-gray-400 italic text-sm">No services/details</span>
              </td>
              
              <td class="py-2 px-4">
                <div class="font-medium">
                  <span v-if="contract.total_amount > 0">
                    ${{ formatAmount(contract.total_amount) }}
                  </span>
                  <span v-else class="text-gray-400 italic">No charges</span>
                </div>
                <div class="text-xs text-gray-500">
                  <span v-if="contract.contract_type === 'school'">
                    Labor + Chemical costs
                  </span>
                  <span v-else>
                    {{ getPaidServicesFromContract(contract) }} paid service{{ getPaidServicesFromContract(contract) !== 1 ? 's' : '' }}
                    <span v-if="getTermsServicesFromContract(contract) > 0">
                      + {{ getTermsServicesFromContract(contract) }} terms
                    </span>
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
                    title="Download PDF"
                  >
                    PDF
                  </a>
                  <button 
                    @click="viewContract(contract)"
                    class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition text-sm"
                    title="Preview Contract"
                  >
                    View
                  </button>
                  <button 
                    @click="editContract(contract.id)"
                    class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700 transition text-sm"
                    title="Edit Contract"
                  >
                    Edit
                  </button>
                  <button 
                    @click="deleteContract(contract.id)"
                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition text-sm"
                    title="Delete Contract"
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

    <!-- Contract Preview Component -->
    <ContractPreview 
      :show="showPreview" 
      :contract="previewContract" 
      @close="closePreview" 
    />
   
  </LayoutMain>
</template>

<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'
import LayoutMain from "@/Layouts/LayoutMain.vue"
import ContractPreview from "@/Components/PDF/ContractPreview.vue"

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
</script>