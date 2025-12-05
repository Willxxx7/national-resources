import {useEffect, useState} from "react";
import {useParams} from "react-router-dom";
import {api, IMAGE_BASE_URL} from "../../../api/api.js";
import EventPictureBox from "../../../components/events/EventPictureBox.jsx";
import OrderStatusBadge from "../../../components/orders/OrderStatusBadge.jsx";

const OrderPage = () => {

    const [order, setOrder] = useState(null);
    const [loading, setLoading] = useState(true);

    const params = useParams();

    useEffect(() => {
        const fetchData = async () => {
            setLoading(true);
            api.get(`orders/${params.id}`)
                .then(r => {
                    setOrder(r.data.order)
                })
                .catch(err => {
                    alert("Error fetching order");
                    console.error(err);
                })
                .finally(() => {
                    setLoading(false);
                });
        };

        fetchData();
    }, []);

    return (
        loading ? <p>Loading...</p> :
            (
                <div className={"flex flex-col gap-4"}>
                    <h2 className={"text-4xl text-center font-bold text-gray-900 flex items-center self-center gap-2"}>Order #{order.orderId}
                        <OrderStatusBadge status={order.orderStatus}/>
                    </h2>
                    <div className={"flex flex-wrap flex-col md:grid grid-cols-3 gap-6"}>
                        {order.orderPictures.map(orderPicture => {
                            return (
                                <div className={"group sm:hover:scale-105 border-1 transition-transform duration-400 cursor-pointer border-gray-300 rounded-sm shadow-md hover:shadow-xl flex flex-col gap-2 justify-between"}>
                                    <div className={"aspect-video w-full relative"}>
                                        <img className={"rounded-t-sm object-cover w-full h-full"}
                                             src={IMAGE_BASE_URL + orderPicture.picture.picturePath}
                                             alt={`Picture taken for ${orderPicture.picture.event}`}/>
                                        {/*expand picture icon*/}
                                    </div>
                                    <div className={"p-4 flex flex-col gap-4"}>
                                        <p className={"text-base text-gray-600 space-x-1"}>
                                            <i className={"fa fa-circle-info"}></i>
                                            <span>Size: {orderPicture.picSize.picSizeLabel} - £{orderPicture.picSize.picSizePrice}</span>
                                        </p>
                                        <p className={"text-base text-gray-600 space-x-1"}>
                                            <i className={"fa fa-ribbon"}></i>
                                            <span>Qty: {orderPicture.picQty}</span>
                                        </p>
                                        <p className={"text-base text-gray-600 space-x-1"}>
                                            <i className={"fa fa-sterling-sign"}></i>
                                            <span className={`${order.orderStatus === "cancelled" ? "line-through decoration-3 decoration-primary text-gray-500" : "font-bold text-lg"}`}>Total: £{orderPicture.picQty * orderPicture.picSize.picSizePrice}</span>
                                        </p>
                                    </div>
                                </div>
                            );
                        })}
                    </div>
                </div>
            )
    );
};

export default OrderPage;