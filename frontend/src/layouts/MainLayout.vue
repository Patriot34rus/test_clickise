<script setup lang="ts"></script>

<template>
  <div class="main-layout">
    <header>
      <BNav>
        <BNavItem to="/" exact exact-active-class="active">Главная</BNavItem>
        <BNavItem to="/rules" exact exact-active-class="active">Правила</BNavItem>
        <BNavItem to="/stats" exact exact-active-class="active">График</BNavItem>
        <BNavItem to="/logs" exact exact-active-class="active">Логи</BNavItem>
      </BNav>
      <hr />
    </header>
    <main>
      <router-view />
    </main>
    <footer></footer>
  </div>
</template>

<style scoped></style>
