import axios from "axios";
export const axiosClient = axios.create({
    baseURL: "http://localhost:8000/",

  });
const AppService = {
    
    get(resource) {
        return axiosClient.get(`${resource}`);
      },
    post(resource) {
        return axiosClient.post(`${resource}`);
      }

  };
  export default AppService;