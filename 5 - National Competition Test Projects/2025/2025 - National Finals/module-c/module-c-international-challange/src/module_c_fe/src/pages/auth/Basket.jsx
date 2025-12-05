import {useContext, useState} from "react";
import {BasketContext} from "../../context/basket/BasketContext.jsx";
import {NavLink} from "react-router-dom";
import BasketItemBox from "../../components/basket/BasketItemBox.jsx";
import {api} from "../../api/api.js";

const Basket = () => {

    const {basketItems, clearBasket} = useContext(BasketContext);
    const [noteModalVisible, setNoteModalVisible] = useState(false);
    const [orderNote, setOrderNote] = useState("");

    const handleOrderPlace = () => {

        const orderPictures = basketItems.map(basketItem =>{
             return {
                 picId: basketItem.picture.pictureId,
                 picSizeId: basketItem.picSizeId,
                 picQty: basketItem.qty
             }
        });

        api.post("orders", {
            orderNote: orderNote,
            orderPictures: orderPictures
        })
            .then(r => {
                console.log(r);
                // clear basket on successful order placing
                clearBasket();
                setNoteModalVisible(false);
                alert("Your order has been placed! Thank you!")
            })
            .catch(e =>{
                alert("There was an error placing your order!");
                console.error(e);
            })

    };

    const handleModalClose = () => {
        setNoteModalVisible(false);
    }

    const handleModalOpen = () => {
        setNoteModalVisible(true);
    }

    return (
        <div className={"flex flex-col gap-8"}>
            {/*render basket items*/}
            {
                basketItems.length <= 0 ?
                    <>
                        {/*on no items*/}
                        <div className={"w-screen mx-[calc(50%-50vw)] bg-gray-50"}>
                            <div className={"max-w-[1400px] mx-auto py-20 space-y-10"}>
                                <h2 className={"text-2xl text-center font-bold text-gray-900"}>No items in your
                                    basket:(
                                </h2>
                                <h3 className={"text-3xl sm:text-5xl font-bold text-center text-primary-light no-underline"}>
                                    <NavLink
                                        className={"bg-gray-100 rounded-sm border-1 border-gray-200 px-8 py-4 hover:shadow-xl transition-all"}
                                        to={"/"}>Start shopping now!</NavLink>
                                </h3>
                            </div>
                        </div>
                    </> :
                    <>
                        <div className={"flex gap-1 justify-center items-center"}>
                            <h2 className={"text-4xl text-center font-bold text-gray-900"}>Basket</h2>
                            <span
                                className={"p-1 bg-primary flex justify-center items-center text-white rounded-full w-[35px] h-[35px] text-xl"}>{basketItems.length}</span>
                        </div>
                        <div className={"flex flex-col gap-4"}>
                            {basketItems.map((item) => {
                                console.log(item.itemId);
                                return (
                                    <BasketItemBox key={item.itemId} basketItem={item}/>
                                )
                            })}
                        </div>
                        <button onClick={handleModalOpen}
                                className={"bg-primary-light hover:bg-primary-dark text-white text-xl py-2 rounded-sm font-bold text-center hover:bg-dark-blue-3 cursor-pointer"}>
                            <i className={"fa fa-check-double"}></i>
                            Finalise Order
                        </button>
                    </>
            }
            {/*order note modal*/}
            {
                noteModalVisible && (
                    <>
                        {/*backdrop*/}
                        <div className={"fixed inset-0 w-full h-full bg-black/60 z-100 flex justify-center items-center"}>
                            {/*modal content*/}
                            <div className={"relative bg-gray-50 p-6 rounded-xl min-w-[25%] flex flex-col gap-8"}>
                                {/*close button*/}
                                <button
                                    className={"absolute right-4 top-4 border-1 rounded-sm border-gray-200 px-4 py-2 font-semibold text-xl bg-gray-100 hover:bg-zinc-400 cursor-pointer"}
                                    onClick={handleModalClose}>X
                                </button>
                                <div className={"flex justify-between gap-2"}>
                                    <div className={"flex flex-col gap-2 items-start"}>
                                        <label className={"font-semibold text-lg"} htmlFor={"note"}>Order Note (optional)</label>
                                        <input type={"text"} id={"note"} placeholder={"Order note (optional)"}
                                               className={"border-1 border-gray-500 p-1 rounded-sm shadow-sm "}
                                               onChange={e => setOrderNote(e.target.value)} value={orderNote}/>
                                    </div>
                                </div>
                                <button onClick={handleOrderPlace}
                                        className={"bg-primary-light hover:bg-primary-dark text-white text-xl py-2 rounded-md font-bold text-center cursor-pointer"}>
                                    <i className={"fa fa-credit-card"}></i>
                                    Place Order
                                </button>
                            </div>
                        </div>
                    </>
                )
            }

        </div>
    );
};

export default Basket;