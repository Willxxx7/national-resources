import {useContext} from "react";
import {AuthContext} from "../../context/auth/AuthContext.jsx";
import {useNavigate} from "react-router-dom";
import {IMAGE_BASE_URL} from "../../api/api.js";

const EventPictureBox = ({picture, setBasketPicture}) => {

    const {isLoggedIn} = useContext(AuthContext);
    const nav = useNavigate();

    const handleBasketClick = () => {
        if (!isLoggedIn) {
            nav('/login');
        }

        setBasketPicture(picture);
    };

    return (
        <div
            className={"group sm:hover:scale-105 border-1 transition-transform duration-400 cursor-pointer border-gray-300 rounded-sm shadow-md hover:shadow-xl flex flex-col gap-2 justify-between"}>
            <div className={"aspect-video w-full relative"}>
                <img className={"rounded-t-sm object-cover w-full h-full"}
                     src={IMAGE_BASE_URL + picture.picturePath}
                     alt={`Picture taken for ${picture.event}`}/>
            </div>
            <div className={"p-4 flex flex-col gap-4"}>
                <p className={"text-base text-gray-600 space-x-1"}>
                    <i className={"fa fa-note-sticky"}></i>
                    <span>Note: {picture.pictureUploadNote ?? '-'}</span>
                </p>

                <p className={"text-base text-gray-600 space-x-1"}>
                    <i className={"fa fa-file-signature text-dark-1"}></i>
                    <span>{picture.pictureLocator}</span>
                </p>
                <p className={"text-base text-gray-600 space-x-1"}>
                    <i className={"fa fa-upload text-dark-1"}></i>
                    <span>Uploaded at {picture.pictureUploadDate.slice(0, 10)}</span>
                </p>
                <button onClick={handleBasketClick}
                        className={"bg-primary-light group-hover:bg-blue-600 text-white text-xl py-2 rounded-sm font-bold text-center hover:bg-dark-blue-3 cursor-pointer"}>
                    <i className={"fa fa-shopping-basket "}></i>
                    Add to basket
                </button>
            </div>
        </div>
    );
};

export default EventPictureBox;