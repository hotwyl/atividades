<template>
  <v-app>
    <div id="app">
      <v-card color="grey lighten-4" flat tile id="nav">
        <v-toolbar dense>
          <v-app-bar-nav-icon></v-app-bar-nav-icon>

          <div id="link">
            <router-link to="/" class="link">Home</router-link>|
            <router-link to="/Calculadora" class="link">Calculadora</router-link>
          </div>

          <v-spacer></v-spacer>

          <v-btn icon>
            <v-icon>mdi-magnify</v-icon>
          </v-btn>

          <v-btn icon>
            <v-icon>mdi-export</v-icon>
          </v-btn>

          <v-btn icon>
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </v-toolbar>
      </v-card>

      <v-main>
        <router-view />
      </v-main>
    </div>
  </v-app>
</template>

<script src="./App.js"></script>
<style lang="sass">@import "./App.scss"
</style>