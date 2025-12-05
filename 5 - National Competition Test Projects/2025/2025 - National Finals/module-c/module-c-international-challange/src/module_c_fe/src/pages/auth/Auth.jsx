import {useContext, useEffect} from "react";
import {AuthContext} from "../../context/auth/AuthContext.jsx";
import {Navigate, Outlet} from "react-router-dom";
const Auth = () => {
    const {isLoggedIn} = useContext(AuthContext);

    useEffect(() => {

        const fetchData = async () =>{

        }

        if(isLoggedIn){
            // try to fetch customer data
            fetchData();
        }
    }, [isLoggedIn]);

    return isLoggedIn ?  <Outlet /> : <Navigate to={"/login"} />;
};

export default Auth;