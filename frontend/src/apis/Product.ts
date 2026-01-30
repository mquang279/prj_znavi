import type { Product } from "../types/Product";
import axiosClient from "./AxiosClient";

export const getProducts = async (): Promise<Product[]> => {
    const response = await axiosClient.get('/products');
    return response.data;
}