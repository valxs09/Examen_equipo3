import "bootstrap/dist/css/bootstrap.min.css"; // Estilos de Bootstrap
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import { createApp } from 'vue';
import App from './components/App.vue';

const app = createApp(App);
app.mount('#app');
