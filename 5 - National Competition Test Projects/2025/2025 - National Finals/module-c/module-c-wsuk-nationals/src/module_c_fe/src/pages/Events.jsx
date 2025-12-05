import {useEffect, useState} from "react";
import {api} from "../api/api.js";
import EventBox from "../components/events/EventBox.jsx";


const Events = () => {

    const [events, setEvents] = useState([]);
    const [categories, setCategories] = useState([]);

    /*loading state for api call*/
    const [loading, setLoading] = useState(false);

    /*states for filtering*/
    const [queryString, setQueryString] = useState("");
    const [search, setSearch] = useState("");
    const [date, setDate] = useState("");
    const [categoryId, setCategoryId] = useState("");
    const [sort, setSort] = useState("asc");


    /*
    Fetch categories only - this only need to run on initial load to fetch all categories
     */
    useEffect(() => {

        const fetchData = async () => {
            try {
                const response = await api.get('categories');
                setCategories(response.data.categories);
            } catch (e) {
                console.error(e);
                alert("Failed to fetch categories. See console for more info.")
            }
        };

        fetchData();

    }, []);


    /*
    We only fetch event data in this effect - it is affected by filter changes
     */
    useEffect(() => {
        const fetchData = async () => {
            setLoading(true);
            /*reset states on every fetch*/
            setEvents([]);
            /*append pictures to the query string*/
            try {
                const finalQueryString = queryString + "&pictures";
                const response = await api.get(`events?${finalQueryString}&sort=${sort}`);
                setEvents(response.data.events);
                /*remove loading after fetch*/
                setLoading(false);
            } catch (e) {
                console.error(e);
                alert("Failed to fetch events! See console for more info.");

            }
        };

        fetchData();
    }, [queryString, sort]);


    useEffect(() => {
        const params = new URLSearchParams();

        if (date) {
            params.append('date', date);
        }

        if (categoryId) {
            params.append('cat', categoryId);
        }

        if (name) {
            params.append("name", name);
        }

        if (search) {
            params.append('search', search);
        }

        setQueryString(params.toString());
    }, [search, categoryId, date]);


    /**
     * Remove all filters and reset to page 1
     */
    const clearFilter = () => {
        setSearch("");
        setDate("");
        setCategoryId("");
        setSort("asc");
    }

    return (
        <div className={"flex flex-col gap-8"}>
            <div className={"space-y-4"}>
                <h2 className={"text-4xl text-center font-bold text-primary-light"}>Public Events</h2>
                <h3 className={"text-2xl text-center text-gray-600"}>Browse from our publicly available events!</h3>
            </div>
            {/*event filtering*/}
            <div className={"w-screen mx-[calc(50%-50vw)] bg-gray-50"}>
                <div className={"max-w-[1400px] mx-auto px-4 py-8 flex flex-col gap-8"}>
                    <div className={"flex gap-4 justify-between flex-wrap md:grid grid-cols-3 md:justify-center"}>
                        <div className={"flex gap-4 md:justify-self-start"}>
                            {/*city or name*/}
                            <div className={"flex flex-col gap-2 items-start"}>
                                <label className={"font-semibold text-lg"} htmlFor={"search"}>Search</label>
                                <input type={"text"} id={"search"} placeholder={"City or event name"}
                                       className={"border-1 border-gray-500 p-1 rounded-sm shadow-sm"}
                                       onChange={e => setSearch(e.target.value)} value={search}/>
                            </div>
                        </div>
                        {/*date range filter*/}
                        <div className={"flex gap-4 md:justify-self-center"}>
                            {/*exact date*/}
                            <div className={"flex flex-col gap-2 items-start"}>
                                <label className={"font-semibold text-lg"} htmlFor={"date"}>Date</label>
                                <input type={"date"} id={"date"}
                                       className={"border-1 border-gray-500 p-1 rounded-sm shadow-sm"}
                                       onChange={e => setDate(e.target.value)} value={date}/>
                            </div>
                        </div>
                        <div className={"flex gap-4 md:justify-self-end"}>
                            {/*category*/}
                            <div className={"flex flex-col gap-2 items-start"}>
                                <label className={"font-semibold text-lg"} htmlFor={"category"}>Category</label>
                                <select className={"border-1 border-gray-500 p-1 rounded-sm shadow-sm"} id={"category"}
                                        onChange={e => setCategoryId(e.target.value)} value={categoryId}>
                                    <option selected={categoryId === ""} value={""}>---Select a category---</option>
                                    {
                                        categories.map(category => {
                                            return <option selected={categoryId === category.categoryId}
                                                           key={category.categoryId}
                                                           value={category.categoryId}>{category.categoryName}</option>;
                                        })
                                    }
                                </select>
                            </div>
                            {/*sorting by date*/}
                            <div className={"flex flex-col gap-2 items-start"}>
                                <label className={"font-semibold text-lg"}>Sort by Date</label>
                                <select className={"border-1 border-gray-500 p-1 rounded-sm shadow-sm"} value={sort}
                                        onChange={e => setSort(e.target.value)}>
                                    <option value={"asc"} selected={sort === "asc"}>Ascending</option>
                                    <option value={"desc"} selected={sort === "desc"}>Descending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div className={"flex flex-col gap-8"}>
                        <button onClick={clearFilter}
                                className={"self-start bg-primary-light hover:bg-primary-dark text-white text-xl py-2 px-4 rounded-sm font-bold text-center cursor-pointer"}>Clear
                            Filter
                        </button>
                    </div>
                </div>
            </div>

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

export default Events;