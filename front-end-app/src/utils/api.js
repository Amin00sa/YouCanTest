import axios from 'axios';

const baseURL = 'http://localhost:8000/api'; // Update this with your backend API base URL

const api = axios.create({
    baseURL,
    headers: {
        'Content-Type': 'application/json',
        // You can add additional headers if needed
    },
});

export default api;
