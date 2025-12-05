import OrderStatusBadge from "./OrderStatusBadge.jsx";
import {api} from "../../api/api.js";
import {useContext} from "react";
import {CustomerContext} from "../../context/customer/CustomerContext.jsx";
import {useNavigate} from "react-router-dom";

const OrderItemBox = ({order}) => {

    const {setOrders} = useContext(CustomerContext);
    const nav = useNavigate();

    const handleNavigateToOrder = (e) => {
        e.stopPropagation();
        e.preventDefault();

        nav(`/profile/orders/${order.orderId}`);

    };

    const handleCancelOrder = (e) => {
        e.preventDefault();
        e.stopPropagation();

        if (window.confirm(`Are you sure to cancel order #${order.orderId}?`)) {
            api.patch(`orders/${order.orderId}/cancel`)
                .then(r =>{
                    if(r.status === 204) return; // order already cancelled
                    setOrders(prevOrders =>{
                        return prevOrders.map(o =>{
                           return o.orderId === order.orderId ? {...o, orderStatus: "cancelled"} : o
                        });
                    })
                })
                .catch(err =>{
                    alert("Error at cancelling your order!");
                    console.error(err);
                })
        }
    };

    return (
        <div
            className={"border-1 border-zinc-300 rounded-sm flex flex-col gap-6 shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden p-4 cursor-pointer"}
            onClick={handleNavigateToOrder}>
            {/*card header*/}
            <div className={"grid grid-cols-3 items-center"}>
                {/*status badge*/}
                <div className={"justify-self-start"}>
                    <OrderStatusBadge status={order.orderStatus}/>
                </div>
                {/*order id*/}
                <div className={"justify-self-center"}>
                    <span className={"text-xl font-semibold"}>Order #{order.orderId}</span>
                </div>
                {/*price*/}
                <div className={"justify-self-end"}>
                    <span className={`${order.orderStatus === "cancelled" ? "line-through decoration-3 decoration-primary text-gray-500" : " "} font-semibold text-lg`}>£{order.orderTotal}</span>
                </div>
            </div>
            {/*card body*/}
            <div className={"flex flex-col gap-4"}>
                <div className={"flex gap-1 items-center text-gray-600"}>
                    <i className={"fa fa-hashtag"}></i>
                    <span>Items: {order.orderPictures.length}</span>
                </div>
                <div className={"flex gap-1 items-center text-gray-600"}>
                    <i className={"fa fa-calendar"}></i>
                    <span>Placed: {order.orderDate}</span>
                </div>
                <div className={"flex gap-1 items-center text-gray-600"}>
                    <i className={"fa fa-note-sticky"}></i>
                    <span>Note: {order.orderNote ? order.orderNote : "-"}</span>
                </div>
            </div>
            {(order.orderStatus === "confirmed")
                &&
                (
                    <div className={"self-end"}>
                        <button
                            className={"text-red-500  px-2 py-1 rounded-sm cursor-pointer hover:bg-gray-100 hover:text-red-600 transition-all"}
                            onClick={handleCancelOrder}>Cancel Order
                        </button>
                    </div>
                )
            }
        </div>
    );
};

export default OrderItemBox;