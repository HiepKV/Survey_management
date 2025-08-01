import api from '../utils/api'

export const AccRepository = {
    async get(params = {}) {
        return await api.get('/accounts', { params })
    },
    async create(data: any) {
        return await api.post('/accounts', data)
    }
}