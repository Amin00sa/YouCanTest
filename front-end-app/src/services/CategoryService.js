import api from '@/utils/api.js';

export default {
    createCategory(data) {
        return api.post('/category', data);
    },
    getCategories() {
        return api.get('/category');
    }
    // Other category-related API calls
};
