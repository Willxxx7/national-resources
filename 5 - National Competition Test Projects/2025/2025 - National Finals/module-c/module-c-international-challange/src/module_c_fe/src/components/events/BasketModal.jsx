import { useEffect, useState, useContext } from 'react';
import { BasketContext } from '../../context/basket/BasketContext.jsx';
import { usePictureSizes } from '../../hooks/usePictureSizes.js';

/**
 * Basket Modal for selecting size and qty for a picture
 *
 */
const BasketModal = ({
  basketModalVisible,
  setBasketModalVisible,
  basketPicture,
}) => {
  const [selectedSize, setSelectedSize] = useState('');
  const [pictureQuantity, setPictureQuantity] = useState('0');
  const [total, setTotal] = useState(0);

  const { addToBasket } = useContext(BasketContext);

  const pictureSizes = usePictureSizes();

  const handleModalClose = () => {
    setSelectedSize(null);
    setPictureQuantity('');
    setTotal(0);
    setBasketModalVisible(false);
  };

  // calculate total price
  useEffect(() => {
    if (selectedSize && pictureQuantity > 0) {
      setTotal(
        pictureSizes[selectedSize].picSizePrice * parseInt(pictureQuantity)
      );
    }
  }, [pictureSizes, selectedSize, pictureQuantity]);

  const handleAddToBasket = () => {
    // validate input
    if (!pictureSizes[selectedSize]) {
      alert('You need to select a size!');
      return;
    }

    if (pictureQuantity < 1) {
      alert('Quantity needs to be at least 1!');
      return;
    }

    addToBasket({
      itemId:
        Date.now().toString() + Math.random().toString(36).substring(2, 5),
      picture: basketPicture,
      picSizeId: pictureSizes[selectedSize].picSizeId,
      qty: pictureQuantity,
      total: total,
    });

    // close modal after save
    alert('Basket successfully updated!');
    handleModalClose();
  };

  return (
    basketModalVisible && (
      <>
        {/*backdrop*/}
        <div
          className={
            'fixed inset-0 w-full h-full bg-black/60 z-100 flex justify-center items-center'
          }
        >
          {/*modal content*/}
          <div
            className={
              'relative bg-gray-50 p-6 rounded-xl min-w-[25%] flex flex-col gap-8'
            }
          >
            {/*close button*/}
            <button
              className={
                'absolute right-4 top-4 border-1 rounded-sm border-gray-200 px-4 py-2 font-semibold text-xl bg-gray-100 hover:bg-zinc-400 cursor-pointer'
              }
              onClick={handleModalClose}
            >
              X
            </button>
            <h2 className={'text-primary-light text-4xl font-bold text-center'}>
              Add to Basket '{basketPicture.pictureLocator}'
            </h2>
            <div className={'flex justify-between gap-2'}>
              {/*inputs*/}
              <div className={'flex gap-4'}>
                {/*size selector*/}
                <div className={'flex flex-col gap-2 items-start'}>
                  <label className={'font-semibold text-lg'} htmlFor={'size'}>
                    Size
                  </label>
                  <select
                    className={
                      'border-1 border-gray-500 p-1 rounded-sm shadow-sm'
                    }
                    id={'size'}
                    value={selectedSize}
                    onChange={(e) => setSelectedSize(e.target.value)}
                  >
                    <option value={''}>---Select a size---</option>
                    {pictureSizes &&
                      pictureSizes.map((size, index) => {
                        return (
                          <option key={size.picSizeId} value={index}>
                            {size.picSizeLabel} - £{size.picSizePrice}
                          </option>
                        );
                      })}
                  </select>
                </div>
                {/*qty selector*/}
                <div className="flex flex-col gap-2 items-start">
                  <label className="font-semibold text-lg" htmlFor="qty">
                    Quantity
                  </label>
                  <input
                    type="number"
                    id="qty"
                    placeholder="Quantity"
                    min="1"
                    onInput={(e) => {
                      // Force minimum value of 1
                      if (e.target.value < 1) {
                        e.target.value = 1;
                      }
                    }}
                    className="border-1 border-gray-500 p-1 rounded-sm shadow-sm max-w-[30%]"
                    onChange={(e) => {
                      // Ensure valid positive integer
                      const value = parseInt(e.target.value) || 0;
                      // Enforce minimum of 1
                      setPictureQuantity(value < 1 ? 1 : value);
                    }}
                    value={pictureQuantity}
                  />
                </div>
              </div>
              {/*output*/}
              <div className={'flex flex-col gap-2 items-start max-w-[30%]'}>
                <span className={'font-semibold text-lg'}>Total £</span>
                <span className={'font-semibold text-xl'}>£{total}</span>
              </div>
            </div>
            <button
              onClick={handleAddToBasket}
              className={
                'bg-primary-light hover:bg-primary-dark hover:bg-blue-600 text-white text-xl py-2 rounded-md font-bold text-center cursor-pointer'
              }
            >
              <i className={'fa fa-shopping-basket'}></i>
              Add to basket
            </button>
          </div>
        </div>
      </>
    )
  );
};

export default BasketModal;
