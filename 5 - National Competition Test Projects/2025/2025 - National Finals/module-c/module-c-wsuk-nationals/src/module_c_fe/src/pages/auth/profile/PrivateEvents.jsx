import EventBox from "../../../components/events/EventBox.jsx";
import {useEffect, useState} from "react";
import {api} from "../../../api/api.js";

const PrivateEvents = () => {

    const [events, setEvents] = useState([]);
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        const fetchData = async () => {
            setLoading(true);
            setEvents([]);
            try {
                const response = await api.get(`my/events?pictures`);
                setEvents(response.data.events);
                /*remove loading after fetch*/
                setLoading(false);
            } catch (e) {
                console.error(e);
                alert("Failed to fetch events! See console for more info.");
            }
        };

        fetchData();
    }, []);

    return (
        <div>
            {/*event boxes*/}
            <div className={"flex flex-wrap flex-col md:grid grid-cols-3 gap-8"}>
                {
                    loading ? <p>Loading...</p> :
                        events.length === 0 ?
                            <p>No events found for the current filter!</p>
                            :
                            events.map(event => {
                                return (
                                    <EventBox key={event.eventId} event={event}/>
                                );
                            })}
            </div>
        </div>
    );
};

export default PrivateEvents;