<template>
  <div class="Calculadora">
    <v-form @submit.prevent="submit" v-model="valid"
    lazy-validation>
      <v-container>
        <v-row>
          <v-col>
            <v-alert border="top" text type="info">
              <h1 class="headline">CALCULADORA</h1>
            </v-alert>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12" sm="6">
            <v-text-field
              v-model="num1"
               :rules="nameRules"
              label="Primeiro Valor"
              placeholder="Informe o Primeiro Valor para Calcular."
              filled
              rounded
              dense
              type="number"
              required
              outlined
            ></v-text-field>
          </v-col>

          <v-col cols="12" sm="6">
            <v-text-field
              v-model="num2"
               :rules="nameRules"
              label="Segundo Valor"
              placeholder="Informe o Segundo Valor para Calcular."
              filled
              rounded
              dense
              type="number"
              required
              outlined
            ></v-text-field>
          </v-col>
        </v-row>

      </v-container>
    </v-form> 



    <v-dialog
      v-model="dialog"
      persistent
      max-width="600"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="primary"
          dark
          v-bind="attrs"
          v-on="on"
          rounded class="my-2 mr-4 btn" x-large left @click="calcular()"
        >
          CALCULAR
        </v-btn>
      </template>
      <v-card>
        <v-card-title class="headline text-center"> Resultados CALCULADO </v-card-title>
        <v-divider></v-divider>
        <p>&nbsp;</p>

        <v-card-text>
          O resultado da Soma de <u>{{num1}}</u> com <u>{{num2}}</u> é: <b>{{ soma1 }}</b> <br>
          O resultado da Soma de <u>{{num2}}</u> com <u>{{num1}}</u> é: <b>{{ soma2 }}</b>
        </v-card-text>
        
        <v-card-text>
          O resultado da Subtração de <u>{{num1}}</u> com <u>{{num2}}</u> é: <b>{{ subitacao1 }}</b> <br>
          O resultado da Subtração de <u>{{num2}}</u> com <u>{{num1}}</u> é: <b>{{ subitacao2 }}</b> 
        </v-card-text>

        <v-card-text>
          O resultado da Multiplixação de <u>{{num1}}</u> com <u>{{num2}}</u> é: <b>{{ multiplicacao1 }}</b> <br>
          O resultado da Multiplixação de <u>{{num2}}</u> com <u>{{num1}}</u> é: <b>{{ multiplicacao2 }}</b> 
        </v-card-text>

        <v-card-text>
          O resultado da Divisão de  com <u>{{num1}}</u> com <u>{{num2}}</u> é: <b>{{ divisao1 }}</b> <br>
          O resultado da Divisão de  com <u>{{num2}}</u> com <u>{{num1}}</u> é: <b>{{ divisao2 }}</b>
        </v-card-text>
<v-divider></v-divider>
        <v-card-actions>

          <v-spacer></v-spacer>
          <v-btn
            color="green darken-1"
            text
            @click="carregar_dialog()"
          >
            Fechar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>   
  </div>


  
</template>

<script src="./Calculadora.js"></script>
<style lang="sass">@import "./Calculadora.scss"
</style>