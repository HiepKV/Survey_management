import api from "../utils/api";

export const CompanyRepository = {
    async get(params = {}) {
        return await api.get('/companies', { params });
    },
    async create(data: any) {
        return await api.post('/companies', data);
    },
}