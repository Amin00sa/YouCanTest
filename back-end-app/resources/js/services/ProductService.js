import api from '../utils/api.js';

export default {
    createProduct(data) {
        return api.post('/product', data);
    },
    getAllProducts() {
        return api.get('/product');
    },
    // Other methods for products, etc.
};
