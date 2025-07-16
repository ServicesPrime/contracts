<template>
    <td class="py-2 px-4">
      <input
        :type="type"
        v-model="modelValue"
        @blur="$emit('blur')"
        class="w-full border border-gray-300 rounded px-2 py-1"
      />
    </td>
  </template>
  
  <script setup>
  defineProps({
    modelValue: [String, Number],
    type: {
      type: String,
      default: 'text'
    }
  })
  
  defineEmits(['update:modelValue', 'blur'])
  </script>
  
  <script>
  export default {
    watch: {
      modelValue(newVal) {
        this.$emit('update:modelValue', newVal)
      }
    }
  }
  </script>
  