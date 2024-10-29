import './bootstrap';

import.meta.glob(['../images/**']);
import './hamburgerMenu';
import './redirect';

import { createApp } from 'vue';
import SearchComponent from './components/SearchComponent.vue';

// Add this import for Axios
import axios from 'axios';

// Set up CSRF token for Axios
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const app = createApp({});
app.component('search-component', SearchComponent);
app.mount('#app');
