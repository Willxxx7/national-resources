import {NavLink} from "react-router-dom";
import BasketModal from "./BasketModal.jsx";
import {IMAGE_BASE_URL} from "../../api/api.js";

/**
 * Event box for 'events' page, where a list of event boxes is displayed
 * */
const EventBox = ({event}) => {

    return (
        <div
            className={"group border-1 border-zinc-300 rounded-sm flex flex-col gap-2 shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden"}>
            <div className={"relative h-64 overflow-hidden"}>
                {/*dark overlay to make the category badge more standout*/}
                <div className={"absolute inset-0 w-full z-45 h-full bg-black/15 group-hover:bg-black/5 transition-colors"}>
                </div>
                <img
                    className={"object-cover absolute z-40 inset-0 w-full h-full group-hover:scale-110 transition-transform duration-300"}
                    src={IMAGE_BASE_URL + event.pictures[0].picturePath} alt={"Event banner image"}/>
                <p className={"absolute bottom-2 left-2 z-46 bg-white text-black rounded-xl px-2 py-1 text-sm font-bold"}>{event.eventCategory}</p>
            </div>
            <div className={"flex flex-col gap-4 p-4"}>
                <h2 className={"text-xl text-dark-1 font-semibold group-hover:text-blue-600 transition-colors"}>{event.eventName}</h2>
                <p className={"text-lg text-gray-600 space-x-1"}>
                    <i className={"fa fa-map-pin text-dark-1"}></i>
                    <span>{event.eventCity}</span>
                </p>
                <p className={"text-base text-gray-600 space-x-1"}>
                    <i className={"fa fa-calendar text-dark-1"}></i>
                    <span>{event.eventDate}</span>
                </p>
                <p className={"text-base text-gray-600 space-x-1"}>
                    <i className={"fa fa-clock text-dark-1"}></i>
                    <span>{event.eventTime.slice(0,5)}</span>
                </p>
                <p className={"text-base text-gray-600 space-x-1"}>
                    <i className={"fa fa-camera text-dark-1"}></i>
                    <span>{event.pictures.length} pictures available</span>
                </p>
                <NavLink to={`/events/${event.eventId}`}
                         className={"bg-primary-light hover:bg-primary-dark text-white text-xl py-2 rounded-sm font-bold text-center cursor-pointer"}>View
                    Pictures</NavLink>
            </div>
        </div>
    );
};

export default EventBox;