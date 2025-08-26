<template>
  <!-- School Contract Information Section -->
  <section class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="bg-gradient-to-r from-[rgb(3,20,58)] to-blue-800 px-6 py-4">
      <div class="flex items-center space-x-3">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
        </svg>
        <h2 class="text-xl font-semibold text-white">School Contract Details</h2>
      </div>
    </div>
    <div class="p-6">
      
      <!-- Contract Duration Header -->
      <h3 class="text-lg font-medium text-gray-900 mb-4">Contract Duration</h3>
      
      <div class="space-y-6">
        
        <!-- Row 1: Start Date + End Date -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <FormField label="Start Date" required :error="errors.start_date">
            <FormControl 
              :model-value="schoolData.start_date"
              @update:model-value="updateField('start_date', $event)"
              type="date"
              placeholder="mm/dd/yyyy"
            />
          </FormField>

          <FormField label="End Date" required :error="errors.end_date">
            <FormControl 
              :model-value="schoolData.end_date"
              @update:model-value="updateField('end_date', $event)"
              type="date"
              placeholder="mm/dd/yyyy"
            />
          </FormField>
        </div>

        <!-- Row 2: Percentage + Work Days -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <FormField label="Percentage" required :error="errors.percentage">
            <div class="relative">
              <FormControl 
                :model-value="schoolData.percentage"
                @update:model-value="updateField('percentage', $event)"
                placeholder="0.00"
                inputmode="decimal"
                class="pr-8"
                @input="e => formatPercentage(e)"
              />
              <span class="absolute right-3 top-2 text-gray-500">%</span>
            </div>
          </FormField>

          <FormField label="Work Days (per week)" required :error="errors.work_days">
            <FormControl 
              :model-value="schoolData.work_days"
              @update:model-value="updateField('work_days', $event)"
              placeholder="Enter work days per week (e.g., Monday to Friday)"
            />
          </FormField>
        </div>

        <!-- Row 3: Labor Cost + Chemical Cost -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <FormField label="Labor Cost" required :error="errors.labor_cost">
            <div class="relative">
              <span class="absolute left-3 top-2 text-gray-500">$</span>
              <FormControl 
                :model-value="schoolData.labor_cost"
                @update:model-value="updateField('labor_cost', $event)"
                placeholder="0.00"
                inputmode="decimal"
                class="pl-8"
                data-field="labor_cost"
                @input="e => formatCurrency(e)"
              />
            </div>
          </FormField>

          <FormField label="Chemical Cost" required :error="errors.chemical_cost">
            <div class="relative">
              <span class="absolute left-3 top-2 text-gray-500">$</span>
              <FormControl 
                :model-value="schoolData.chemical_cost"
                @update:model-value="updateField('chemical_cost', $event)"
                placeholder="0.00"
                inputmode="decimal"
                class="pl-8"
                data-field="chemical_cost"
                @input="e => formatCurrency(e)"
              />
            </div>
          </FormField>
        </div>

        <!-- Row 4: Frequency + Cost Per Monthly -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <FormField label="Frequency" required :error="errors.frequency">
            <FormControl 
              :model-value="schoolData.frequency"
              @update:model-value="updateField('frequency', $event)"
              placeholder="Monthly for a period of six (6) months"
            />
          </FormField>

          <FormField label="Cost Per Monthly" required :error="errors.cost_per_monthly">
            <div class="relative">
              <span class="absolute left-3 top-2 text-gray-500">$</span>
              <FormControl 
                :model-value="schoolData.cost_per_monthly"
                @update:model-value="updateField('cost_per_monthly', $event)"
                placeholder="0.00"
                inputmode="decimal"
                class="pl-8"
                data-field="cost_per_monthly"
                @input="e => formatCurrency(e)"
              />
            </div>
          </FormField>
        </div>

        <!-- Total Calculation (Labor + Chemicals) -->
        <div v-if="showTotalCalculation" class="mt-6">
          <div class="bg-blue-50 rounded-lg p-4 border-2 border-blue-200">
            <div class="flex justify-between items-center">
              <span class="text-lg font-semibold text-blue-900">Total (Labor + Chemicals):</span>
              <span class="text-2xl font-bold text-blue-900">
                ${{ totalCost }}
              </span>
            </div>
            <div class="text-sm text-blue-600 mt-1">
              Labor: ${{ schoolData.labor_cost || '0.00' }} + Chemicals: ${{ schoolData.chemical_cost || '0.00' }}
            </div>
          </div>
        </div>

        <!-- Monthly Summary -->
        <div v-if="schoolData.cost_per_monthly" class="mt-4">
          <div class="bg-green-50 rounded-lg p-4 border-2 border-green-200">
            <div class="flex justify-between items-center">
              <span class="text-lg font-semibold text-green-900">Monthly:</span>
              <span class="text-2xl font-bold text-green-900">
                ${{ schoolData.cost_per_monthly }}
              </span>
            </div>
            <div class="text-sm text-green-600 mt-1">
              {{ schoolData.frequency || 'Monthly payment amount' }}
            </div>
          </div>
        </div>

<ServiceForm 
  :services="services"
  @update:services="services = $event"
  :errors="errors"
/>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed } from 'vue'
import FormField from "@/Components/FormField.vue"
import FormControl from "@/Components/FormControl.vue"
import ServiceForm from "./ServicesForm.vue"


const props = defineProps({
  schoolData: {
    type: Object,
    required: true
  },
  services: {  
    type: Array,
    default: () => [{
      type: '',
      service: '',
      specifications: []
    }]
  },
  errors: {
    type: Object,
    default: () => ({})
  }
})

const emit = defineEmits(['update:schoolData'])

// Update field handler
const updateField = (field, value) => {
  const newSchoolData = { ...props.schoolData, [field]: value }
  console.log(`updateField called - field: ${field}, value: ${value}`)
  console.log('Current schoolData:', props.schoolData)
  console.log('New schoolData:', newSchoolData)
  
  emit('update:schoolData', newSchoolData)
}

// Format percentage input
const formatPercentage = (e) => {
  let value = e.target.value.replace(/[^\d.]/g, '')
  const parts = value.split('.')
  if (parts.length > 2) {
    value = parts[0] + '.' + parts[1]
  }
  if (parts[1] && parts[1].length > 2) {
    value = parts[0] + '.' + parts[1].substring(0, 2)
  }
  // Limit to 100%
  if (parseFloat(value) > 100) {
    value = '100'
  }
  updateField('percentage', value)
}

// Format currency input
const formatCurrency = (e) => {
  let value = e.target.value.replace(/[^\d.]/g, '')
  const parts = value.split('.')
  if (parts.length > 2) {
    value = parts[0] + '.' + parts[1]
  }
  if (parts[1] && parts[1].length > 2) {
    value = parts[0] + '.' + parts[1].substring(0, 2)
  }
  
  // Get field name from data attribute
  const fieldName = e.target.getAttribute('data-field')
  if (fieldName) {
    updateField(fieldName, value)
  }
}

// Show total calculation when we have labor or chemical costs
const showTotalCalculation = computed(() => {
  return props.schoolData.labor_cost || props.schoolData.chemical_cost
})

// Calculate total cost
const totalCost = computed(() => {
  const laborCost = parseFloat(props.schoolData.labor_cost) || 0
  const chemicalCost = parseFloat(props.schoolData.chemical_cost) || 0
  return (laborCost + chemicalCost).toFixed(2)
})
</script>