import {createRoot} from 'react-dom/client'
import App from './App.jsx'
import AuthContextProvider from "./context/auth/AuthContextProvider.jsx";
import {BrowserRouter} from "react-router-dom";
import CustomerContextProvider from "./context/customer/CustomerContextProvider.jsx";
import BasketContextProvider from "./context/basket/BasketContextProvider.jsx";

createRoot(document.getElementById('root')).render(
    <BrowserRouter>
        <CustomerContextProvider>
            <AuthContextProvider>
                <BasketContextProvider>
                    <App/>
                </BasketContextProvider>
            </AuthContextProvider>
        </CustomerContextProvider>
    </BrowserRouter>
)
