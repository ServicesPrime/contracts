<template>
  <LayoutMain>
    <div class="min-h-screen bg-gray-50">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Header -->
        <div class="mb-8">
          <h1 class="text-3xl font-bold text-gray-900">{{ isEditing ? 'Edit Client' : 'Add New Client' }}</h1>
          <p class="text-gray-600 mt-2">Fill in the information below to {{ isEditing ? 'update' : 'create' }} a client</p>
        </div>

        <form @submit.prevent="submitForm" class="space-y-8">
          
          <!-- Basic Information Section (Client Table) -->
          <section class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-[rgb(3,20,58)] to-blue-800 px-6 py-4">
              <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <h2 class="text-xl font-semibold text-white">Basic Information</h2>
              </div>
            </div>
            <div class="p-6">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <FormField label="Full Name" required :error="form.errors.name">
                  <FormControl 
                    v-model="form.name" 
                    placeholder="Enter client's full name" 
                    inputmode="text" 
                    pattern="[A-Za-z ]*"
                    @input="e => form.name = e.target.value.replace(/[^A-Za-z ]/g, '')"
                  />
                </FormField>

                <FormField label="Email Address" required :error="form.errors.email">
                  <FormControl 
                    v-model="form.email" 
                    type="email"
                    placeholder="Enter client's email address" 
                  />
                </FormField>

                <FormField label="Phone Number" required :error="form.errors.phone">
                  <FormControl 
                    v-model="form.phone" 
                    placeholder="Enter phone number" 
                    inputmode="tel"
                    :maxlength="15"
                    @input="e => form.phone = e.target.value.replace(/[^0-9+()-]/g, '').slice(0, 15)"
                  />
                </FormField>

                <FormField label="Area" required :error="form.errors.area">
                  <FormControl 
                    v-model="form.area" 
                    placeholder="Enter client's area or department" 
                  />
                </FormField>
              </div>
            </div>
          </section>

          <!-- Address Information Section (Address Table) -->
          <section class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="bg-gradient-to-r from-[rgb(3,20,58)] to-blue-800 px-6 py-4">
              <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                  </path>
                </svg>
                <h2 class="text-xl font-semibold text-white">Address Information</h2>
              </div>
            </div>
            <div class="p-6">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                  <FormField label="Account Name" :error="form.errors.name_account">
                    <FormControl 
                      v-model="form.name_account" 
                      placeholder="Enter account name (optional)" 
                    />
                  </FormField>
                </div>

                <div class="md:col-span-2">
                  <FormField label="Street Address" :error="form.errors.street">
                    <FormControl 
                      v-model="form.street" 
                      placeholder="Enter street address" 
                    />
                  </FormField>
                </div>

                <FormField label="City" :error="form.errors.city">
                  <FormControl 
                    v-model="form.city" 
                    placeholder="Enter city" 
                    inputmode="text" 
                    pattern="[A-Za-z ]*"
                    @input="e => form.city = e.target.value.replace(/[^A-Za-z ]/g, '')" 
                  />
                </FormField>

                <FormField label="State" :error="form.errors.state">
                  <FormControl 
                    v-model="form.state" 
                    placeholder="TX" 
                  />
                </FormField>

                <FormField label="Zip Code" :error="form.errors.zip_code">
                  <FormControl 
                    v-model="form.zip_code" 
                    placeholder="Enter zip code" 
                    :maxlength="5" 
                    inputmode="numeric"
                    pattern="\d*" 
                    @input="e => form.zip_code = e.target.value.replace(/\D/g, '').slice(0, 5)" 
                  />
                </FormField>

                <FormField label="Country" :error="form.errors.country">
                  <FormControl 
                    v-model="form.country" 
                    value="United States"
                    disabled
                    readonly
                    class="bg-gray-100 text-gray-600"
                  />
                </FormField>
                
                <!-- Address Preview (inline) -->
                <div class="md:col-span-2 mt-4">
                  <div class="bg-gray-50 rounded-lg p-3 border border-gray-200">
                    <p class="text-xs text-gray-500 mb-1 font-medium">Complete Address:</p>
                    <div class="text-sm text-gray-700">
                      <div v-if="form.street || form.city || form.state || form.zip_code">
                        <div v-if="form.street">{{ form.street }}</div>
                        <div v-if="form.city || form.state || form.zip_code">
                          {{ [form.city, form.state, form.zip_code].filter(Boolean).join(', ') }}
                        </div>
                        <div class="text-gray-500">{{ form.country }}</div>
                      </div>
                      <div v-else class="text-gray-400 italic text-xs">
                        Address will appear here as you fill in the fields above
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <!-- Form Actions -->
          <div class="flex justify-end space-x-4 pt-6">
            <button 
              type="button" 
              @click="goBack"
              class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
            >
              Cancel
            </button>
            <button 
              type="submit" 
              :disabled="form.processing"
              class="px-6 py-2 bg-blue-600 hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200"
            >
              <span v-if="form.processing" class="flex items-center">
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{ isEditing ? 'Updating...' : 'Creating...' }}
              </span>
              <span v-else>
                {{ isEditing ? 'Update Client' : 'Create Client' }}
              </span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </LayoutMain>
</template>

<script setup>
import { ref,computed} from 'vue'
import { useForm, router } from '@inertiajs/vue3'
import LayoutMain from "@/Layouts/LayoutMain.vue"
import FormField from "@/Components/FormField.vue"
import FormControl from "@/Components/FormControl.vue"

const props = defineProps({
  client: {
    type: Object,
    default: () => ({})
  }
})

const isEditing = computed(() => !!props.client?.id)

// Form que maneja tanto crear como editar
const form = useForm({
  // Datos para tabla clients
  name: props.client?.name || '',
  email: props.client?.email || '',
  phone: props.client?.phone || '',
  area: props.client?.area || '',
  
  // Datos para tabla addresses  
  name_account: props.client?.address?.name_account || '',
  street: props.client?.address?.street || '',
  city: props.client?.address?.city || '',
  state: props.client?.address?.state || 'TX',
  zip_code: props.client?.address?.zip_code || '',
  country: 'United States'
})

const submitForm = () => {
  if (isEditing.value) {
    form.put(route('client.update', props.client.id))
  } else {
    form.post(route('client.store'))
  }
}

const goBack = () => {
  router.visit(route('client.index'))
}
</script>