import { TriangleAlert } from "lucide-react"

const ErrorPage = () => {
    return (
        <div className="min-h-screen flex items-center justify-center">
            <div className="text-center flex flex-col items-center gap-6">
                <TriangleAlert size={80} strokeWidth={1.5}/>
                <p className="text-black">Something error happened. Please try again later.</p>
            </div>
        </div>
    )
}

export default ErrorPage