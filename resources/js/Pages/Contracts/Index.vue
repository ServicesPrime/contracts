<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Contracts</h1>

    <!-- Search Bar -->
    <form @submit.prevent="searchContracts" class="mb-4">
      <input
        type="text"
        v-model="filters.search"
        placeholder="Search by name or contract number"
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
            <th class="py-2 px-4">Name</th>
            <th class="py-2 px-4">Location</th>
            <th class="py-2 px-4">Department</th>
            <th class="py-2 px-4">Product</th>
            <th class="py-2 px-4">Quantity</th>
            <th class="py-2 px-4">Cost</th>
            <th class="py-2 px-4">Date</th>
            <th class="py-2 px-4">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="contract in contracts" :key="contract.id" class="border-t hover:bg-gray-50">
            <td class="py-2 px-4">{{ contract.contract_number }}</td>
            <td class="py-2 px-4">{{ contract.name }}</td>
            <td class="py-2 px-4">{{ contract.location }}</td>
            <td class="py-2 px-4">{{ contract.department }}</td>
            <td class="py-2 px-4">{{ contract.product_description }}</td>
            <td class="py-2 px-4">
              <input
                type="number"
                v-model="contract.product_quantity"
                class="w-16 border border-gray-300 rounded px-2 py-1"
              />
            </td>
            <td class="py-2 px-4">${{ contract.product_cost }}</td>
            <td class="py-2 px-4">{{ contract.date }}</td>
            <td class="py-2 px-4">
              <a
                :href="`/contracts/${contract.id}/pdf`"
                target="_blank"
                class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700 transition"
              >
                Imprimir
              </a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  contracts: Array,
  filters: Object
})

const filters = ref({
  search: props.filters.search || ''
})

function searchContracts() {
  router.get('/contracts', { search: filters.value.search }, { preserveState: true })
}
</script>
