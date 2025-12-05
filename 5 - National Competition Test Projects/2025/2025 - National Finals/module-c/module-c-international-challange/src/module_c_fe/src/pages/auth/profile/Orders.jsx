import {useContext, useEffect, useState} from "react";
import {api} from "../../../api/api.js";
import {NavLink} from "react-router-dom";
import OrderItemBox from "../../../components/orders/OrderItemBox.jsx";
import {CustomerContext} from "../../../context/customer/CustomerContext.jsx";

const Orders = () => {

    const {orders, setOrders} = useContext(CustomerContext);
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        const fetchData = async () => {
            setLoading(true);
            api.get("my/orders")
                .then(response => {
                    setOrders(response.data.orders);
                })
                .catch(err => {
                    alert("Error fetching your orders!");
                    console.error(err);
                })
                .finally(() => {
                    setLoading(false);
                })
        };

        fetchData();
    }, []);

    return (
        loading ? <p>Loading...</p> :
            (
                orders.length === 0 ?
                    <div className={"w-screen mx-[calc(50%-50vw)] bg-gray-50"}>
                        <div className={"max-w-[1400px] mx-auto py-20 space-y-10"}>
                            <h2 className={"text-2xl text-center font-bold text-gray-900"}>No orders found:(
                            </h2>
                            <h3 className={"text-3xl sm:text-5xl font-bold text-center text-primary-light no-underline"}>
                                <NavLink
                                    className={"bg-gray-100 rounded-sm border-1 border-gray-200 px-8 py-4 hover:shadow-xl transition-all"}
                                    to={"/"}>Start shopping now!</NavLink>
                            </h3>
                        </div>
                    </div>
                    :
                    <div className={"flex flex-col gap-4 sm:grid grid-cols-3 sm:gap-8"}>
                        {orders.map(order =>{
                            return <OrderItemBox key={order.orderId} order={order}/>
                        })}
                    </div>
            )
    );
};

export default Orders;