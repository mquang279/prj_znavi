import { NavLink } from "react-router";
import type { Product } from "../types/Product";
import useGetProducts from "../hooks/useGetProducts";
import LoadingSpinner from "../components/LoadingSpinner";
import ErrorPage from "../components/ErrorPage";

const PRODUCTS: Product[] = [
    { name: "Nike ZoomX Vomero Plus", category: "Running Shoes", price: 180, description: "Nike ZoomX Vomero Plus", quantity: 20, url: "https://hebbkx1anhila5yf.public.blob.vercel-storage.com/NIKE%2BVOMERO%2BPLUS.jpg-5J9wMa8trM3wYziPa888tsUu54CIbe.jpeg" },
    { name: "Nike Club Cap", category: "Accessories", price: 25, description: "Nike ZoomX Vomero Plus", quantity: 20, url: "https://hebbkx1anhila5yf.public.blob.vercel-storage.com/U%2BNK%2BCLUB%2BCAP%2BU%2BCB%2BFUT%2BWSH%2BL-1.jpg-LGu748gEatTxbx1PggteSMfK1G5GKb.jpeg" },
    { name: "Nike Tech Woven Pants", category: "Men's Pants", price: 120, description: "Nike ZoomX Vomero Plus", quantity: 20, url: "https://hebbkx1anhila5yf.public.blob.vercel-storage.com/M%2BNK%2BTECH%2BWVN%2BPANT%2BOS%2BGX%2BAOP.jpg-2cS5s7Qobr7FKy9jTxD9Nk5QSt2h1e.jpeg" },
    { name: "Jordan Fleece Hoodie", category: "Men's Hoodie", price: 85, description: "Nike ZoomX Vomero Plus", quantity: 20, url: "https://hebbkx1anhila5yf.public.blob.vercel-storage.com/M%2BJ%2BSPRT%2BGFX%2BFLC%2BHDY%2BWOF%2BJH.jpg-S23kj9fne4s2PJ6PGqvrByZsnQGhE6.jpeg" }
]

const HomePage = () => {
    // const { data, status} = useGetProducts();

    // if (status === 'pending') {
    //     return <LoadingSpinner />
    // }

    // if (status === 'error') {
    //     return <ErrorPage />
    // }

    return (
        <div className="min-h-screen px-5 md:px-30 lg:px-80 py-12">
            <div className="flex justify-between items-center">
                <h1 className="text-md md:text-2xl font-semibold">FEATURED PRODUCTS</h1>
                <button className="border transition ease-in-out delay-50 duration-300 hover:-translate-y-0.5 hover:scale-105 border-black px-3 py-1 md:px-8 md:py-2 rounded-lg text-sm font-semibold hover:bg-black hover:text-white cursor-pointer">VIEW ALL</button>
            </div>

            <div className="mt-12 grid grid-cols-1 md:grid-cols-2 gap-20">
                {PRODUCTS.map((product) =>
                    <NavLink to="/" className="">
                        <img src={product.url} alt="" className="" />
                        <p className="font-bold mt-4">{product.name}</p>
                        <p className="text-gray-400 uppercase text-sm">{product.category}</p>
                        <div className="flex justify-between items-center">
                            <p className="text-sm font-bold">${product.price}</p>
                            <button className="text-sm transition ease-in-out delay-50 duration-300 hover:-translate-y-0.5 hover:scale-105 border-2 font-bold border-black px-6 py-1.5 hover:bg-black hover:text-white">ADD</button>
                        </div>
                    </NavLink>
                )}
            </div>
        </div>
    );
}

export default HomePage;