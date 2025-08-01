import { CompanyRepository } from "../repositories/CompanyRepository";

export default {
  async get(params = {}) {
    return await CompanyRepository.get(params);
  },

  async create(data: any) {
    return await CompanyRepository.create(data);
  },
};