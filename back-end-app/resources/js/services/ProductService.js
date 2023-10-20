import api from '../utils/api.js';

export default {
    createProduct(data) {
        return api.post('/product', data);
    },
    getAllProducts() {
        return api.get('/product');
    },
    searchProduct(data){
        return api.get(`/product/search?category_id=${data.category_id}&minPrice=${data.minPrice}&maxPrice=${data.maxPrice}`);
    }
    // Other methods for products, etc.
};
