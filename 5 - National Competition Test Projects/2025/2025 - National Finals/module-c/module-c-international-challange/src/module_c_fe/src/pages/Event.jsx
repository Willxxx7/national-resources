import {useEffect, useState} from "react";
import {useNavigate, useParams} from "react-router-dom";
import {api} from "../api/api.js";
import EventPictureBox from "../components/events/EventPictureBox.jsx";
import BasketModal from "../components/events/BasketModal.jsx";
import PictureViewerModal from "../components/events/PictureViewerModal.jsx";

/**
 * Event detail page
 */

const Event = () => {

    const params = useParams();
    const nav = useNavigate();

    const [event, setEvent] = useState(null);
    const [eventPictures, setEventPictures] = useState([]);

    // for modal - picture size selection & adding to basket
    const [basketModalVisible, setBasketModalVisible] = useState(false);
    const [basketPicture, setBasketPicture] = useState();

    // picture viewer modal
    const [pictureViewerModalVisible, setPictureViewerModalVisible] = useState(false);
    const [pictureViewerPicture, setPictureViewerPicture] = useState();


    useEffect(() => {
        if(basketPicture){
            setBasketModalVisible(true);
        }
    }, [basketPicture]);

    useEffect(() => {
        if(!basketModalVisible){
            setBasketPicture(null);
        }
    }, [basketModalVisible]);

    // fetch requested event from id on initial render
    useEffect(() => {
        const fetchData = async () => {
            try {
                const response = await api.get(`/events/${params.id}?pictures`);
                setEvent(response.data.event);
                setEventPictures(response.data.event.pictures);
            } catch (e) {
                if(e.response.status === 404){
                    console.log(e);
                    alert("Event not found or private!");
                    nav('/');
                }else{
                    alert("Error at loading event. See console for more info!");
                }
            }
        }

        fetchData();
    }, [params.id]);

    return (
        <div className={"flex flex-col gap-8"}>
            {event &&
                <>
                    <div className={"space-y-4"}>
                        <h2 className={"text-4xl text-center font-bold text-primary-light"}>{event.eventName}</h2>
                        <h3 className={"text-2xl text-center text-gray-600"}>In {event.eventCity},
                            at {event.eventDate}</h3>
                    </div>
                    {/*<h3 className={"text-2xl text-gray-900 font-semibold"}>Pictures</h3>*/}
                    {/*event pictures*/}
                    <div className={"flex flex-wrap flex-col md:grid grid-cols-3 gap-6"}>
                        {eventPictures.map(eventPicture => {
                            return (
                                <EventPictureBox key={eventPicture.pictureId} picture={eventPicture} setBasketPicture={setBasketPicture} setPictureViewerModalVisible={setPictureViewerModalVisible} setPictureViewerPicture={setPictureViewerPicture}/>
                            );
                        })}
                    </div>
                    <BasketModal basketPicture={basketPicture} basketModalVisible={basketModalVisible} setBasketModalVisible={setBasketModalVisible}/>
                    <PictureViewerModal pictureViewerModalVisible={pictureViewerModalVisible} setPictureViewerModalVisible={setPictureViewerModalVisible} pictureViewerPicture={pictureViewerPicture} />
                </>
            }
        </div>
    );
};

export default Event;