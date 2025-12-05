import {CustomerContext} from "./CustomerContext.jsx";
import {useState} from "react";
const CustomerContextProvider = ({children}) => {

    const [customer, setCustomer] = useState({});
    const [orders, setOrders] = useState([])

    return (
        <CustomerContext.Provider value={{customer, setCustomer, orders, setOrders}}>
            {children}
        </CustomerContext.Provider>
    );
};

export default CustomerContextProvider;