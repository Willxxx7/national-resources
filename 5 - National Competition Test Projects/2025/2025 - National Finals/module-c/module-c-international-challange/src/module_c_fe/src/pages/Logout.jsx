import {useContext, useEffect} from "react";
import {AuthContext} from "../context/auth/AuthContext.jsx";
import {useNavigate} from "react-router-dom";
import {BasketContext} from "../context/basket/BasketContext.jsx";


const Logout = () => {

    const {setToken} = useContext(AuthContext);
    const {clearBasket} = useContext(BasketContext);
    const nav = useNavigate();

    // clear token, and remove it from local storage
    useEffect(() => {
        setToken("");
        window.localStorage.removeItem("auth-token");
        clearBasket();

        // redirect back to main
        nav('/');
    }, []);
};

export default Logout;