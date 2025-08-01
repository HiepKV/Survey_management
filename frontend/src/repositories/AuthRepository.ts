import axios from "axios";

const API_BASE_URL = import.meta.env.VITE_API_BASE_URL;
const RESOURCE = '/auth';

export const AuthRepository = {
    login(data: any) {
        return axios.post(`${API_BASE_URL}${RESOURCE}/login`, data);
    },
    
    logout() {
        return axios.post(`${API_BASE_URL}${RESOURCE}/logout`);
    },
    
    getUser() {
        return axios.get(`${API_BASE_URL}${RESOURCE}/me`);
    }
}