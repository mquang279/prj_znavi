import { Equal, Heart, Menu, Search, ShoppingBag } from "lucide-react";
import { useState } from "react";
import { NavLink } from "react-router";
import { useAuth } from "../../hooks/auth/useAuth";

interface NavItem {
    icon?: any,
    text: string,
    link: string
}

const NAV_ITEMS: NavItem[] = [
    { text: "NEW", link: "" },
    { text: "MEN", link: "" },
    { text: "WOMEN", link: "" },
    { text: "KIDS", link: "" },
]

const Header = () => {
    const [modalOpen, setModalOpen] = useState<boolean>(false);
    const { isAuthenticated, isLoading } = useAuth();

    return (
        <div className="sticky top-0 z-50">
            <div className="px-5 bg-white px- flex h-12 items-center md:px-10 lg:px-20 py-9 md:justify-between border-gray-200 border-b">
                <button className="md:hidden" onClick={() => setModalOpen(!modalOpen)}>
                    <Menu />
                </button>
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a6/Logo_NIKE.svg" alt="" className="h-7 absolute left-1/2 -translate-x-1/2 md:static md:translate-x-0" />
                <div className="hidden nav-items md:flex md:gap-12 lg:gap-20 font-semibold text-sm">
                    {NAV_ITEMS.map((item) =>
                        <NavLink to={'/'}>{item.text}</NavLink>
                    )}
                </div>
                <div className="hidden md:flex gap-6 items-center">
                    <div className="relative">
                        <Search className="absolute left-2.5 top-1/2 -translate-y-1/2 text-gray-400" size={16} />
                        <input
                            type="text"
                            placeholder="SEARCH"
                            className="w-40 border placeholder:text-xs rounded-sm border-gray-300 bg-gray-100 py-1.5 pl-8 text-sm focus:outline-none focus:ring-1 focus:ring-gray-300"
                        />
                    </div>
                    <NavLink to={"/"}><Heart size={16} /></NavLink>
                    <NavLink to={"/"}><ShoppingBag size={16} /></NavLink>
                    {!isLoading && !isAuthenticated &&
                        <NavLink to={"/login"} className="text-sm border rounded-md px-5 border-black py-1.5 hover:bg-black hover:text-white">Log in</NavLink>
                    }
                </div>
            </div>
            {modalOpen &&
                <div className="md:hidden absolute left-0 right-0 bg-gray-200 min-h-20">
                    <ul>
                        {NAV_ITEMS.map((item) =>
                            <li className="py-3 hover:bg-gray-400">
                                <NavLink className='px-5' to={'/'}>{item.text}</NavLink>
                            </li>
                        )}
                    </ul>
                </div>
            }
        </div>
    )
}

export default Header;