      <script setup>
      defineProps({
        tabs: {
          type: Array,
          required: true
        }
      })
      </script>
      
// Tabs.vue
<template>
  <div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li v-for="(tab, index) in tabs" :key="index" class="nav-item" role="presentation">
        <button
          :class="{'nav-link active': tab.active, 'nav-link':!tab.active}"
          :id="`tab-${index}-tab`"
          :data-bs-toggle="`tab`"
          :data-bs-target="`#tab-${index}-tab-pane`"
          type="button"
          role="tab"
          :aria-controls="`tab-${index}-tab-pane`"
          :aria-selected="tab.active"
        >
          {{ tab.label }}
        </button>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div v-for="(tab, index) in tabs" :key="index" :class="{'tab-pane fade show active': tab.active, 'tab-pane fade':!tab.active}" :id="`tab-${index}-tab-pane`" role="tabpanel" :aria-labelledby="`tab-${index}-tab`" tabindex="0">
        <slot :name="`tab-${index}`" />
      </div>
    </div>
  </div>
</template>
