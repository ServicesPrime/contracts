<template>
  <div class="min-h-screen bg-gray-50 flex items-center justify-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Header with breadcrumb -->
      <div class="text-center mb-12">
        <!-- Breadcrumb -->
        <div class="flex items-center justify-center mb-4" v-if="selectedCategory">
          <button 
            @click="goBack"
            class="flex items-center text-sm text-gray-500 hover:text-gray-700 transition-colors duration-200"
          >
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Categories
          </button>
          <span class="mx-2 text-gray-400">/</span>
          <span class="text-sm font-medium text-gray-700">{{ selectedCategory.charAt(0).toUpperCase() + selectedCategory.slice(1) }}</span>
        </div>

        <h1 class="text-4xl font-bold text-gray-900 mb-4">
          {{ selectedCategory ? `Select ${selectedCategory.charAt(0).toUpperCase() + selectedCategory.slice(1)} Service` : 'Select Organization' }}
        </h1>
        <p class="text-xl text-gray-600">
          {{ selectedCategory ? 'Choose the specific service type' : 'Choose the organization category for this contract' }}
        </p>
      </div>

      <!-- Main Categories View -->
      <div v-if="!selectedCategory" class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
        
        <!-- Staffing Card -->
        <div 
          @click="selectCategory('staffing')"
          class="group relative bg-white rounded-2xl shadow-lg border-2 border-gray-200 hover:border-orange-500 hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105"
        >
          <div class="p-8 text-center">
            <!-- Folder Icon -->
            <div class="mb-6">
              <div class="w-20 h-20 mx-auto bg-orange-100 rounded-full flex items-center justify-center group-hover:bg-orange-200 transition-colors duration-300">
                <svg class="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h6l2 2h4a2 2 0 012 2v1"/>
                </svg>
              </div>
            </div>
            
            <!-- Items count badge -->
            <div class="absolute top-4 right-4">
              <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-orange-100 text-orange-800 rounded-full">
                1 service
              </span>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors duration-300">
              Staffing
            </h2>
            
            <p class="text-gray-600 mb-6">
              Personnel and staffing solutions
            </p>
            
            <!-- Browse Button -->
            <div class="inline-flex items-center justify-center px-6 py-3 bg-orange-600 text-white rounded-lg font-medium group-hover:bg-orange-700 transition-colors duration-300">
              <span>Browse Services</span>
              <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
              </svg>
            </div>
          </div>
          
          <!-- Hover Effect Border -->
          <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-orange-500 to-orange-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
        </div>

        <!-- Janitorial Card -->
        <div 
          @click="selectCategory('janitorial')"
          class="group relative bg-white rounded-2xl shadow-lg border-2 border-gray-200 hover:border-blue-500 hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105"
        >
          <div class="p-8 text-center">
            <!-- Folder Icon -->
            <div class="mb-6">
              <div class="w-20 h-20 mx-auto bg-blue-100 rounded-full flex items-center justify-center group-hover:bg-blue-200 transition-colors duration-300">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h6l2 2h4a2 2 0 012 2v1"/>
                </svg>
              </div>
            </div>
            
            <!-- Items count badge -->
            <div class="absolute top-4 right-4">
              <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                1 service
              </span>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-300">
              Janitorial
            </h2>
            
            <p class="text-gray-600 mb-6">
              Cleaning and maintenance services
            </p>
            
            <!-- Browse Button -->
            <div class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-lg font-medium group-hover:bg-blue-700 transition-colors duration-300">
              <span>Browse Services</span>
              <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
              </svg>
            </div>
          </div>
          
          <!-- Hover Effect Border -->
          <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-blue-500 to-blue-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
        </div>

        <!-- JWO Card (Direct Selection) -->
        <div 
          @click="selectOrganization('jwo')"
          class="group relative bg-white rounded-2xl shadow-lg border-2 border-gray-200 hover:border-green-500 hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105"
        >
          <div class="p-8 text-center">
            <!-- JWO Icon -->
            <div class="mb-6">
              <div class="w-20 h-20 mx-auto bg-green-100 rounded-full flex items-center justify-center group-hover:bg-green-200 transition-colors duration-300">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
              </div>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-green-600 transition-colors duration-300">
              JWO
            </h2>
            
            <p class="text-gray-600 mb-6">
              Business operations and commercial services
            </p>
            
            <!-- Direct Select Button -->
            <div class="inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white rounded-lg font-medium group-hover:bg-green-700 transition-colors duration-300">
              <span>Select JWO</span>
              <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
              </svg>
            </div>
          </div>
          
          <!-- Hover Effect Border -->
          <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-green-500 to-green-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
        </div>
      </div>

      <!-- Subcategories View -->
      <div v-if="selectedCategory" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-4xl mx-auto">
        
        <!-- Staffing Subcategories -->
        <template v-if="selectedCategory === 'staffing'">
          <div 
            @click="selectOrganization('staffing-hospitality')"
            class="group relative bg-white rounded-2xl shadow-lg border-2 border-gray-200 hover:border-orange-500 hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105"
          >
            <div class="p-8 text-center">
              <!-- Hospitality Icon -->
              <div class="mb-6">
                <div class="w-16 h-16 mx-auto bg-orange-100 rounded-full flex items-center justify-center group-hover:bg-orange-200 transition-colors duration-300">
                  <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                  </svg>
                </div>
              </div>
              
              <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors duration-300">
                Hospitality
              </h3>
              
              <p class="text-gray-600 mb-6 text-sm">
                Hotel, restaurant, and event staffing solutions
              </p>
              
              <!-- Select Button -->
              <div class="inline-flex items-center justify-center px-4 py-2 bg-orange-600 text-white rounded-lg font-medium group-hover:bg-orange-700 transition-colors duration-300 text-sm">
                <span>Select</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
              </div>
            </div>
            
            <!-- Hover Effect Border -->
            <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-orange-500 to-orange-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
          </div>
        </template>

        <!-- Janitorial Subcategories -->
        <template v-if="selectedCategory === 'janitorial'">
          <div 
            @click="selectOrganization('janitorial-school')"
            class="group relative bg-white rounded-2xl shadow-lg border-2 border-gray-200 hover:border-blue-500 hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105"
          >
            <div class="p-8 text-center">
              <!-- School Icon -->
              <div class="mb-6">
                <div class="w-16 h-16 mx-auto bg-blue-100 rounded-full flex items-center justify-center group-hover:bg-blue-200 transition-colors duration-300">
                  <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                  </svg>
                </div>
              </div>
              
              <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-300">
                School
              </h3>
              
              <p class="text-gray-600 mb-6 text-sm">
                Educational facility cleaning and maintenance services
              </p>
              
              <!-- Select Button -->
              <div class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg font-medium group-hover:bg-blue-700 transition-colors duration-300 text-sm">
                <span>Select</span>
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
              </div>
            </div>
            
            <!-- Hover Effect Border -->
            <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-blue-500 to-blue-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
          </div>
        </template>
      </div>

      <!-- Footer Info -->
      <div class="text-center mt-12">
        <p class="text-sm text-gray-500">
          {{ selectedCategory ? 'You can go back to browse other categories' : 'You can change the organization later in the contract settings' }}
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const emit = defineEmits(['organization-selected'])
const selectedCategory = ref(null)

const selectCategory = (category) => {
  selectedCategory.value = category
}

const selectOrganization = (organization) => {
  emit('organization-selected', organization)
}

const goBack = () => {
  selectedCategory.value = null
}
</script>