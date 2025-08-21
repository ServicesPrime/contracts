<template>
  <div class="min-h-screen bg-gray-50 flex items-center justify-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Header -->
      <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-4">Select Organization</h1>
        <p class="text-xl text-gray-600">Choose the organization for this contract</p>
      </div>

      <!-- Organization Selection Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl mx-auto">
        
        <!-- School Card -->
        <div 
          @click="selectOrganization('school')"
          class="group relative bg-white rounded-2xl shadow-lg border-2 border-gray-200 hover:border-blue-500 hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:scale-105"
        >
          <div class="p-8 text-center">
            <!-- School Icon -->
            <div class="mb-6">
              <div class="w-20 h-20 mx-auto bg-blue-100 rounded-full flex items-center justify-center group-hover:bg-blue-200 transition-colors duration-300">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
              </div>
            </div>
            
            <!-- School Title -->
            <h2 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-300">
              School
            </h2>
            
            <!-- School Description -->
            <p class="text-gray-600 mb-6">
              Create contracts for educational institutions and academic services
            </p>
            
            <!-- Select Button -->
            <div class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-lg font-medium group-hover:bg-blue-700 transition-colors duration-300">
              <span>Select School</span>
              <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
              </svg>
            </div>
          </div>
          
          <!-- Hover Effect Border -->
          <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-blue-500 to-blue-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
        </div>

        <!-- JWO Card -->
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
            
            <!-- JWO Title -->
            <h2 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-green-600 transition-colors duration-300">
              JWO
            </h2>
            
            <!-- JWO Description -->
            <p class="text-gray-600 mb-6">
              Create contracts for business operations and commercial services
            </p>
            
            <!-- Select Button -->
            <div class="inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white rounded-lg font-medium group-hover:bg-green-700 transition-colors duration-300">
              <span>Select JWO</span>
              <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
              </svg>
            </div>
          </div>
          
          <!-- Hover Effect Border -->
          <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-green-500 to-green-600 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
        </div>
      </div>

      <!-- Footer Info -->
      <div class="text-center mt-12">
        <p class="text-sm text-gray-500">
          You can change the organization later in the contract settings
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
const emit = defineEmits(['organization-selected'])

const selectOrganization = (organization) => {
  emit('organization-selected', organization)
}
</script>