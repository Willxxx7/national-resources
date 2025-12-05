import {BasketContext} from "./BasketContext.jsx";
import {useEffect, useState} from "react";

const BasketContextProvider = ({children}) => {

    const [basketItems, setBasketItems] = useState(() => {
        // fetch from local storage, if available, otherwise empty array
        const basketItems = window.localStorage.getItem("basket-items");
        if (basketItems) {
            return JSON.parse(basketItems);
        } else {
            return [];
        }
    });

    useEffect(() => {
        // sync with local storage on change
        window.localStorage.setItem("basket-items", JSON.stringify(basketItems));
    }, [basketItems]);


    /**
     * Add new basket item
     * @param item
     */
    const addToBasket = (item) => {
        setBasketItems(prevItems => [...prevItems, item]);
    };

    /**
     * Remove item based on id
     * @param itemId
     */
    const removeItem = (itemId) => {
        setBasketItems(prevItems => prevItems.filter((item) => item.itemId !== itemId));
    };

    /**
     * Update item based on index
     * @param itemId
     * @param item
     */
    const updateItem = (itemId, item) => {
        setBasketItems(prevItems => {
            const itemIdx = prevItems.findIndex(item => item.itemId === itemId);
            const updatedItems = [...prevItems];
            updatedItems[itemIdx] = item;
            return updatedItems
        });
    }

    /**
     * Remove all items from basket
     */
    const clearBasket = () => {
        setBasketItems([]);
    };

    return (
        <BasketContext.Provider value={{addToBasket, removeItem, basketItems, clearBasket, updateItem}}>
            {children}
        </BasketContext.Provider>
    );
};

export default BasketContextProvider;