import { AccRepository } from '../repositories/AccRepository';

export default {
    async get(params = {}) {
        return await AccRepository.get(params);
    },
    async create(data: any) {
        return await AccRepository.create(data);
    },
}