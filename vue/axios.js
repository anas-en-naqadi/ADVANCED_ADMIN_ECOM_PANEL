import axios from "axios";
import store from "./src/store" ;
import { useRouter } from "vue-router";
const router = useRouter();
const axiosClient = axios.create({
baseURL:'http://localhost:8000/api'
});

axiosClient.interceptors.request.use(config => {
config.headers.Authorization = `Bearer ${store.state.user.token}`
return config;
});
axiosClient.interceptors.response.use(
    response => response,
    error => {
        // Check if the error is due to token expiration
        if (error.response.status === 401) {
            store.commit("DELETE_USER");
            router.push({
                name: "login",
              });
        }
       
        return Promise.reject(error);
    }
);

export default axiosClient;
