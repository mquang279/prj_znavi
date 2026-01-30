import { Heart, Search, ShoppingBag } from "lucide-react";
import { NavLink } from "react-router";

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
    return (
        <div className="flex h-12 items-center px-20 py-9 justify-between border-gray-200 border-b">
            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a6/Logo_NIKE.svg" alt="" className="h-7" />
            <div className="nav-items flex gap-20 font-semibold text-sm">
                {NAV_ITEMS.map((item) =>
                    <NavLink to={'/'}>{item.text}</NavLink>
                )}
            </div>
            <div className="flex gap-6 items-center">
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
            </div>
        </div>
    )
}

export default Header;