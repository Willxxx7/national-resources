import {useContext, useEffect, useState} from "react";
import {AuthContext} from "./AuthContext.jsx";
import {api} from "../../api/api.js";
import {CustomerContext} from "../customer/CustomerContext.jsx";
import {useNavigate} from "react-router-dom";

const AuthContextProvider = ({children}) => {

    const initialToken = window.localStorage.getItem('auth-token') || "";

    const [token, setToken] = useState(initialToken);
    const [isLoggedIn, setLoggedIn] = useState(initialToken && initialToken.trim().length > 0);

    const {setCustomer} = useContext(CustomerContext);
    const nav = useNavigate();

    useEffect(() => {
        if (token && token.trim().length > 0) {
            setLoggedIn(true);
        } else {
            setLoggedIn(false);
        }
    }, [token]);

    useEffect(() => {

        const fetchData = async () => {
            try {
                const response = await api.get('my/profile', {
                    headers: {
                        Authorization: `Bearer ${token}`
                    }
                });
                setLoggedIn(true);
                setCustomer(response.data.customer);
            } catch (e) {
                if (e.response.status === 401) {
                    alert("Token has expired!")
                } else {
                    alert("Unknown server error");
                }
                setToken("");
                setLoggedIn(false);
                window.localStorage.setItem("auth-token", "");
                nav('/login');
            }
        }
        // fetch customer data on load if token present
        if (token && token.trim().length > 0) {
            fetchData();
        }
    }, [token]);

    return (
        <AuthContext.Provider value={{token, setToken, isLoggedIn, setLoggedIn}}>
            {children}
        </AuthContext.Provider>
    );
};

export default AuthContextProvider;