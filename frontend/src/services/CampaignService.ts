import { CampaignRepository } from '../repositories/CampaignRepository'

export default {
  async get(params = {}) {
    return await CampaignRepository.get(params)
  },

  async create(data : any) {
    return await CampaignRepository.create(data)
  },

  async update(id : number, data : any) {
    return await CampaignRepository.update(id, data)
  },

  async getById(id: number) {
    const res = await CampaignRepository.getById(id)
    return res.data
  }
}

