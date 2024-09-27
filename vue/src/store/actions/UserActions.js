import axiosClient from "../../../axios";
const userActions = {
    async productDetails({ commit }, product_id) {
        try {
            const response = await axiosClient.get(`/product/${product_id}`);
            return response;
        } catch (error) {
            return error;
        }
    },
};

export default userActions;
