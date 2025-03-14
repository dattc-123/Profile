<template>
    <a-layout>
      <!-- Sidebar -->
      <a-layout-sider width="200" theme="light">
        <a-menu mode="inline" :selectedKeys="[selectedKey]" @click="handleMenuClick">
          <a-menu-item key="dashboard">
            <router-link to="/">🏠 Dashboard</router-link>
          </a-menu-item>
          <a-menu-item key="users">
            <router-link to="/users">👤 Quản lý người dùng</router-link>
          </a-menu-item>
        </a-menu>
      </a-layout-sider>

      <!-- Main Layout -->
      <a-layout>
        <a-layout-header class="header">
          <h2>🚀 My Nuxt App</h2>
        </a-layout-header>

        <a-layout-content class="content">
          <slot /> <!-- Nội dung trang sẽ được render tại đây -->
        </a-layout-content>

        <a-layout-footer class="footer">
          © {{ new Date().getFullYear() }} - Made with ❤️ by Dương
        </a-layout-footer>
      </a-layout>
    </a-layout>
  </template>

  <script setup>
  import { ref, onMounted } from 'vue'
  import { useRouter, useRoute } from 'vue-router'

  const router = useRouter()
  const route = useRoute()
  const selectedKey = ref(route.path)

  // Khi chuyển trang, cập nhật menu được chọn
  onMounted(() => {
    selectedKey.value = route.path
  })

  const handleMenuClick = (e) => {
    router.push(e.key)
  }
  </script>

  <style scoped>
  .header {
    background: #001529;
    color: white;
    text-align: center;
    padding: 10px;
    font-size: 18px;
  }

  .content {
    padding: 20px;
    min-height: 80vh;
    background: #f0f2f5;
  }

  .footer {
    text-align: center;
    padding: 10px;
    background: #001529;
    color: white;
  }
  </style>
