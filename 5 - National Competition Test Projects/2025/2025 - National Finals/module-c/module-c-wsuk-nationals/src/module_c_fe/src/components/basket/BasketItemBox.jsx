import {IMAGE_BASE_URL} from "../../api/api.js";
import {useContext, useEffect, useRef, useState} from "react";
import {BasketContext} from "../../context/basket/BasketContext.jsx";
import {usePictureSizes} from "../../hooks/usePictureSizes.js";

const BasketItemBox = ({basketItem}) => {

    const {removeItem, updateItem} = useContext(BasketContext);

    const [selectedSizeId, setSelectedSizeId] = useState(basketItem.picSizeId);
    const [pictureQuantity, setPictureQuantity] = useState(basketItem.qty);
    const [total, setTotal] = useState(basketItem.total);

    const pictureSizes = usePictureSizes();

    const isFirstRender = useRef(true);

    const handleRemoveItem = () => {
        removeItem(basketItem.itemId);
    };

    useEffect(() => {
        if (isFirstRender.current) {
            isFirstRender.current = false;
            return;
        }
        const selectedSize = pictureSizes.find(size => size.picSizeId == selectedSizeId);
        const newTotal = parseFloat(selectedSize.picSizePrice) * parseInt(pictureQuantity);

        setTotal(newTotal);

        // update in basket
        updateItem(basketItem.itemId, {
            itemId: basketItem.itemId,
            picture: basketItem.picture,
            picSizeId: selectedSize.picSizeId,
            qty: pictureQuantity,
            total: newTotal
        });

    }, [selectedSizeId, pictureQuantity, pictureSizes]);

    return (
        <div className={"flex items-center justify-between even:bg-gray-50 p-4"}>
            <div className={"flex gap-4 items-center"}>
                {/*picture*/}
                <div className={"max-w-[13%] min-w-[100px]"}>
                    <figure className={"flex flex-col gap-1"}>
                        <img src={IMAGE_BASE_URL + basketItem.picture.picturePath} alt={""}/>
                        <figcaption
                            className={"text-center text-xs text-gray-500"}>{basketItem.picture.event}</figcaption>
                    </figure>
                </div>
                <span className={"font-bold"}>{basketItem.picture.pictureLocator}</span>
                <div className={"grid grid-cols-3 gap-2 max-w-[45%]"}>
                    {/*size selector*/}
                    <div className={"flex flex-col gap-2 items-start"}>
                        <select className={"border-1 border-gray-500 p-1 rounded-sm shadow-sm w-full"} id={"size"}
                                value={selectedSizeId} onChange={e => setSelectedSizeId(e.target.value)}>
                            {pictureSizes.map((size) => {
                                return (
                                    <option key={size.picSizeId} value={size.picSizeId}>{size.picSizeLabel} -
                                        £{size.picSizePrice}</option>
                                );
                            })
                            }
                        </select>
                    </div>
                    {/*qty selector*/}
                    <div className={"flex flex-col gap-2 items-start"}>
                        <input type={"number"} id={"qty"} placeholder={"Quantity"}
                               className={"border-1 border-gray-500 p-1 rounded-sm shadow-sm w-full"}
                               onChange={e => setPictureQuantity(e.target.value)} value={pictureQuantity}/>
                    </div>
                    {/*output*/}
                    <div className={"justify-self-start"}>
                        <span className={"font-semibold text-lg"}>Total:</span>
                        <span className={"font-semibold text-xl"}>£{total}</span>
                    </div>
                </div>
            </div>
            <div>
                <button onClick={handleRemoveItem}>
                    <i className={"fa fa-trash text-primary hover:text-primary-light text-2xl cursor-pointer"}></i>
                </button>
            </div>
        </div>
    );
};

export default BasketItemBox;