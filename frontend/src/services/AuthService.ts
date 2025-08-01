import { AuthRepository } from "../repositories/AuthRepository";
import { useAuthStore } from "../stores/Auth";

export default {
  async login(data: any) {
    const res = await AuthRepository.login(data);
    const auth = useAuthStore();

    auth.setToken(res.data.access_token);
    auth.setUser(res.data.user);

    return res;
  },

  async logout() {
    const auth = useAuthStore();
    auth.logout();
    return await AuthRepository.logout();
  },

  async getUser() {
    const res = await AuthRepository.getUser();
    const auth = useAuthStore();
    auth.setUser(res.data);
    return res.data;
  }
};
