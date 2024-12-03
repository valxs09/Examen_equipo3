<template>
    <div class="container mt-5">
      <h1 class="text-center mb-4">Reloj Global</h1>
  
      <!-- Lista de ciudades agregadas -->
      <div class="row">
        <div
          class="col-md-4 mb-3"
          v-for="city in cities"
          :key="city.name"
        >
          <div class="card text-center shadow">
            <div class="card-body">
              <h5 class="card-title">{{ city.name }}</h5>
              <p class="card-text fs-4">
                {{ city.time || "Loading..." }}
              </p>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Seleccionar para agregar más ciudades -->
      <div class="mt-4">
        <h3 class="text-center">Agregar una nueva ciudad</h3>
        <div class="d-flex justify-content-center align-items-center mt-3">
          <select
            class="form-select w-auto me-2"
            v-model="selectedCity"
          >
            <option value="" disabled>Selecciona una ciudad</option>
            <option
              v-for="city in availableCities"
              :key="city.name"
              :value="city"
            >
              {{ city.name }} ({{ city.timezone }})
            </option>
          </select>
          <button
            class="btn btn-primary"
            @click="addCity"
          >
            Agregar
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    data() {
      return {
        cities: [],
        selectedCity: null, // Ciudad seleccionada
        availableCities: [
          // Lista inicial de ciudades y sus zonas horarias
          { name: "Madrid", timezone: "Europe/Madrid" },
          { name: "New York", timezone: "America/New_York" },
          { name: "Tokyo", timezone: "Asia/Tokyo" },
          { name: "London", timezone: "Europe/London" },
          { name: "Sydney", timezone: "Australia/Sydney" },
        ],
      };
    },
    methods: {
      // Método para obtener la hora de las ciudades
      fetchTime(city) {
        axios
          .get("/time", {
            params: { city: city.name, timezone: city.timezone },
          })
          .then((response) => {
            city.time = response.data.time; // Actualiza la hora de la ciudad
          })
          .catch((error) => {
            console.error("Error fetching time:", error);
          });
      },
  
      // Agregar una ciudad desde el selector
      addCity() {
        if (this.selectedCity) {
          // Verificar si la ciudad ya está agregada
          const exists = this.cities.some(
            (city) => city.name === this.selectedCity.name
          );
          if (!exists) {
            const city = { ...this.selectedCity, time: null };
            this.cities.push(city); // Agregar la ciudad a la lista
            this.fetchTime(city); // Obtener la hora de la ciudad
          } else {
            alert("La ciudad ya está agregada");
          }
        }
      },
    },
    mounted() {
      // Inicializar la lista con ciudades agregadas
      this.cities.forEach((city) => this.fetchTime(city));
  
      // Actualizar las horas automáticamente
      setInterval(() => {
        this.cities.forEach((city) => this.fetchTime(city));
      }, 1000);
    },
  };
  </script>
  
  <style>
  .city {
    margin-bottom: 20px;
  }
  
  select {
    width: 300px;
  }
  
  .card {
    background-color: #f8f9fa;
  }
  
  .card:hover {
    background-color: #e9ecef;
    transition: background-color 0.3s;
  }
  </style>
  