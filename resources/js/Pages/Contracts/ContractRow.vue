<template>
    <tr class="border-t hover:bg-gray-50">
      <EditableCell v-model="form.contract_number" @blur="updateContract" />
      <EditableCell v-model="form.name" @blur="updateContract" />
      <EditableCell v-model="form.location" @blur="updateContract" />
      <EditableCell v-model="form.department" @blur="updateContract" />
      <EditableCell v-model="form.product_description" @blur="updateContract" />
      <EditableCell type="number" v-model="form.product_quantity" @blur="updateContract" />
      <EditableCell type="number" v-model="form.product_cost" @blur="updateContract" />
      <EditableCell type="date" v-model="form.date" @blur="updateContract" />
      <td class="py-2 px-4">
        <a
          :href="`/contracts/${contract.id}/pdf`"
          target="_blank"
          class="text-blue-600 hover:underline"
        >
          PDF
        </a>
      </td>
    </tr>
  </template>
  
  <script setup>
  import { reactive } from 'vue'
  import { router } from '@inertiajs/vue3'
  //import EditableCell from './EditableCell.vue'
  
  const props = defineProps({
    contract: Object
  })
  
  const form = reactive({ ...props.contract })
  
  function updateContract() {
    router.put(`/contracts/${form.id}`, form, {
      preserveScroll: true
    })
  }
  </script>
  