import { useQuery } from "@tanstack/react-query"
import { getProducts } from "../apis/Product"

const useGetProducts = () => {
    return useQuery({
        queryKey: [],
        queryFn: () => getProducts(),
        staleTime: 3 * 60 * 1000,
        retry: false
    })
}

export default useGetProducts;