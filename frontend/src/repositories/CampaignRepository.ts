import api from '../utils/api'

export const CampaignRepository = {
  async get(params = {}) {
    return await api.get('/campaigns', { params })
  },
  async create(data: any) {
    return await api.post('/campaigns', data)
  },
  async update(id: number, data: any) {
    return await api.put(`/campaigns/${id}`, data)
  },
  async getById(id: number) {
    return await api.get(`/campaigns/${id}`)
  },
}
