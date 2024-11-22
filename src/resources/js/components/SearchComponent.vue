<template>
    <div>
        <input
            type="text"
            v-model="query"
            @input="debouncedFetchSuggestions"
            placeholder="Autocomplete Search for Employers..."
            class="rounded-xl bg-white/10 border border-white/10 px-5 py-4 w-full"
        />
        <ul v-if="suggestions.length" class="white/10  border border-white/10 mt-1 rounded w-full">
            <li
                v-for="(suggestion, index) in suggestions"
                :key="index"
                @click="selectSuggestion(suggestion)"
                class="p-2 cursor-pointer hover:bg-gray-100"
            >
                {{ suggestion.name }}
            </li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios';
import debounce from 'lodash/debounce'; // Import lodash debounce

export default {
    data() {
        return {
            query: '',
            suggestions: [],
        };
    },
    created() {
        // Debounce the fetchSuggestions method to limit API calls
        this.debouncedFetchSuggestions = debounce(this.fetchSuggestions, 300);
    },
    methods: {
        fetchSuggestions() {
            if (this.query.length > 2) {
                axios.get(`/autocompleteEmployer?q=${this.query}`)
                    .then(response => {
                        this.suggestions = response.data.data;
                    });
            } else {
                this.suggestions = [];
            }
        },
        selectSuggestion(suggestion) {
            this.query = suggestion.name;
            this.suggestions = [];
            // Redirect to the specific job's page based on its ID
            window.location.href = `/jobs/${suggestion.id}`;
        }
    }
};
</script>

<style scoped>
/* Additional styling if needed */
</style>
